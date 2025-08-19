<?php
// app/Http/Controllers/Admin/BlogController.php (NEW)
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class BlogController extends Controller {
    public function index() {
        $blogs = DB::select('SELECT * FROM blogs ORDER BY created_at DESC');
        return view('admin.blogs.index', compact('blogs'));
    }
    public function create() {
        return view('admin.blogs.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // ensure blogs/ directory exists in public/storage
            $filename = Str::random(20) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/blogs'), $filename);
            $image = $filename;
        }

        DB::table('blogs')->insert([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $image,
            'is_published' => $request->has('is_published') ? 1 : 0,
            'created_at' => now(),
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created.');
    }

    public function edit($id) {
        $blog = DB::selectOne('SELECT * FROM blogs WHERE id = ?', [$id]);
        return view('admin.blogs.edit', compact('blog'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $blog = DB::table('blogs')->where('id', $id)->first();
        $image = $blog->image;
        if ($request->hasFile('image')) {
            // Optionally delete old image
            if ($image && file_exists(public_path('storage/blogs/' . $image))) {
                @unlink(public_path('storage/blogs/' . $image));
            }
            $file = $request->file('image');
            $filename = Str::random(20) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/blogs'), $filename);
            $image = $filename;
        }

        DB::table('blogs')->where('id', $id)->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $image,
            'is_published' => $request->has('is_published') ? 1 : 0,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated.');
    }

    public function destroy($id) {
        DB::table('blogs')->where('id', $id)->delete();
        return back()->with('success', 'Blog post deleted.');
    }
}