<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        
        // Sum total revenue from completed orders
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');

        // Recent orders
        $recentOrders = Order::latest()->take(5)->get();

        // Order status count for analytical statistics
        $stats = [
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalProducts', 
            'totalCategories', 
            'totalOrders', 
            'totalRevenue', 
            'recentOrders', 
            'stats'
        ));
    }

    public function orders()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function orderShow($id)
    {
        $order = Order::with('details')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function orderUpdateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->route('admin.orders.show', $order->id)->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
