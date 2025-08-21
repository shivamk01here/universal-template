<?php
// app/Http/Controllers/Frontend/HomeController.php (UPDATED)

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display the homepage with dynamic sections.
     */
    public function index()
    {
        $pageSectionsRaw = DB::select('SELECT * FROM page_sections WHERE page_slug = "homepage" AND is_active = 1 ORDER BY sort_order ASC');
        
        $pageSections = [];
        foreach ($pageSectionsRaw as $section) {
            $section->content = json_decode($section->content, true);
            $pageSections[$section->section_slug] = $section;
        }

        $featuredServices = DB::select("
            SELECT i.id, i.name, i.slug, i.base_price, i.item_type, 
                   (SELECT image_url FROM item_images WHERE item_id = i.id AND is_primary = 1 LIMIT 1) as primary_image,
                   (SELECT AVG(rating) FROM reviews WHERE item_id = i.id) as avg_rating
            FROM items i
            WHERE i.is_featured = 1 AND i.is_active = 1 AND i.item_type = 'SERVICE'
            LIMIT 4
        ");

        $featuredProducts = DB::select("
            SELECT i.id, i.name, i.slug, i.base_price, i.item_type, 
                   (SELECT image_url FROM item_images WHERE item_id = i.id AND is_primary = 1 LIMIT 1) as primary_image,
                   (SELECT AVG(rating) FROM reviews WHERE item_id = i.id) as avg_rating
            FROM items i
            WHERE i.is_featured = 1 AND i.is_active = 1 AND i.item_type = 'PRODUCT'
            LIMIT 4
        ");

        $testimonials = DB::table('testimonials')
        ->where('is_active', 1)
        ->orderBy('created_at', 'desc')
        ->get();

        $blogs = DB::table('blogs')
        ->where('is_published', 1) 
        ->orderBy('id', 'desc') 
        ->limit(5) 
        ->get();

        $faqs = DB::select('SELECT * FROM faqs WHERE is_active = 1 ORDER BY sort_order ASC LIMIT 5');

        return view('frontend.home', compact('pageSections', 'featuredServices', 'featuredProducts', 'faqs', 'testimonials', 'blogs'));
    }

    public function subscribeNewsletter(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        // Here you would add the logic to save the email to a database table or a third-party service.
        // For now, we'll just redirect back with a success message.
        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }

    public function custom($slug){
        
    }


    public function custom1()
    {
        
        $active_homepage = DB::selectOne('SELECT id FROM homepages WHERE is_active = ?', [1]);
        if (!$active_homepage) {
            return view('welcome-error', ['message' => 'No active homepage has been configured.']);
        }

        $sections = DB::select('SELECT * FROM homepage_sections WHERE homepage_id = ? AND is_visible = 1 ORDER BY display_order ASC', [$active_homepage->id]);

        foreach ($sections as $section) {
            $section->content = json_decode($section->content);
        }
        
        $dynamicData = [
            'testimonials' => DB::select('SELECT * FROM testimonials WHERE is_published = 1'),
            'faqs' => DB::select('SELECT * FROM faqs WHERE is_published = 1'),
            'blogs' => DB::select('SELECT * FROM blogs ORDER BY published_at DESC LIMIT 3'),
            'products' => DB::select('SELECT * FROM products WHERE is_published = 1'),
            'services' => DB::select('SELECT * FROM services WHERE is_published = 1'),
        ];

        return view('welcome', array_merge(['sections' => $sections], $dynamicData));


        $featuredItems = DB::select("SELECT 
            i.id, i.name, i.slug, i.base_price, i.item_type,
            img.image_url AS primary_image,
            AVG(r.rating) AS avg_rating
        FROM items i
        LEFT JOIN item_images img ON img.item_id = i.id AND img.is_primary = 1
        LEFT JOIN reviews r ON r.item_id = i.id
        WHERE i.is_featured = 1 
        AND i.is_active = 1
        AND i.item_type IN ('SERVICE', 'PRODUCT')
        GROUP BY i.id, img.image_url, i.name, i.slug, i.base_price, i.item_type
        ORDER BY i.item_type, i.id
        ");

        $featuredServices = array_slice(array_filter($featuredItems, fn($item) => $item->item_type === 'SERVICE'), 0, 4);
        $featuredProducts = array_slice(array_filter($featuredItems, fn($item) => $item->item_type === 'PRODUCT'), 0, 4);
        $testimonials = DB::table('testimonials') ->where('is_active', 1)->orderBy('created_at', 'desc')->take(5)->get();
        $blogs = DB::table('blogs')->where('is_published', 1)->orderBy('id', 'desc')->take(5)->get();
        $faqs = DB::table('faqs')->where('is_active', 1)->orderBy('sort_order', 'asc')->take(5)->get();
        return view('frontend.home', compact('pageSections', 'featuredServices', 'featuredProducts', 'faqs', 'testimonials', 'blogs'));
    }
}