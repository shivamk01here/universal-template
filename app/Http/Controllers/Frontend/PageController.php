<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    /**
     * Display a static page.
     */
    public function show($slug)
    {
        $page = DB::selectOne('SELECT * FROM pages WHERE slug = ? AND is_published = 1', [$slug]);

        if (!$page) {
            abort(404);
        }
        return view('frontend.page', compact('page'));
    }
}