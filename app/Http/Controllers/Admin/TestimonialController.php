<?php
// app/Http/Controllers/Admin/TestimonialController.php (NEW FILE)

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = DB::select('SELECT * FROM testimonials ORDER BY created_at DESC');
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'quote' => 'required|string',
        ]);
        DB::table('testimonials')->insert($request->except('_token'));
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added successfully.');
    }

    public function edit($id)
    {
        $testimonial = DB::selectOne('SELECT * FROM testimonials WHERE id = ?', [$id]);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'quote' => 'required|string',
        ]);
        DB::table('testimonials')->where('id', $id)->update($request->except(['_token', '_method']));
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy($id)
    {
        DB::table('testimonials')->where('id', $id)->delete();
        return back()->with('success', 'Testimonial deleted successfully.');
    }
}