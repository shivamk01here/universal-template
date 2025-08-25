<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomepageController extends Controller
{
    public function index()
    {
        $active_homepage = DB::selectOne('SELECT id FROM homepages WHERE is_active = ?', [1]);
        $sections = DB::select('SELECT * FROM homepage_sections WHERE homepage_id = ? ORDER BY display_order ASC', [$active_homepage->id]);
        return view('admin.homepage.index', ['sections' => $sections]);
    }

    public function create()
    {
        return view('admin.homepage.create');
    }

    public function store(Request $request)
    {
        $request->validate(['section_slug' => 'required|string|regex:/^[a-z0-9\-]+$/', 'template_id' => 'required|string', 'content_json' => 'required|json']);
        $active_homepage = DB::selectOne('SELECT id FROM homepages WHERE is_active = ?', [1]);
        $max_order = DB::selectOne('SELECT MAX(display_order) as max_order FROM homepage_sections WHERE homepage_id = ?', [$active_homepage->id]);
        DB::insert('INSERT INTO homepage_sections (homepage_id, section_slug, template_id, display_order, content, is_visible) VALUES (?, ?, ?, ?, ?, ?)', [$active_homepage->id, Str::slug($request->input('section_slug')), $request->input('template_id'), ($max_order->max_order ?? -1) + 1, $request->input('content_json'), $request->input('is_visible', 1)]);
        return redirect()->route('admin.homepage-sections.index')->with('success', 'New section added!');
    }

    public function edit($id)
    {
        $section = DB::selectOne('SELECT * FROM homepage_sections WHERE id = ?', [$id]);
        abort_if(!$section, 404);
        $section->content_array = json_decode($section->content, true);
        return view('admin.homepage.edit', ['section' => $section]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['content_json' => 'required|json']);
        DB::update('UPDATE homepage_sections SET template_id = ?, content = ?, is_visible = ? WHERE id = ?', [$request->input('template_id'), $request->input('content_json'), $request->input('is_visible', 0), $id]);
        return redirect()->route('admin.homepage-sections.index')->with('success', 'Section updated!');
    }
    
    public function destroy($id)
    {
        DB::delete('DELETE FROM homepage_sections WHERE id = ?', [$id]);
        return redirect()->route('admin.homepage-sections.index')->with('success', 'Section deleted.');
    }

    public function updateOrder(Request $request)
    {
        $sectionIds = $request->input('order');
        if (empty($sectionIds)) return response()->json(['status' => 'error'], 400);
        foreach ($sectionIds as $index => $id) {
            DB::update('UPDATE homepage_sections SET display_order = ? WHERE id = ?', [$index, $id]);
        }
        return response()->json(['status' => 'success']);
    }

    public function toggleVisibility(Request $request, $id)
    {
        $section = DB::selectOne('SELECT is_visible FROM homepage_sections WHERE id = ?', [$id]);
        if ($section) {
            $newVisibility = !$section->is_visible;
            DB::update('UPDATE homepage_sections SET is_visible = ? WHERE id = ?', [$newVisibility, $id]);
            return response()->json(['status' => 'success', 'is_visible' => $newVisibility]);
        }
        return response()->json(['status' => 'error', 'message' => 'Section not found.'], 404);
    }
}
