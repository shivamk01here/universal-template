<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class FaqController extends Controller {
    public function index() {
        $faqs = DB::select('SELECT * FROM faqs WHERE is_active = 1 ORDER BY sort_order ASC');
        return view('frontend.faq', compact('faqs'));
    }
}