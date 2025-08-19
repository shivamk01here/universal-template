<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            'location' => 'nullable|string|max:255',
            'quote' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        $image_url = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::random(20).'_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('storage/testimonials'), $filename);
            $image_url = $filename;
        }
        DB::table('testimonials')->insert([
            'customer_name' => $request->customer_name,
            'location' => $request->location,
            'quote' => $request->quote,
            'image_url' => $image_url,
            'rating' => $request->rating,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'created_at' => now(),
        ]);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created!');
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
            'location' => 'nullable|string|max:255',
            'quote' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        $testimonial = DB::table('testimonials')->where('id', $id)->first();
        $image_url = $testimonial->image_url;
        if ($request->hasFile('image')) {
            // Optionally delete old image
            if ($image_url && file_exists(public_path('storage/testimonials/'.$image_url))) {
                @unlink(public_path('storage/testimonials/'.$image_url));
            }
            $file = $request->file('image');
            $filename = Str::random(20).'_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('storage/testimonials'), $filename);
            $image_url = $filename;
        }
        DB::table('testimonials')
            ->where('id', $id)
            ->update([
                'customer_name' => $request->customer_name,
                'location' => $request->location,
                'quote' => $request->quote,
                'image_url' => $image_url,
                'rating' => $request->rating,
                'is_active' => $request->has('is_active') ? 1 : 0,
            ]);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated!');
    }

    public function destroy($id)
    {
        DB::table('testimonials')->where('id', $id)->delete();
        return back()->with('success', 'Testimonial deleted successfully.');
    }
}