<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Store a newly created order from frontend.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_phone' => 'required|string|max:50',
            'order_type'     => 'required|string|max:100', // e.g., 'Website', 'Aplikasi', or 'Product'
            'item_name'      => 'required|string|max:255',
            'notes'          => 'nullable|string',
        ]);

        $orderData = $validated;
        // Generate unique order number
        $orderData['order_number'] = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(4));
        $orderData['status'] = 'Pending';
        $totalPrice = 0;
        if ($validated['order_type'] === 'Produk') {
            $product = \App\Models\Product::where('title', $validated['item_name'])->first();
            if ($product) {
                $totalPrice = $product->price;
            }
        }

        $orderData['total_price'] = $totalPrice;

        Order::create($orderData);

        return back()->with('order_success', 'Terima kasih, pesanan Anda telah kami terima. Tim kami akan segera menghubungi Anda melalui WhatsApp atau Email.');
    }
}
