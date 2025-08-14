<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Fetch some stats for the dashboard
        $stats = [
            'users' => DB::table('users')->where('role', 'customer')->count(),
            'orders' => DB::table('orders')->count(),
            'items' => DB::table('items')->count(),
            'revenue' => DB::table('orders')->where('status', 'completed')->sum('total_amount'),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    public function settings()
    {
        $settingsRaw = DB::select('SELECT * FROM site_settings');
        $settings = [];
        foreach ($settingsRaw as $setting) {
            $settings[$setting->key] = $setting->value;
        }
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $settings = $request->except('_token');
        foreach ($settings as $key => $value) {
            DB::update('UPDATE site_settings SET value = ? WHERE `key` = ?', [$value, $key]);
        }
        return back()->with('success', 'Settings updated successfully!');
    }
    
    public function managePages()
    {
        $pageSections = DB::select('SELECT * FROM page_sections ORDER BY page_slug, sort_order');
        return view('admin.pages.index', compact('pageSections'));
    }

    public function editPageSection($id)
    {
        $section = DB::selectOne('SELECT * FROM page_sections WHERE id = ?', [$id]);
        if (!$section) abort(404);
        
        // Decode JSON content for easier editing in the form
        $section->content = json_decode($section->content, true);

        return view('admin.pages.edit', compact('section'));
    }

    public function updatePageSection(Request $request, $id)
    {
        $section = DB::selectOne('SELECT * FROM page_sections WHERE id = ?', [$id]);
        if (!$section) abort(404);

        // For simplicity, we'll just update title and subtitle.
        // A more complex implementation would handle the JSON 'content' field dynamically.
        DB::update('UPDATE page_sections SET title = ?, subtitle = ?, image_url = ?, is_active = ? WHERE id = ?', [
            $request->title,
            $request->subtitle,
            $request->image_url,
            $request->has('is_active') ? 1 : 0,
            $id
        ]);
        
        return redirect()->route('admin.pages.index')->with('success', 'Page section updated successfully!');
    }
}
