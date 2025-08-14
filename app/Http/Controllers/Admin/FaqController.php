<?php
// app/Http/Controllers/Admin/FaqController.php (NEW)
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class FaqController extends Controller {
    public function index() {
        $faqs = DB::select('SELECT * FROM faqs ORDER BY sort_order ASC');
        return view('admin.faqs.index', compact('faqs'));
    }
    public function create() {
        return view('admin.faqs.create');
    }
    public function store(Request $request) {
        $request->validate(['question' => 'required|string|max:255', 'answer' => 'required|string']);
        DB::table('faqs')->insert($request->except('_token'));
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created.');
    }
    public function edit($id) {
        $faq = DB::selectOne('SELECT * FROM faqs WHERE id = ?', [$id]);
        return view('admin.faqs.edit', compact('faq'));
    }
    public function update(Request $request, $id) {
        $request->validate(['question' => 'required|string|max:255', 'answer' => 'required|string']);
        DB::table('faqs')->where('id', $id)->update($request->except(['_token', '_method']));
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated.');
    }
    public function destroy($id) {
        DB::table('faqs')->where('id', $id)->delete();
        return back()->with('success', 'FAQ deleted.');
    }
}
