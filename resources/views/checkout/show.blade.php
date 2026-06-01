@extends('layouts.customer')

@push('scripts')
    <script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <style>
        .midtrans-button {
            animation: pulse-ring 2s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
        }
        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 rgba(197, 168, 128, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(197, 168, 128, 0); }
            100% { box-shadow: 0 0 0 0 rgba(197, 168, 128, 0); }
        }
    </style>
@endpush

@section('title', 'Status Pesanan ' . $order->order_code . ' - Furnishare')

@section('content')
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Success message header -->
            <div class="text-center mb-16">
                <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-emerald-50 text-emerald-500 border border-emerald-100 shadow-sm mb-6">
                    <i class="fa-solid fa-circle-check text-3xl"></i>
                </div>
                <h1 class="serif-title text-3xl sm:text-4xl font-bold text-gray-900 leading-tight">Terima Kasih Atas Pesanan Anda!</h1>
                <p class="text-xs text-gray-500 max-w-md mx-auto mt-2 leading-relaxed">
                    Pesanan Anda telah berhasil dibuat dengan kode pelacakan di bawah ini. Customer Service kami akan segera menghubungi Anda.
                </p>
                <div class="mt-6 inline-block bg-[#FAF8F5] border border-gray-100 rounded-lg px-6 py-2.5 shadow-sm">
                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider block">Kode Pesanan</span>
                    <span class="font-mono text-sm font-bold text-[#C5A880]">{{ $order->order_code }}</span>
                </div>
            </div>

            <!-- Status Timeline Tracker (Exquisite!) -->
            <div class="bg-[#FAF8F5] p-8 rounded-2xl border border-gray-100 shadow-sm mb-12">
                <h3 class="serif-title text-base font-bold text-gray-800 mb-8 text-center">Status Pemrosesan Furniture</h3>
                
                <div class="relative">
                    <!-- Progress Bar line -->
                    <div class="absolute top-4 left-4 right-4 sm:left-12 sm:right-12 h-1 bg-gray-200 -z-10 rounded-full">
                        @php
                            $width = '0%';
                            if($order->status === 'processing') $width = '50%';
                            if($order->status === 'completed') $width = '100%';
                        @endphp
                        <div class="h-full bg-[#C5A880] rounded-full transition-all duration-500" style="width: {{ $width }};"></div>
                    </div>

                    <!-- Steps -->
                    <div class="flex justify-between text-center">
                        <!-- Step 1: Pending -->
                        <div class="flex flex-col items-center">
                            <span class="h-9 w-9 rounded-full flex items-center justify-center text-xs font-bold ring-4 ring-[#FAF8F5] shadow-sm {{ in_array($order->status, ['pending', 'processing', 'completed']) ? 'bg-[#C5A880] text-white' : 'bg-gray-200 text-gray-500' }}">
                                <i class="fa-solid fa-receipt text-[10px]"></i>
                            </span>
                            <span class="text-[10px] font-bold text-gray-800 mt-2">Diterima</span>
                            <span class="text-[9px] text-gray-400 leading-normal font-light">Menunggu Konfirmasi</span>
                        </div>

                        <!-- Step 2: Processing -->
                        <div class="flex flex-col items-center">
                            <span class="h-9 w-9 rounded-full flex items-center justify-center text-xs font-bold ring-4 ring-[#FAF8F5] shadow-sm {{ in_array($order->status, ['processing', 'completed']) ? 'bg-[#C5A880] text-white' : 'bg-gray-200 text-gray-500' }}">
                                <i class="fa-solid fa-hammer text-[10px]"></i>
                            </span>
                            <span class="text-[10px] font-bold text-gray-800 mt-2">Diproduksi</span>
                            <span class="text-[9px] text-gray-400 leading-normal font-light">Kustomisasi / Pengemasan</span>
                        </div>

                        <!-- Step 3: Completed -->
                        <div class="flex flex-col items-center">
                            <span class="h-9 w-9 rounded-full flex items-center justify-center text-xs font-bold ring-4 ring-[#FAF8F5] shadow-sm {{ $order->status === 'completed' ? 'bg-[#C5A880] text-white' : 'bg-gray-200 text-gray-500' }}">
                                <i class="fa-solid fa-truck-ramp-box text-[10px]"></i>
                            </span>
                            <span class="text-[10px] font-bold text-gray-800 mt-2">Terkirim</span>
                            <span class="text-[9px] text-gray-400 leading-normal font-light">Sampai Tujuan</span>
                        </div>
                    </div>

                    @if($order->status === 'cancelled')
                        <div class="mt-8 text-center bg-red-50 border border-red-100 rounded-lg p-4 text-xs text-red-700">
                            <i class="fa-solid fa-ban mr-2"></i> Pesanan ini telah **Dibatalkan**. Silakan hubungi admin untuk info selengkapnya.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Payment Instructions Box -->
            @if($order->payment_method === 'midtrans')
                <div class="bg-white border text-center md:text-left border-[#C5A880]/30 p-8 sm:p-10 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] mb-12 relative overflow-hidden group hover:border-[#C5A880]/50 transition-colors duration-500">
                    <!-- Decorative background accent -->
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-[#C5A880]/5 rounded-full blur-3xl group-hover:bg-[#C5A880]/10 transition duration-700"></div>
                    
                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                        <div>
                            <div class="inline-flex items-center justify-center md:justify-start space-x-2 text-[#C5A880] mb-3 w-full">
                                <i class="fa-solid fa-shield-halved text-sm"></i>
                                <span class="text-[10px] font-bold tracking-widest uppercase">Pembayaran Aman via Midtrans</span>
                            </div>
                            <h3 class="serif-title text-2xl font-bold text-gray-900 mb-2">Penyelesaian Pembayaran</h3>
                            
                            @if($order->status === 'pending')
                            <p class="text-xs text-gray-500 max-w-sm leading-relaxed mx-auto md:mx-0">
                                Selesaikan pembayaran Anda sekarang dengan metode pembayaran online pilihan Anda agar pesanan dapat segera diproses ke tahap produksi.
                            </p>
                            @else
                            <p class="text-xs text-emerald-600 font-medium">Pembayaran untuk pesanan ini telah berhasil diverifikasi.</p>
                            @endif
                        </div>

                        <div class="bg-[#FAF8F5] md:bg-white p-6 md:p-0 rounded-2xl md:rounded-none w-full md:w-auto text-center md:text-right border border-gray-100 md:border-none">
                            <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Tagihan</span>
                            <span class="block text-3xl font-bold text-gray-900 mb-6 font-mono tracking-tight">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            
                            @if($order->status === 'pending')
                            <button id="pay-button" class="w-full md:w-auto midtrans-button inline-flex justify-center items-center bg-[#1A1A1A] hover:bg-[#C5A880] text-white text-xs font-bold tracking-widest uppercase py-4 px-8 rounded-full shadow-xl transition-all duration-300">
                                <i class="fa-solid fa-lock mr-2 text-[#C5A880] group-hover:text-white transition-colors"></i> Bayar Sekarang
                            </button>
                            @elseif($order->status === 'paid' || $order->status === 'processing')
                            <div class="inline-flex items-center px-6 py-3 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100 text-xs font-bold tracking-wide uppercase">
                                <i class="fa-solid fa-check-circle mr-2"></i> Lunas Terbayar
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                @if($order->status === 'pending')
                <script>
                    document.getElementById('pay-button').onclick = function(){
                        snap.pay('{{ $order->snap_token }}', {
                            onSuccess: function(result){
                                window.location.href = "{{ route('orders.show', $order->order_code) }}?status=success";
                            },
                            onPending: function(result){
                                window.location.href = "{{ route('orders.show', $order->order_code) }}";
                            },
                            onError: function(result){
                                alert("Pambayaran Gagal!");
                            },
                            onClose: function(){
                                console.log('customer closed the popup without finishing the payment');
                            }
                        });
                    };
                </script>
                @endif
            @else
                <div class="bg-emerald-50/20 border border-emerald-100/50 p-6 rounded-2xl shadow-sm mb-12 flex items-start gap-4">
                    <i class="fa-solid fa-circle-info text-emerald-600 text-lg mt-0.5"></i>
                    <div>
                        <h4 class="text-xs font-bold text-gray-805">Pembayaran Cash on Delivery (COD)</h4>
                        <p class="text-[10px] text-gray-500 leading-normal mt-1 font-sans font-light">
                            Pesanan Anda akan dikirim langsung ke alamat tujuan oleh kurir khusus kami. Silakan siapkan uang tunai sebesar **Rp {{ number_format($order->total_price, 0, ',', '.') }}** saat kurir mengantarkan barang.
                        </p>
                    </div>
                </div>
            @endif

            <!-- Buyer Details & Summary Details side-by-side grids -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start mb-12">
                
                <!-- Shipping Summary -->
                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm space-y-4">
                    <h4 class="font-bold text-xs uppercase tracking-widest text-[#C5A880]">Alamat & Kontak Pengiriman</h4>
                    <ul class="text-xs text-gray-600 space-y-3 font-light leading-relaxed">
                        <li>
                            <strong class="block text-gray-800 font-semibold mb-0.5">Nama Penerima:</strong>
                            {{ $order->buyer_name }}
                        </li>
                        <li>
                            <strong class="block text-gray-800 font-semibold mb-0.5">Nomor Telepon:</strong>
                            {{ $order->buyer_phone }}
                        </li>
                        <li>
                            <strong class="block text-gray-800 font-semibold mb-0.5">Konfirmasi Email:</strong>
                            {{ $order->buyer_email }}
                        </li>
                        <li>
                            <strong class="block text-gray-800 font-semibold mb-0.5">Alamat Lengkap:</strong>
                            {{ $order->shipping_address }}
                        </li>
                        <li>
                            <strong class="block text-gray-800 font-semibold mb-0.5">Metode Pembayaran:</strong>
                            @if($order->payment_method === 'midtrans')
                                Bayar Online (Midtrans)
                            @else
                                Cash on Delivery (COD)
                            @endif
                        </li>
                    </ul>
                </div>

                <!-- Billing & Items -->
                <div class="bg-[#FAF8F5] p-6 rounded-xl border border-gray-50 shadow-sm space-y-4">
                    <h4 class="font-bold text-xs uppercase tracking-widest text-[#C5A880]">Rincian Transaksi</h4>
                    
                    <div class="divide-y divide-gray-100 max-h-52 overflow-y-auto space-y-2 pr-2">
                        @foreach($order->details as $det)
                            <div class="flex items-center justify-between text-xs py-2">
                                <div>
                                    <h5 class="font-medium text-gray-800">{{ $det->product_name }}</h5>
                                    <p class="text-[9px] text-gray-400 mt-0.5">
                                        {{ $det->quantity }} Pcs
                                        @if(!empty($det->customizations['color']) || !empty($det->customizations['foam_color']) || !empty($det->customizations['material']) || !empty($det->customizations['size']))
                                            ({{ $det->customizations['color'] ?? '-' }}, Busa: {{ $det->customizations['foam_color'] ?? '-' }}, {{ $det->customizations['material'] ?? '-' }}, {{ $det->customizations['size'] ?? '-' }})
                                        @endif
                                    </p>
                                </div>
                                <span class="font-bold text-gray-700">
                                    Rp {{ number_format($det->price * $det->quantity, 0, ',', '.') }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-200 pt-3 text-xs space-y-2 font-light">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Subtotal Produk</span>
                            <span class="font-semibold text-gray-800">Rp {{ number_format($order->total_price - 50000, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Biaya Pengiriman Flat</span>
                            <span class="font-semibold text-gray-800">Rp 50.000</span>
                        </div>
                        <div class="border-t border-gray-200 pt-2 flex justify-between font-bold text-sm text-gray-900">
                            <span>Total Pembayaran</span>
                            <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom Actions -->
            <div class="text-center pt-4">
                <a href="{{ route('products.index') }}" class="inline-flex justify-center items-center px-8 py-3.5 border border-transparent text-xs font-bold tracking-wider uppercase rounded-full text-white bg-[#1A1A1A] hover:bg-[#C5A880] transition-all duration-300">
                    Jelajahi Furniture Lainnya <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>

        </div>
    </section>
@endsection
