@extends('layouts.admin')

@section('title', 'Kelola Pesanan - Furnishare Admin')

@section('content')
    <div class="mb-10">
        <h1 class="serif-logo text-3xl font-bold text-gray-900 mb-2">Manajemen Transaksi Pesanan</h1>
        <p class="text-xs text-gray-500 font-light">Tinjau pesanan furniture masuk, pantau status pembayaran/produksi, dan lakukan pembaruan status logistik.</p>
    </div>

    <!-- Orders Table Card -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-8">
        @if($orders->isEmpty())
            <div class="text-center py-16 text-xs text-gray-400 font-light">
                <i class="fa-solid fa-receipt text-4xl mb-4 block text-gray-300"></i> Belum ada pesanan masuk saat ini.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs font-light">
                    <thead>
                        <tr class="border-b border-gray-100 text-gray-400 font-bold uppercase text-[10px]">
                            <th class="py-3">Kode Order</th>
                            <th class="py-3">Nama Pembeli</th>
                            <th class="py-3">Email & Telepon</th>
                            <th class="py-3 text-center">Tanggal Pemesanan</th>
                            <th class="py-3 text-right">Total Tagihan</th>
                            <th class="py-3 text-center">Status</th>
                            <th class="py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-600">
                        @foreach($orders as $order)
                            <tr>
                                <!-- Order Code -->
                                <td class="py-4 font-mono font-bold text-[#C5A880] text-sm">
                                    {{ $order->order_code }}
                                </td>

                                <!-- Buyer Name -->
                                <td class="py-4 font-semibold text-gray-800">
                                    {{ $order->buyer_name }}
                                </td>

                                <!-- Email & Phone -->
                                <td class="py-4 text-gray-400 font-light leading-relaxed">
                                    <span class="block">{{ $order->buyer_email }}</span>
                                    <span class="block text-[10px] text-gray-500">{{ $order->buyer_phone }}</span>
                                </td>

                                <!-- Date Ordered -->
                                <td class="py-4 text-center text-gray-500">
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                    <span class="block text-[9px] text-gray-400 mt-0.5">{{ $order->created_at->diffForHumans() }}</span>
                                </td>

                                <!-- Total Invoicing -->
                                <td class="py-4 text-right font-bold text-gray-850 text-sm">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>

                                <!-- Current Status Badge -->
                                <td class="py-4 text-center">
                                    @php
                                        $badgeClass = 'bg-gray-100 text-gray-600 border-gray-200';
                                        $statusText = 'Pending';
                                        if($order->status === 'processing') {
                                            $badgeClass = 'bg-blue-50 text-blue-700 border-blue-100';
                                            $statusText = 'Diproses';
                                        } elseif($order->status === 'completed') {
                                            $badgeClass = 'bg-emerald-50 text-emerald-700 border-emerald-100';
                                            $statusText = 'Selesai';
                                        } elseif($order->status === 'cancelled') {
                                            $badgeClass = 'bg-red-50 text-red-700 border-red-100';
                                            $statusText = 'Batal';
                                        }
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-[9px] font-bold uppercase border {{ $badgeClass }}">
                                        {{ $statusText }}
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td class="py-4 text-right">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="bg-gray-100 hover:bg-[#C5A880] hover:text-white text-gray-600 px-4 py-2 rounded-lg transition text-[10px] font-bold tracking-wider uppercase inline-flex items-center">
                                        <i class="fa-solid fa-folder-open mr-1.5"></i> TINJAU
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Custom Pagination -->
            <div class="mt-8 border-t border-gray-50 pt-6">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection
