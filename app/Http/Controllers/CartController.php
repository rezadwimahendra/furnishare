<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        $subtotal = 0;
        foreach ($cartItems as $item) {
            // Recalculate price based on customization modifiers
            $item->custom_price = $this->calculateCustomPrice($item->product->price, $item->customizations);
            $item->total_item_price = $item->custom_price * $item->quantity;
            $subtotal += $item->total_item_price;
        }

        return view('cart.index', compact('cartItems', 'subtotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'color' => 'nullable|string',
            'foam_color' => 'nullable|string',
            'material' => 'nullable|string',
            'size' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);
        
        // 1. Gather customization details
        $customizations = [
            'color' => $request->input('color'),
            'foam_color' => $request->input('foam_color'),
            'material' => $request->input('material'),
            'size' => $request->input('size'),
        ];

        // 2. Fetch price modifiers from product's custom options JSON
        $modifiers = $this->getPriceModifiers($product, $customizations);
        $customizations['material_price_modifier'] = $modifiers['material_modifier'];
        $customizations['size_price_modifier'] = $modifiers['size_modifier'];
        $customizations['total_modifier'] = $modifiers['total_modifier'];

        // Check if an item with the EXACT same configurations is already in the cart
        $existingCart = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->get()
            ->filter(function($cart) use ($customizations) {
                // Compare color, material, and size
                $c1 = $cart->customizations;
                return ($c1['color'] ?? null) === ($customizations['color'] ?? null) &&
                       ($c1['foam_color'] ?? null) === ($customizations['foam_color'] ?? null) &&
                       ($c1['material'] ?? null) === ($customizations['material'] ?? null) &&
                       ($c1['size'] ?? null) === ($customizations['size'] ?? null);
            })
            ->first();

        if ($existingCart) {
            $newQuantity = $existingCart->quantity + $request->quantity;
            if ($newQuantity > $product->stock) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi untuk jumlah tersebut.');
            }
            $existingCart->update(['quantity' => $newQuantity]);
        } else {
            if ($request->quantity > $product->stock) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi.');
            }

            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'customizations' => $customizations,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::where('user_id', auth()->id())->findOrFail($id);
        $product = $cart->product;

        if ($request->quantity > $product->stock) {
            return response()->json([
                'success' => false,
                'message' => 'Stok produk tidak mencukupi.'
            ], 422);
        }

        $cart->update(['quantity' => $request->quantity]);

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil diperbarui.'
        ]);
    }

    public function destroy($id)
    {
        $cart = Cart::where('user_id', auth()->id())->findOrFail($id);
        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    // Helper to calculate price based on custom options modifiers
    private function calculateCustomPrice($basePrice, $customizations)
    {
        $totalModifier = $customizations['total_modifier'] ?? 0;
        return $basePrice + $totalModifier;
    }

    // Helper to extract modifiers based on chosen properties
    private function getPriceModifiers($product, $customizations)
    {
        $options = $product->custom_options;
        $materialModifier = 0;
        $sizeModifier = 0;

        if ($options) {
            // Find material modifier
            if (!empty($customizations['material']) && !empty($options['materials'])) {
                foreach ($options['materials'] as $mat) {
                    if ($mat['name'] === $customizations['material']) {
                        $materialModifier = $mat['price_modifier'];
                        break;
                    }
                }
            }

            // Find size modifier
            if (!empty($customizations['size']) && !empty($options['sizes'])) {
                foreach ($options['sizes'] as $sz) {
                    if ($sz['name'] === $customizations['size']) {
                        $sizeModifier = $sz['price_modifier'];
                        break;
                    }
                }
            }
        }

        return [
            'material_modifier' => $materialModifier,
            'size_modifier' => $sizeModifier,
            'total_modifier' => $materialModifier + $sizeModifier
        ];
    }
}
