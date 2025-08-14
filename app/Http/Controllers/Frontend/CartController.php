<?php
// app/Http/Controllers/Frontend/CartController.php (NEW - FULLY FUNCTIONAL)

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the cart page.
     */
    public function index()
    {
        $cartItems = [];
        $subTotal = 0;

        if (Auth::check()) {
            $cartItems = DB::select("SELECT c.item_id as id, i.name, i.slug, i.base_price, c.quantity, (SELECT image_url FROM item_images WHERE item_id = i.id AND is_primary = 1 LIMIT 1) as primary_image FROM carts c JOIN items i ON c.item_id = i.id WHERE c.user_id = ?", [Auth::id()]);
        } else {
            $cart = Session::get('cart', []);
            if (!empty($cart)) {
                $itemIds = array_keys($cart);
                $placeholders = implode(',', array_fill(0, count($itemIds), '?'));
                $itemsFromDb = DB::select("SELECT id, name, slug, base_price, (SELECT image_url FROM item_images WHERE item_id = items.id AND is_primary = 1 LIMIT 1) as primary_image FROM items WHERE id IN ($placeholders)", $itemIds);
                foreach($itemsFromDb as $item) {
                    $item->quantity = $cart[$item->id]['quantity'];
                    $cartItems[] = $item;
                }
            }
        }

        foreach ($cartItems as $item) {
            $item->total_price = $item->base_price * $item->quantity;
            $subTotal += $item->total_price;
        }

        return view('frontend.cart.index', compact('cartItems', 'subTotal'));
    }

    /**
     * Add an item to the cart.
     */
    public function add(Request $request, $id)
    {
        $quantity = $request->input('quantity', 1);

        if (Auth::check()) {
            $existing = DB::selectOne('SELECT * FROM carts WHERE user_id = ? AND item_id = ?', [Auth::id(), $id]);
            if ($existing) {
                DB::update('UPDATE carts SET quantity = quantity + ? WHERE id = ?', [$quantity, $existing->id]);
            } else {
                DB::insert('INSERT INTO carts (user_id, item_id, quantity) VALUES (?, ?, ?)', [Auth::id(), $id, $quantity]);
            }
        } else {
            $cart = Session::get('cart', []);
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $quantity;
            } else {
                $cart[$id] = ["quantity" => $quantity];
            }
            Session::put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Item added to cart!');
    }

    /**
     * Update item quantity in the cart.
     */
    public function update(Request $request, $id)
    {
        $quantity = $request->quantity;
        if ($quantity < 1) {
            return $this->remove($id);
        }

        if (Auth::check()) {
            DB::update('UPDATE carts SET quantity = ? WHERE user_id = ? AND item_id = ?', [$quantity, Auth::id(), $id]);
        } else {
            $cart = Session::get('cart', []);
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $quantity;
                Session::put('cart', $cart);
            }
        }
        return back()->with('success', 'Cart updated successfully!');
    }

    /**
     * Remove an item from the cart.
     */
    public function remove($id)
    {
        if (Auth::check()) {
            DB::delete('DELETE FROM carts WHERE user_id = ? AND item_id = ?', [Auth::id(), $id]);
        } else {
            $cart = Session::get('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                Session::put('cart', $cart);
            }
        }
        return back()->with('success', 'Item removed from cart.');
    }
    
    /**
     * Merge guest cart (from session) into user cart (in DB) after login.
     */
    public static function mergeGuestCartToUserCart()
    {
        $guestCart = Session::get('cart', []);
        if (empty($guestCart) || !Auth::check()) return;

        foreach ($guestCart as $itemId => $details) {
            $existingItem = DB::selectOne('SELECT * FROM carts WHERE user_id = ? AND item_id = ?', [Auth::id(), $itemId]);
            if ($existingItem) {
                DB::update('UPDATE carts SET quantity = quantity + ? WHERE id = ?', [$details['quantity'], $existingItem->id]);
            } else {
                DB::insert('INSERT INTO carts (user_id, item_id, quantity) VALUES (?, ?, ?)', [Auth::id(), $itemId, $details['quantity']]);
            }
        }
        Session::forget('cart');
    }
}