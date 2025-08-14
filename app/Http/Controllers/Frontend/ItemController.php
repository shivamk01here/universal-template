<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class ItemController extends Controller
{
    /**
     * Display a paginated list of all active items (products and services).
     * Includes filtering capabilities.
     */
    public function index(Request $request)
    {
        // Base query to fetch items with their primary image and category
        $query = "
            SELECT i.*, c.name as category_name, 
                   (SELECT image_url FROM item_images WHERE item_id = i.id AND is_primary = 1 LIMIT 1) as primary_image
            FROM items i
            JOIN categories c ON i.category_id = c.id
            WHERE i.is_active = 1
        ";

        $bindings = [];

        // Handle search query
        if ($request->has('search')) {
            $query .= " AND (i.name LIKE ? OR i.description LIKE ?)";
            $bindings[] = '%' . $request->search . '%';
            $bindings[] = '%' . $request->search . '%';
        }

        // Handle sorting
        $sortOrder = ' ORDER BY i.created_at DESC';
        if ($request->has('sort')) {
            if ($request->sort == 'price_asc') $sortOrder = ' ORDER BY i.base_price ASC';
            if ($request->sort == 'price_desc') $sortOrder = ' ORDER BY i.base_price DESC';
            if ($request->sort == 'name_asc') $sortOrder = ' ORDER BY i.name ASC';
        }
        $query .= $sortOrder;

        $items = DB::select($query, $bindings);
        $categories = DB::select('SELECT * FROM categories ORDER BY name ASC');

        return view('frontend.items.index', compact('items', 'categories'));
    }

    /**
     * Display items belonging to a specific category.
     */
    public function indexByCategory($slug)
    {
        $category = DB::selectOne('SELECT * FROM categories WHERE slug = ?', [$slug]);

        if (!$category) {
            abort(404);
        }

        $items = DB::select('
            SELECT i.*, c.name as category_name, 
                   (SELECT image_url FROM item_images WHERE item_id = i.id AND is_primary = 1 LIMIT 1) as primary_image
            FROM items i
            JOIN categories c ON i.category_id = c.id
            WHERE i.is_active = 1 AND i.category_id = ?
            ORDER BY i.created_at DESC
        ', [$category->id]);
        
        $categories = DB::select('SELECT * FROM categories ORDER BY name ASC');

        return view('frontend.items.index', compact('items', 'categories', 'category'));
    }

    /**
     * Display the detail page for a single item.
     */
    public function show($slug)
    {
        $item = DB::selectOne('SELECT * FROM items WHERE slug = ? AND is_active = 1', [$slug]);

        if (!$item) {
            abort(404);
        }

        // Fetch item images
        $item->images = DB::select('SELECT * FROM item_images WHERE item_id = ?', [$item->id]);

        // Fetch item attributes with attribute names
        $item->attributes = DB::select('
            SELECT ia.value, a.name 
            FROM item_attributes ia
            JOIN attributes a ON ia.attribute_id = a.id
            WHERE ia.item_id = ?
        ', [$item->id]);

        // Fetch reviews with user names
        $item->reviews = DB::select('
            SELECT r.*, u.name as user_name 
            FROM reviews r
            JOIN users u ON r.user_id = u.id
            WHERE r.item_id = ?
            ORDER BY r.created_at DESC
        ', [$item->id]);

        return view('frontend.items.show', compact('item'));
    }

    public function storeReview(Request $request, $itemId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // A simple check to prevent duplicate reviews, can be made more robust
        $existingReview = DB::selectOne('SELECT id FROM reviews WHERE item_id = ? AND user_id = ?', [$itemId, Auth::id()]);

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this item.');
        }

        DB::table('reviews')->insert([
            'item_id' => $itemId,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Thank you! Your review has been submitted.');
    }


    private function paginate(Collection $results, $perPage = 9)
    {
        $page = Paginator::resolveCurrentPage('page');
        $total = $results->count();
        return new LengthAwarePaginator($results->forPage($page, $perPage), $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
    }
}
