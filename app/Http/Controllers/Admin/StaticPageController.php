<?php
// app/Http/Controllers/Admin/StaticPageController.php (NEW FILE)

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StaticPageController extends Controller
{
    public function index()
    {
        $pages = DB::select('SELECT * FROM pages ORDER BY title ASC');
        return view('admin.static_pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.static_pages.create');
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255', 'content' => 'required|string']);
        DB::table('pages')->insert([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'is_published' => $request->has('is_published') ? 1 : 0,
            'created_at' => now(), 'updated_at' => now()
        ]);
        return redirect()->route('admin.static-pages.index')->with('success', 'Page created successfully.');
    }

    public function edit($id)
    {
        $page = DB::selectOne('SELECT * FROM pages WHERE id = ?', [$id]);
        return view('admin.static_pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['title' => 'required|string|max:255', 'content' => 'required|string']);
        DB::table('pages')->where('id', $id)->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'is_published' => $request->has('is_published') ? 1 : 0,
            'updated_at' => now()
        ]);
        return redirect()->route('admin.static-pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy($id)
    {
        DB::table('pages')->where('id', $id)->delete();
        return back()->with('success', 'Page deleted successfully.');
    }
}