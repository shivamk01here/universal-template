<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')
            ->leftJoin('categories as parent', 'categories.parent_id', '=', 'parent.id')
            ->leftJoin('items', 'categories.id', '=', 'items.category_id')
            ->select(
                'categories.*',
                'parent.name as parent_name',
                DB::raw('COUNT(items.id) as items_count')
            )
            ->groupBy('categories.id', 'categories.name', 'categories.slug', 'categories.description', 'categories.image_url', 'categories.parent_id', 'categories.created_at', 'categories.updated_at', 'parent.name')
            ->orderBy('categories.name')
            ->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parentCategories = DB::table('categories')
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();
            
        return view('admin.categories.create', compact('parentCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'created_at' => now(),
            'updated_at' => now()
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $data['image_url'] = $imagePath;
        }

        DB::table('categories')->insert($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    public function show($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        
        if (!$category) {
            abort(404);
        }

        // Get parent category
        $parent = null;
        if ($category->parent_id) {
            $parent = DB::table('categories')->where('id', $category->parent_id)->first();
        }

        // Get children categories
        $children = DB::table('categories')->where('parent_id', $id)->get();

        // Get items in this category
        $items = DB::table('items')->where('category_id', $id)->get();

        return view('admin.categories.show', compact('category', 'parent', 'children', 'items'));
    }

    public function edit($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        
        if (!$category) {
            abort(404);
        }

        $parentCategories = DB::table('categories')
            ->whereNull('parent_id')
            ->where('id', '!=', $id)
            ->orderBy('name')
            ->get();

        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(Request $request, $id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        
        if (!$category) {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'updated_at' => now()
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($category->image_url) {
                Storage::disk('public')->delete($category->image_url);
            }
            $imagePath = $request->file('image')->store('categories', 'public');
            $data['image_url'] = $imagePath;
        }

        DB::table('categories')->where('id', $id)->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        
        if (!$category) {
            abort(404);
        }

        // Delete image if exists
        if ($category->image_url) {
            Storage::disk('public')->delete($category->image_url);
        }

        DB::table('categories')->where('id', $id)->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }
}
