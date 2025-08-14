<?php
// app/Http/Controllers/Frontend/BlogController.php (NEW)
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class BlogController extends Controller {
    public function index() {
        $blogs = DB::select('SELECT * FROM blogs WHERE is_published = 1 ORDER BY created_at DESC');
        return view('frontend.blogs.index', compact('blogs'));
    }
    public function show($slug) {
        $blog = DB::selectOne('SELECT * FROM blogs WHERE slug = ? AND is_published = 1', [$slug]);
        if (!$blog) abort(404);
        return view('frontend.blogs.show', compact('blog'));
    }
}