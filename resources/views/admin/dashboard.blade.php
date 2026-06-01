@extends('layouts.admin')

@section('title', 'Ringkasan Bisnis - Furnishare Admin')

@section('content')
    <div class="mb-10">
        <h1 class="serif-logo text-3xl font-bold text-gray-900 mb-2">Ringkasan Operasional Bisnis</h1>
        <p class="text-xs text-gray-500 font-light">Ringkasan total statistik penjualan, manajemen inventory, dan transaksi pesanan furniture masuk.</p>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <!-- Revenue Card -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="h-12 w-12 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-lg">
                <i class="fa-solid fa-money-bill-trend-up"></i>
            </div>
            <div>
                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider block">Total Pendapatan</span>
                <span class="text-lg font-bold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="h-12 w-12 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center text-lg">
                <i class="fa-solid fa-dolly"></i>
            </div>
            <div>
                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider block">Total Pesanan</span>
                <span class="text-lg font-bold text-gray-900">{{ $totalOrders }} Pesanan</span>
            </div>
        </div>

        <!-- Products Card -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="h-12 w-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center text-lg">
                <i class="fa-solid fa-couch"></i>
            </div>
            <div>
                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider block">Total Furniture</span>
                <span class="text-lg font-bold text-gray-900">{{ $totalProducts }} Produk</span>
            </div>
        </div>

        <!-- Categories Card -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="h-12 w-12 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center text-lg">
                <i class="fa-solid fa-layer-group"></i>
            </div>
            <div>
                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider block">Total Kategori</span>
                <span class="text-lg font-bold text-gray-900">{{ $totalCategories }} Ruang</span>
            </div>
        </div>
    </div>

    <!-- Middle Info: Analytics Status and Recent Orders -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left: Status Breakdown (1 Column) -->
        <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm space-y-6">
            <h3 class="serif-logo text-base font-bold text-gray-900">Pembagian Status Transaksi</h3>
            <div class="w-8 h-0.5 bg-[#C5A880]"></div>

            <div class="space-y-4 text-xs font-semibold">
                <div class="flex justify-between items-center p-3.5 bg-gray-50 rounded-xl">
                    <span class="text-gray-500 flex items-center"><i class="fa-solid fa-receipt mr-2 text-gray-400"></i> Menunggu Konfirmasi (Pending)</span>
                    <span class="bg-gray-200 text-gray-700 px-2.5 py-0.5 rounded text-[10px]">{{ $stats['pending'] }}</span>
                </div>
                <div class="flex justify-between items-center p-3.5 bg-blue-50/50 rounded-xl text-blue-800">
                    <span class="flex items-center"><i class="fa-solid fa-hammer mr-2 text-blue-400"></i> Diproduksi / Dikemas (Processing)</span>
                    <span class="bg-blue-100 px-2.5 py-0.5 rounded text-[10px]">{{ $stats['processing'] }}</span>
                </div>
                <div class="flex justify-between items-center p-3.5 bg-emerald-50/50 rounded-xl text-emerald-800">
                    <span class="flex items-center"><i class="fa-solid fa-circle-check mr-2 text-emerald-400"></i> Sampai & Selesai (Completed)</span>
                    <span class="bg-emerald-100 px-2.5 py-0.5 rounded text-[10px]">{{ $stats['completed'] }}</span>
                </div>
                <div class="flex justify-between items-center p-3.5 bg-red-50/50 rounded-xl text-red-800">
                    <span class="flex items-center"><i class="fa-solid fa-ban mr-2 text-red-400"></i> Dibatalkan (Cancelled)</span>
                    <span class="bg-red-100 px-2.5 py-0.5 rounded text-[10px]">{{ $stats['cancelled'] }}</span>
                </div>
            </div>
        </div>

        <!-- Right: Recent Activity Orders (2 Columns) -->
        <div class="lg:col-span-2 bg-white p-8 rounded-2xl border border-gray-100 shadow-sm space-y-6">
            <div class="flex justify-between items-center">
                <h3 class="serif-logo text-base font-bold text-gray-900">Daftar Transaksi Terbaru</h3>
                <a href="{{ route('admin.orders.index') }}" class="text-[10px] font-bold tracking-widest text-[#C5A880] uppercase hover:underline">Kelola Semua Pesanan</a>
            </div>
            <div class="w-8 h-0.5 bg-[#C5A880]"></div>

            @if($recentOrders->isEmpty())
                <div class="text-center py-12 text-xs text-gray-400 font-light">
                    <i class="fa-solid fa-receipt text-3xl mb-3 block text-gray-300"></i> Belum ada transaksi pesanan masuk saat ini.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs font-light">
                        <thead>
                            <tr class="border-b border-gray-100 text-gray-400 font-bold uppercase text-[10px]">
                                <th class="py-3">Kode Order</th>
                                <th class="py-3">Nama Pembeli</th>
                                <th class="py-3 text-right">Total Tagihan</th>
                                <th class="py-3 text-center">Status</th>
                                <th class="py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-gray-600">
                            @foreach($recentOrders as $order)
                                <tr>
                                    <td class="py-4 font-mono font-bold text-[#C5A880]">{{ $order->order_code }}</td>
                                    <td class="py-4 font-medium text-gray-800">{{ $order->buyer_name }}</td>
                                    <td class="py-4 text-right font-bold text-gray-800">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td class="py-4 text-center">
                                        @php
                                            $badgeClass = 'bg-gray-100 text-gray-600';
                                            if($order->status === 'processing') $badgeClass = 'bg-blue-100 text-blue-700';
                                            if($order->status === 'completed') $badgeClass = 'bg-emerald-100 text-emerald-700';
                                            if($order->status === 'cancelled') $badgeClass = 'bg-red-100 text-red-700';
                                        @endphp
                                        <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase {{ $badgeClass }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="py-4 text-right">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="bg-gray-100 hover:bg-[#C5A880] hover:text-white text-gray-600 px-3 py-1 rounded transition text-[10px] font-bold">TINJAU</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
@endsection
