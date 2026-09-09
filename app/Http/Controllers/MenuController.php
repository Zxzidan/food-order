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
            'image_file' => 'nullable|image|max:5120',
        ]);

        $category = Category::firstOrCreate(
            ['name' => $validated['category']],
            ['slug' => Str::slug($validated['category'])]
        );

        $imagePath = $validated['image'] ?? null;
        if ($request->hasFile('image_file')) {
            $imagePath = 'storage/'.$request->file('image_file')->store('menus', 'public');
        }

        if (empty($imagePath)) {
            $imagePath = 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60';
        }

        $menu = Menu::create([
            'category_id' => $category->id,
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'description' => $validated['description'] ?? null,
            'image' => $imagePath,
            'is_available' => $validated['stock'] > 0,
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'menu' => $menu->load('category')]);
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
            'image_file' => 'nullable|image|max:5120',
        ]);

        $category = Category::firstOrCreate(
            ['name' => $validated['category']],
            ['slug' => Str::slug($validated['category'])]
        );

        $imagePath = $validated['image'] ?? $menu->image;
        if ($request->hasFile('image_file')) {
            $imagePath = 'storage/'.$request->file('image_file')->store('menus', 'public');
        }

        $menu->update([
            'category_id' => $category->id,
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'description' => $validated['description'] ?? $menu->description,
            'image' => $imagePath,
            'is_available' => $validated['stock'] > 0,
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'menu' => $menu->load('category')]);
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
