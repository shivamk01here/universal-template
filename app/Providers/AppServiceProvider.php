<?php
// app/Providers/AppServiceProvider.php (UPDATE THE BOOT METHOD)

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $siteSettings = [];
            if (Schema::hasTable('site_settings')) {
                $settingsRaw = DB::select('SELECT * FROM site_settings');
                foreach ($settingsRaw as $setting) {
                    $siteSettings[$setting->key] = $setting->value;
                }
            }
            
            $cartCount = 0;
            if (Auth::check()) {
                $cartCount = DB::table('carts')->where('user_id', Auth::id())->sum('quantity');
            } else {
                $cart = Session::get('cart', []);
                $cartCount = count($cart); // For guests, we count unique items
            }

            $staticPages = [];
            if (Schema::hasTable('pages')) {
                $staticPages = DB::select('SELECT title, slug FROM pages WHERE is_published = 1');
            }

            $view->with('siteSettings', $siteSettings)->with('staticPages', $staticPages)->with('cartCount', $cartCount);
        });
    }
}