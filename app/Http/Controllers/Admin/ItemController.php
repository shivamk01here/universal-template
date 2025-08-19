<?php
// app/Http/Controllers/Admin/ItemController.php (UPDATED)

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    public function index()
    {
        $items = DB::select('SELECT i.*, c.name as category_name FROM items i JOIN categories c ON i.category_id = c.id ORDER BY i.created_at DESC');
        return view('admin.items.index', compact('items'));
    }

    public function create()
    {
        $categories = DB::select('SELECT * FROM categories ORDER BY name ASC');
        $attributes = DB::select('SELECT * FROM attributes ORDER BY name ASC');
        return view('admin.items.create', compact('categories', 'attributes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'base_price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Validate images
        ]);

        DB::beginTransaction();
        try {
            $itemId = DB::table('items')->insertGetId([
                'name' => $request->name,
                'slug' => Str::slug($request->name) . '-' . uniqid(),
                'description' => $request->description,
                'short_description' => $request->short_description,
                'base_price' => $request->base_price,
                'category_id' => $request->category_id,
                'item_type' => $request->item_type,
                'is_featured' => $request->has('is_featured') ? 1 : 0,
                'is_active' => $request->has('is_active') ? 1 : 0,
                'created_at' => now(), 'updated_at' => now(),
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $image) {
                    $path = $image->store('public/items');
                    DB::table('item_images')->insert([
                        'item_id' => $itemId,
                        'image_url' => Storage::url($path),
                        'is_primary' => $key == 0 ? 1 : 0, // Make the first uploaded image primary
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.items.index')->with('success', 'Item created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error creating item: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $item = DB::selectOne('SELECT * FROM items WHERE id = ?', [$id]);
        if (!$item) abort(404);

        $categories = DB::select('SELECT * FROM categories ORDER BY name ASC');
        $attributes = DB::select('SELECT * FROM attributes ORDER BY name ASC');
        $item->images = DB::select('SELECT * FROM item_images WHERE item_id = ?', [$id]);
        
        $itemAttributesRaw = DB::select('SELECT attribute_id, value FROM item_attributes WHERE item_id = ?', [$id]);
        $item->attributes = array_column($itemAttributesRaw, 'value', 'attribute_id');

        return view('admin.items.edit', compact('item', 'categories', 'attributes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'base_price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        DB::beginTransaction();
        try {
            DB::table('items')->where('id', $id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'short_description' => $request->short_description,
                'base_price' => $request->base_price,
                'category_id' => $request->category_id,
                'item_type' => $request->item_type,
                'is_featured' => $request->has('is_featured') ? 1 : 0,
                'is_active' => $request->has('is_active') ? 1 : 0,
                'updated_at' => now(),
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('public/items');
                    DB::table('item_images')->insert([
                        'item_id' => $id,
                        'image_url' => Storage::url($path),
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.items.edit', $id)->with('success', 'Item updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error updating item: ' . $e->getMessage())->withInput();
        }
    }

    public function destroyImage($imageId)
    {
        $image = DB::selectOne('SELECT * FROM item_images WHERE id = ?', [$imageId]);
        if ($image) {
            // Convert URL back to storage path
            $path = str_replace('/storage', 'public', $image->image_url);
            Storage::delete($path);
            DB::delete('DELETE FROM item_images WHERE id = ?', [$imageId]);
            return response()->json(['success' => 'Image deleted successfully.']);
        }
        return response()->json(['error' => 'Image not found.'], 404);
    }
}