<?php
// app/Http/Controllers/Frontend/AccountController.php (NEW FILE)

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{

    public function profile()
    {
        return view('frontend.account.profile', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => now(),
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $user->id)->update($updateData);

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Display the user's order history.
     */
    public function orders()
    {
        $userId = Auth::id();
        $orders = DB::select('
            SELECT * FROM orders 
            WHERE user_id = ? 
            ORDER BY created_at DESC
        ', [$userId]);

        foreach ($orders as $order) {
            $order->items = DB::select('
                SELECT item_name, quantity, price 
                FROM order_items 
                WHERE order_id = ?
            ', [$order->id]);
        }

        return view('frontend.account.orders', compact('orders'));
    }
    /**
     * Display the user's order history.
     */
    public function orderHistory()
    {
        $userId = Auth::id();
        $orders = DB::select('
            SELECT * FROM orders 
            WHERE user_id = ? 
            ORDER BY created_at DESC
        ', [$userId]);

        foreach ($orders as $order) {
            $order->items = DB::select('
                SELECT item_name, quantity, price 
                FROM order_items 
                WHERE order_id = ?
            ', [$order->id]);
        }

        return view('frontend.account.orders', compact('orders'));
    }
}