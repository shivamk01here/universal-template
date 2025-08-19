<?php
// app/Http/Controllers/Admin/HomepageSectionController.php (NEW FILE)

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomepageSectionController extends Controller
{
    public function index()
    {
        $sections = DB::select("SELECT * FROM page_sections WHERE page_slug = 'homepage' ORDER BY sort_order ASC");
        return view('admin.pages.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'section_slug' => 'required|string|unique:page_sections,section_slug',
            'section_type' => 'required|string',
            'sort_order' => 'required|integer',
            'content' => 'nullable|string',
        ]);

        DB::table('page_sections')->insert([
            'page_slug' => 'homepage',
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'section_slug' => $request->section_slug,
            'section_type' => $request->section_type,
            'content' => $request->section_type === 'custom-html' ? $request->content : null,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'sort_order' => $request->sort_order,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Section created successfully.');
    }

    public function edit($id)
    {
        $section = DB::selectOne('SELECT * FROM page_sections WHERE id = ?', [$id]);
        return view('admin.pages.edit', compact('section'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sort_order' => 'required|integer',
            'content' => 'nullable|string',
        ]);

        DB::table('page_sections')->where('id', $id)->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $request->section_type === 'custom-html' ? $request->content : null,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'sort_order' => $request->sort_order,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Section updated successfully.');
    }

    public function destroy($id)
    {
        DB::table('page_sections')->where('id', $id)->delete();
        return back()->with('success', 'Section deleted successfully.');
    }
}