<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Fetch cart items along with their type and service details
        $cartItems = DB::select("
            SELECT c.item_id as id, i.name, i.base_price, i.item_type, c.quantity, c.service_details 
            FROM carts c 
            JOIN items i ON c.item_id = i.id 
            WHERE c.user_id = ?
        ", [Auth::id()]);

        if (count($cartItems) === 0) {
            return redirect()->route('home')->with('error', 'Your cart is empty.');
        }

        // Decode JSON service details for display
        foreach($cartItems as $item) {
            if($item->service_details) {
                $item->service_details = json_decode($item->service_details, true);
            }
        }

        // Calculate the summary
        $summary = [];
        $summary['subtotal'] = 0;
        foreach ($cartItems as $item) {
            $summary['subtotal'] += $item->base_price * $item->quantity;
        }

        $taxRate = 0.18;
        $summary['tax'] = $summary['subtotal'] * $taxRate;
        $summary['total'] = $summary['subtotal'] + $summary['tax'];

        return view('frontend.checkout.index', compact('summary', 'cartItems'));
    }

    /**
     * Process the order placement.
     */
    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address_line_1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
        ]);

        // **FIX**: Fetch cart items from the database for the authenticated user
        $cartItems = DB::select("
            SELECT c.item_id, i.name, i.base_price, c.quantity, c.service_details 
            FROM carts c 
            JOIN items i ON c.item_id = i.id 
            WHERE c.user_id = ?
        ", [Auth::id()]);

        if (count($cartItems) === 0) {
            return redirect()->route('home')->with('error', 'Your cart is empty.');
        }

        // Calculate totals again to ensure data integrity
        $subTotal = 0;
        foreach ($cartItems as $item) {
            $subTotal += $item->base_price * $item->quantity;
        }
        $taxRate = 0.18;
        $taxAmount = $subTotal * $taxRate;
        $totalAmount = $subTotal + $taxAmount;

        // Create the address details JSON
        $addressDetails = json_encode([
            'line1' => $request->address_line_1,
            'line2' => $request->address_line_2,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
        ]);

        DB::beginTransaction();
        try {
            // Insert into orders table
            $orderId = DB::table('orders')->insertGetId([
                'user_id' => Auth::id(),
                'guest_id' => null,
                'customer_name' => $request->name,
                'customer_email' => $request->email,
                'customer_phone' => $request->phone,
                'address_details' => $addressDetails,
                'sub_total' => $subTotal,
                'total_amount' => $totalAmount,
                'payment_method' => 'cod',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $orderItemsData = [];
            foreach ($cartItems as $item) {
                $orderItemsData[] = [
                    'order_id' => $orderId,
                    'item_id' => $item->item_id,
                    'item_name' => $item->name,
                    'price' => $item->base_price,
                    'quantity' => $item->quantity,
                    'service_details' => $item->service_details // Persist the JSON details to the order
                ];
            }
            DB::table('order_items')->insert($orderItemsData);
            DB::table('carts')->where('user_id', Auth::id())->delete();
            DB::commit();
            return redirect()->route('checkout.success');

        } catch (\Exception $e) {
            DB::rollBack(); // Something went wrong, rollback
            return back()->with('error', 'An error occurred while placing your order. Please try again.');
        }
    }

    /**
     * Display the order success page.
     */
    public function success()
    {
        return view('frontend.checkout.success');
    }
}
