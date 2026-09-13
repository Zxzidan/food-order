<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MemberController extends Controller
{
    /**
     * Tampilkan halaman daftar member dan statistik
     */
    public function index(Request $request): View
    {
        $userId = auth()->id();
        $query = Member::where('user_id', $userId)->withCount('orders');

        if ($request->filled('search')) {
            $search = trim((string) $request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('member_code', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && in_array($request->status, ['active', 'inactive'])) {
            $query->where('status', $request->status);
        }

        $members = $query->orderByDesc('id')->paginate(10)->withQueryString();

        // Statistik ringkasan member
        $totalMembers = Member::where('user_id', $userId)->count();
        $activeMembers = Member::where('user_id', $userId)->where('status', 'active')->count();
        $totalPoints = (int) Member::where('user_id', $userId)->sum('points_balance');
        $totalSpend = (int) Member::where('user_id', $userId)->sum('total_spend');

        return view('members.index', [
            'title' => 'Manajemen Member',
            'members' => $members,
            'stats' => [
                'total_members' => $totalMembers,
                'active_members' => $activeMembers,
                'total_points' => $totalPoints,
                'total_spend' => $totalSpend,
            ],
            'search' => $request->search,
            'status' => $request->status,
        ]);
    }

    /**
     * Registrasi / tambah member baru (mendukung request form biasa & AJAX Quick Register POS)
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $userId = auth()->id();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => [
                'required',
                'string',
                'max:50',
                Rule::unique('members')->where('user_id', $userId),
            ],
            'email' => 'nullable|email|max:255',
            'status' => 'nullable|in:active,inactive',
        ], [
            'phone.unique' => 'Nomor HP/WhatsApp ini sudah terdaftar sebagai member.',
        ]);

        $memberCode = Member::generateUniqueCode($userId);

        $member = Member::create([
            'user_id' => $userId,
            'member_code' => $memberCode,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'points_balance' => 0,
            'total_spend' => 0,
            'status' => $validated['status'] ?? 'active',
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Member baru berhasil didaftarkan!',
                'member' => [
                    'id' => $member->id,
                    'member_code' => $member->member_code,
                    'name' => $member->name,
                    'phone' => $member->phone,
                    'email' => $member->email,
                    'points_balance' => $member->points_balance,
                    'points_value' => $member->points_balance * 1000,
                    'formatted_points' => $member->formatted_points,
                ],
            ]);
        }

        return redirect()->route('members.index')->with('success', 'Member '.$member->name.' ('.$member->member_code.') berhasil didaftarkan!');
    }

    /**
     * Ambil data detail member beserta riwayat mutasi poin (JSON untuk modal/drawer)
     */
    public function show(Member $member): JsonResponse|View
    {
        if ($member->user_id !== auth()->id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $member->load(['pointLogs' => function ($q) {
            $q->latest()->limit(50);
        }, 'orders' => function ($q) {
            $q->latest()->limit(10);
        }]);

        if (request()->wantsJson()) {
            return response()->json([
                'member' => $member,
                'logs' => $member->pointLogs,
                'orders' => $member->orders,
            ]);
        }

        return view('members.show', [
            'title' => 'Detail Member - '.$member->name,
            'member' => $member,
        ]);
    }

    /**
     * Update data member
     */
    public function update(Request $request, Member $member): RedirectResponse|JsonResponse
    {
        if ($member->user_id !== auth()->id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => [
                'required',
                'string',
                'max:50',
                Rule::unique('members')->where('user_id', auth()->id())->ignore($member->id),
            ],
            'email' => 'nullable|email|max:255',
            'status' => 'required|in:active,inactive',
        ], [
            'phone.unique' => 'Nomor HP/WhatsApp ini sudah digunakan oleh member lain.',
        ]);

        $member->update($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data member berhasil diperbarui!',
                'member' => $member,
            ]);
        }

        return redirect()->route('members.index')->with('success', 'Data member berhasil diperbarui!');
    }

    /**
     * Hapus member
     */
    public function destroy(Member $member): RedirectResponse
    {
        if ($member->user_id !== auth()->id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $name = $member->name;
        $member->delete();

        return redirect()->route('members.index')->with('success', "Member {$name} berhasil dihapus.");
    }

    /**
     * Endpoint live search untuk POS kasir (/members/search?q=...)
     */
    public function search(Request $request): JsonResponse
    {
        $userId = auth()->id();
        $keyword = trim((string) $request->input('q', ''));

        if (empty($keyword)) {
            return response()->json([]);
        }

        $members = Member::where('user_id', $userId)
            ->where('status', 'active')
            ->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('phone', 'like', "%{$keyword}%")
                    ->orWhere('member_code', 'like', "%{$keyword}%");
            })
            ->limit(10)
            ->get()
            ->map(function ($m) {
                return [
                    'id' => $m->id,
                    'member_code' => $m->member_code,
                    'name' => $m->name,
                    'phone' => $m->phone,
                    'email' => $m->email,
                    'points_balance' => (int) $m->points_balance,
                    'points_value' => (int) ($m->points_balance * 1000),
                    'formatted_points' => $m->formatted_points,
                    'formatted_points_value' => $m->formatted_points_value,
                ];
            });

        return response()->json($members);
    }
}
