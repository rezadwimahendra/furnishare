@extends('layouts.admin')

@section('title', 'Tinjau Transaksi ' . $order->order_code . ' - Furnishare Admin')

@section('content')
    <div class="mb-10">
        <a href="{{ route('admin.orders.index') }}" class="text-xs text-gray-400 hover:text-gray-600 transition mb-3 inline-block">
            <i class="fa-solid fa-arrow-left-long mr-1"></i> Kembali ke Daftar Pesanan
        </a>
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="serif-logo text-3xl font-bold text-gray-900">Pesanan {{ $order->order_code }}</h1>
                <p class="text-xs text-gray-500 font-light mt-1">Dipesan pada {{ $order->created_at->format('d F Y, H:i') }} ({{ $order->created_at->diffForHumans() }})</p>
            </div>
            
            <!-- Current Status Label -->
            @php
                $badgeClass = 'bg-gray-150 text-gray-700 border-gray-250';
                $statusText = 'Pending';
                if($order->status === 'processing') {
                    $badgeClass = 'bg-blue-100 text-blue-800 border-blue-200';
                    $statusText = 'Diproses / Diproduksi';
                } elseif($order->status === 'completed') {
                    $badgeClass = 'bg-emerald-100 text-emerald-800 border-emerald-200';
                    $statusText = 'Transaksi Selesai';
                } elseif($order->status === 'cancelled') {
                    $badgeClass = 'bg-red-100 text-red-800 border-red-200';
                    $statusText = 'Pesanan Batal';
                }
            @endphp
            <span class="px-4 py-2 rounded-full text-xs font-bold uppercase border shadow-sm {{ $badgeClass }}">
                Status: {{ $statusText }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Pane: Items List & Processing Progress (2 Columns) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Timeline Tracker -->
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
                <h3 class="serif-logo text-sm font-bold text-gray-900 mb-6">Status Alur Pemrosesan Pesanan</h3>
                
                <div class="relative flex justify-between items-center w-full">
                    <!-- Progress Bar Track -->
                    <div class="absolute left-0 right-0 top-1/2 -translate-y-1/2 h-1 bg-gray-100 z-0"></div>
                    
                    @php
                        $isPending = true;
                        $isProcessing = $order->status === 'processing' || $order->status === 'completed';
                        $isCompleted = $order->status === 'completed';
                        $isCancelled = $order->status === 'cancelled';
                    @endphp

                    <!-- Step 1: Pending -->
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="h-10 w-10 rounded-full flex items-center justify-center text-xs font-bold {{ $isPending && !$isCancelled ? 'bg-[#1A1A1A] text-white' : 'bg-gray-100 text-gray-400' }} shadow transition">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                        <span class="text-[10px] font-bold text-gray-800 mt-2 block uppercase tracking-wider">Pending</span>
                    </div>

                    <!-- Step 2: Processing -->
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="h-10 w-10 rounded-full flex items-center justify-center text-xs font-bold {{ $isProcessing && !$isCancelled ? 'bg-[#C5A880] text-white' : 'bg-gray-100 text-gray-400' }} shadow transition">
                            <i class="fa-solid fa-hammer animate-pulse"></i>
                        </div>
                        <span class="text-[10px] font-bold {{ $isProcessing && !$isCancelled ? 'text-gray-800' : 'text-gray-400' }} mt-2 block uppercase tracking-wider">Diproduksi</span>
                    </div>

                    <!-- Step 3: Completed / Cancelled -->
                    @if($isCancelled)
                        <div class="relative z-10 flex flex-col items-center">
                            <div class="h-10 w-10 rounded-full bg-red-500 text-white flex items-center justify-center text-xs font-bold shadow">
                                <i class="fa-solid fa-ban"></i>
                            </div>
                            <span class="text-[10px] font-bold text-red-600 mt-2 block uppercase tracking-wider">Dibatalkan</span>
                        </div>
                    @else
                        <div class="relative z-10 flex flex-col items-center">
                            <div class="h-10 w-10 rounded-full flex items-center justify-center text-xs font-bold {{ $isCompleted ? 'bg-emerald-500 text-white' : 'bg-gray-100 text-gray-400' }} shadow transition">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <span class="text-[10px] font-bold {{ $isCompleted ? 'text-gray-800' : 'text-gray-400' }} mt-2 block uppercase tracking-wider">Selesai</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Items Purchased Table -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-8">
                <h3 class="serif-logo text-base font-bold text-gray-900 pb-4 border-b border-gray-100 mb-6">Detail Furniture Yang Dipesan</h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs font-light">
                        <thead>
                            <tr class="border-b border-gray-100 text-gray-400 font-bold uppercase text-[9px]">
                                <th class="py-3">Produk</th>
                                <th class="py-3">Kustomisasi Opsi</th>
                                <th class="py-3 text-right">Harga Unit</th>
                                <th class="py-3 text-center">Jumlah</th>
                                <th class="py-3 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-gray-600">
                            @foreach($order->details as $item)
                                <tr>
                                    <!-- Product Name -->
                                    <td class="py-4">
                                        <div class="font-bold text-gray-800 text-sm">{{ $item->product_name }}</div>
                                        <span class="text-[9px] text-gray-400 font-mono">ID: #{{ $item->product_id }}</span>
                                    </td>

                                    <!-- Customizations selected -->
                                    <td class="py-4 max-w-xs">
                                        @if(is_array($item->customizations) && count($item->customizations) > 0)
                                            <div class="space-y-1 text-[10px] font-light">
                                                @if(isset($item->customizations['color']))
                                                    <span class="flex items-center text-gray-500">
                                                        <span class="inline-block w-2.5 h-2.5 rounded-full border border-gray-250 mr-1.5" style="background-color: {{ $item->customizations['color']['value'] ?? '#000' }}"></span>
                                                        Warna: {{ $item->customizations['color']['name'] ?? $item->customizations['color'] }}
                                                    </span>
                                                @endif
                                                @if(isset($item->customizations['foam_color']))
                                                    <span class="block text-gray-500">
                                                        <i class="fa-solid fa-couch mr-1 text-[#C5A880]"></i> Warna Busa: {{ is_array($item->customizations['foam_color']) ? ($item->customizations['foam_color']['name'] ?? '-') : $item->customizations['foam_color'] }}
                                                    </span>
                                                @endif
                                                @if(isset($item->customizations['material']))
                                                    <span class="block text-gray-500">
                                                        <i class="fa-solid fa-tree mr-1 text-[#C5A880]"></i> Material: {{ $item->customizations['material']['name'] ?? '-' }} 
                                                        @if(($item->customizations['material']['price_modifier'] ?? 0) > 0)
                                                            <span class="text-[9px] text-[#C5A880] font-bold">(+Rp {{ number_format($item->customizations['material']['price_modifier'], 0, ',', '.') }})</span>
                                                        @endif
                                                    </span>
                                                @endif
                                                @if(isset($item->customizations['size']))
                                                    <span class="block text-gray-500">
                                                        <i class="fa-solid fa-maximize mr-1 text-gray-400"></i> Ukuran: {{ $item->customizations['size']['name'] ?? '-' }} 
                                                        @if(($item->customizations['size']['price_modifier'] ?? 0) > 0)
                                                            <span class="text-[9px] text-[#C5A880] font-bold">(+Rp {{ number_format($item->customizations['size']['price_modifier'], 0, ',', '.') }})</span>
                                                        @endif
                                                    </span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-gray-400 font-light italic">Tanpa kustomisasi</span>
                                        @endif
                                    </td>

                                    <!-- Unit Price -->
                                    <td class="py-4 text-right font-medium text-gray-800">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </td>

                                    <!-- Quantity -->
                                    <td class="py-4 text-center text-gray-800 font-bold">
                                        {{ $item->quantity }}
                                    </td>

                                    <!-- Subtotal -->
                                    <td class="py-4 text-right font-bold text-gray-900 text-sm">
                                        Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Right Pane: Shipping Logistics & Status Modifier Form (1 Column) -->
        <div class="space-y-6">
            
            <!-- Update Status Box -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-8 space-y-6">
                <h3 class="serif-logo text-base font-bold text-gray-900 pb-3 border-b border-gray-100">Ubah Status Transaksi</h3>
                
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="status" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Pilih Status Logistik</label>
                        <select id="status" name="status" class="w-full bg-gray-50 border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-4 py-3 text-xs text-gray-850 font-semibold focus:outline-none">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi (Pending)</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Diproduksi & Dikemas (Processing)</option>
                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Pesanan Selesai (Completed)</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Pesanan Dibatalkan (Cancelled)</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full inline-flex justify-center items-center bg-[#1A1A1A] hover:bg-[#C5A880] text-white text-xs font-bold tracking-wider uppercase py-3.5 rounded-lg shadow transition duration-200">
                        Perbarui Status <i class="fa-solid fa-save ml-2 text-[10px]"></i>
                    </button>
                </form>
            </div>

            <!-- Shipping Logistics Details -->
            <div class="bg-[#FAF8F5] rounded-2xl border border-gray-100 shadow-sm p-8 space-y-6">
                <h3 class="serif-logo text-base font-bold text-gray-900 pb-3 border-b border-gray-200">Detail Pengiriman</h3>

                <!-- Buyer Details -->
                <div class="space-y-3 text-xs">
                    <div>
                        <span class="block text-[9px] text-gray-400 font-bold uppercase tracking-wider">Nama Penerima</span>
                        <span class="font-bold text-gray-800 text-sm">{{ $order->buyer_name }}</span>
                    </div>
                    
                    <div>
                        <span class="block text-[9px] text-gray-400 font-bold uppercase tracking-wider">Email Kontak</span>
                        <span class="font-medium text-gray-700">{{ $order->buyer_email }}</span>
                    </div>

                    <div>
                        <span class="block text-[9px] text-gray-400 font-bold uppercase tracking-wider">Nomor Telepon</span>
                        <span class="font-medium text-gray-700">{{ $order->buyer_phone }}</span>
                    </div>

                    <div>
                        <span class="block text-[9px] text-gray-400 font-bold uppercase tracking-wider">Metode Pembayaran</span>
                        <span class="font-semibold text-gray-800">
                            @if($order->payment_method === 'midtrans')
                                <i class="fa-solid fa-credit-card text-[#C5A880] mr-1"></i> Bayar Online (Midtrans)
                            @else
                                <i class="fa-solid fa-hand-holding-dollar text-emerald-600 mr-1"></i> Cash on Delivery (COD)
                            @endif
                        </span>
                    </div>

                    <div>
                        <span class="block text-[9px] text-gray-400 font-bold uppercase tracking-wider">Alamat Pengantaran</span>
                        <p class="font-light text-gray-600 leading-relaxed bg-white p-3 rounded-lg border border-gray-200 mt-1">
                            {{ $order->shipping_address }}
                        </p>
                    </div>
                </div>

                <div class="w-full h-px bg-gray-200"></div>

                <!-- Invoice Billing Totals -->
                <div class="space-y-3">
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400 font-light">Subtotal Furniture</span>
                        <span class="text-gray-700 font-semibold">Rp {{ number_format($order->total_price - 50000, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400 font-light">Biaya Logistik Showroom</span>
                        <span class="text-gray-700 font-semibold">Rp 50.000</span>
                    </div>
                    
                    <div class="w-full h-px bg-dashed bg-gray-200 my-2"></div>
                    
                    <div class="flex justify-between items-baseline">
                        <span class="text-xs font-bold text-gray-900">Total Pembayaran</span>
                        <span class="text-lg font-bold text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
