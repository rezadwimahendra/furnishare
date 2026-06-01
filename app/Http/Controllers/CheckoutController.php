<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('products.index')->with('error', 'Keranjang Anda kosong.');
        }

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $totalModifier = $item->customizations['total_modifier'] ?? 0;
            $item->custom_price = $item->product->price + $totalModifier;
            $item->total_item_price = $item->custom_price * $item->quantity;
            $subtotal += $item->total_item_price;
        }

        // Add 100,000 flat delivery shipping fee for furniture
        $shippingFee = 100000;
        $total = $subtotal + $shippingFee;

        return view('checkout.index', compact('cartItems', 'subtotal', 'shippingFee', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buyer_name' => 'required|string|max:255',
            'buyer_email' => 'required|email|max:255',
            'buyer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:1000',
            'payment_method' => 'required|in:cod,midtrans',
            'ktp_image' => 'required_if:payment_method,cod|image|mimes:jpg,jpeg,png|max:2048',
            'shipping_distance' => 'nullable|numeric|min:0',
            'shipping_cost' => 'nullable|numeric|min:0',
        ]);

        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('products.index')->with('error', 'Keranjang Anda kosong.');
        }

        // 1. Calculate overall subtotal and validate stocks
        $subtotal = 0;
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return redirect()->route('cart.index')->with('error', "Stok untuk produk {$item->product->name} tidak mencukupi.");
            }

            $totalModifier = $item->customizations['total_modifier'] ?? 0;
            $item->custom_price = $item->product->price + $totalModifier;
            $item->total_item_price = $item->custom_price * $item->quantity;
            $subtotal += $item->total_item_price;
        }

        $shippingFee = 100000;
        $totalPrice = $subtotal + $shippingFee;

        $ktpImagePath = null;
        if ($request->payment_method === 'cod' && $request->hasFile('ktp_image')) {
            $ktpImagePath = $request->file('ktp_image')->store('ktp_images', 'public');
        }

        // 2. Generate unique order code
        $orderCode = 'FRN-' . date('Ymd') . '-' . strtoupper(Str::random(6));

        // 3. Create the main Order
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_code' => $orderCode,
            'buyer_name' => $request->buyer_name,
            'buyer_email' => $request->buyer_email,
            'buyer_phone' => $request->buyer_phone,
            'shipping_address' => $request->shipping_address,
            'total_price' => $totalPrice,
            'payment_method' => $request->payment_method,
            'payment_bank' => null,
            'ktp_image_path' => $ktpImagePath,
            'shipping_distance' => $request->shipping_distance,
            'shipping_cost' => $shippingFee,
            'status' => 'pending',
        ]);

        // 4. Create Order Details, decrement stocks, and clear cart
        foreach ($cartItems as $item) {
            $totalModifier = $item->customizations['total_modifier'] ?? 0;
            $finalPrice = $item->product->price + $totalModifier;

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'price' => $finalPrice,
                'quantity' => $item->quantity,
                'customizations' => $item->customizations,
            ]);

            // Decrement product stock
            $item->product->decrement('stock', $item->quantity);
        }

        if ($request->payment_method === 'midtrans') {
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
            \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

            $params = array(
                'transaction_details' => array(
                    'order_id' => $order->order_code,
                    'gross_amount' => $order->total_price,
                ),
                'customer_details' => array(
                    'first_name' => $order->buyer_name,
                    'email' => $order->buyer_email,
                    'phone' => $order->buyer_phone,
                ),
            );

            try {
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                $order->update(['snap_token' => $snapToken]);
            } catch (\Exception $e) {
                return redirect()->route('cart.index')->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
            }
        }

        // Clear cart
        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('orders.show', $orderCode)->with('success', 'Pesanan Anda berhasil dibuat!');
    }

    public function show($orderCode)
    {
        $order = Order::where('order_code', $orderCode)
            ->with(['details.product'])
            ->firstOrFail();

        // Security check: only allows order owner or admins to view details
        if (auth()->id() !== $order->user_id && !auth()->user()->is_admin) {
            abort(403, 'Anda tidak diizinkan mengakses halaman ini.');
        }

        return view('checkout.show', compact('order'));
    }

    public function history()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with(['details.product'])
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }
}
