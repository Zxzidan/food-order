<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $menus = Menu::with('category')->latest()->get();

        return view('menu', [
            'title' => 'Menu',
            'categories' => $categories,
            'menus' => $menus,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $category = Category::firstOrCreate(
            ['name' => $validated['category']],
            ['slug' => Str::slug($validated['category'])]
        );

        $menu = Menu::create([
            'category_id' => $category->id,
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'description' => $validated['description'] ?? null,
            'image' => $validated['image'] ?? null,
            'is_available' => $validated['stock'] > 0,
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'menu' => $menu]);
        }

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan');
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $category = Category::firstOrCreate(
            ['name' => $validated['category']],
            ['slug' => Str::slug($validated['category'])]
        );

        $menu->update([
            'category_id' => $category->id,
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'description' => $validated['description'] ?? $menu->description,
            'image' => $validated['image'] ?? $menu->image,
            'is_available' => $validated['stock'] > 0,
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'menu' => $menu]);
        }

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui');
    }

    public function destroy(Request $request, Menu $menu)
    {
        $menu->delete();

        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus');
    }
}
