@extends('layouts.customer')

@section('title', 'Riwayat Pesanan Saya - Furnishare')

@section('content')
    <section class="py-16 bg-white min-h-[70vh]">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-10">
                <h1 class="serif-title text-3xl font-bold text-gray-900">Riwayat Pesanan Saya</h1>
                <p class="text-xs text-gray-500 mt-2">Lacak status pesanan dan lakukan pembayaran untuk pesanan yang belum lunas.</p>
                <div class="w-12 h-1 bg-[#C5A880] mt-4"></div>
            </div>

            @if($orders->isEmpty())
                <div class="bg-[#FAF8F5] rounded-2xl p-12 text-center border border-gray-100 shadow-sm">
                    <div class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-white text-[#C5A880] shadow-sm mb-6">
                        <i class="fa-solid fa-box-open text-3xl"></i>
                    </div>
                    <h3 class="serif-title text-xl font-bold text-gray-800 mb-2">Belum Ada Pesanan</h3>
                    <p class="text-sm text-gray-500 mb-8 max-w-md mx-auto">Tampaknya Anda belum pernah melakukan pemesanan di Furnishare. Mari lengkapi ruangan Anda dengan furniture terbaik kami.</p>
                    <a href="{{ route('products.index') }}" class="inline-flex justify-center items-center px-8 py-3 bg-[#1A1A1A] hover:bg-[#C5A880] text-white text-xs font-bold tracking-wider uppercase rounded-full transition-all duration-300">
                        Belanja Sekarang <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                </div>
            @else
                <div class="space-y-6">
                    @foreach($orders as $order)
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                            <!-- Order Header -->
                            <div class="bg-[#FAF8F5] px-6 py-4 flex flex-col md:flex-row md:justify-between md:items-center border-b border-gray-200 gap-4">
                                <div class="flex items-center space-x-6">
                                    <div>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Nomor Pesanan</p>
                                        <p class="text-sm font-bold text-gray-900 mt-0.5">{{ $order->order_code }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Tanggal</p>
                                        <p class="text-xs font-semibold text-gray-700 mt-1">{{ $order->created_at->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Total Belanja</p>
                                        <p class="text-sm font-bold text-[#C5A880] mt-0.5">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    </div>
                                </div>

                                <div>
                                    @if($order->status === 'pending')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                            <i class="fa-regular fa-clock mr-1.5"></i> Menunggu Pembayaran
                                        </span>
                                    @elseif($order->status === 'processing' || $order->status === 'paid')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">
                                            <i class="fa-solid fa-hammer mr-1.5"></i> Diproses
                                        </span>
                                    @elseif($order->status === 'completed')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                            <i class="fa-solid fa-check-circle mr-1.5"></i> Selesai
                                        </span>
                                    @elseif($order->status === 'cancelled')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-red-100 text-red-800">
                                            <i class="fa-solid fa-ban mr-1.5"></i> Dibatalkan
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Order Items -->
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                    <div class="md:col-span-3 space-y-4">
                                        @foreach($order->details->take(2) as $detail)
                                            <div class="flex items-start space-x-4">
                                                <div class="w-16 h-16 rounded-lg border border-gray-100 overflow-hidden flex-shrink-0 bg-gray-50">
                                                    <img src="{{ $detail->product && $detail->product->image ? asset('storage/' . $detail->product->image) : 'https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=200' }}" alt="{{ $detail->product_name }}" class="w-full h-full object-cover">
                                                </div>
                                                <div>
                                                    <h4 class="text-sm font-semibold text-gray-800">{{ $detail->product_name }}</h4>
                                                    <p class="text-xs text-gray-500 mt-1">{{ $detail->quantity }} Barang x Rp {{ number_format($detail->price, 0, ',', '.') }}</p>
                                                    @if(!empty($detail->customizations))
                                                    <p class="text-[9px] text-gray-400 mt-1">Kustomisasi diterapkan</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                        @if($order->details->count() > 2)
                                            <p class="text-xs text-gray-500 font-medium">+ {{ $order->details->count() - 2 }} barang lainnya</p>
                                        @endif
                                    </div>
                                    
                                    <div class="md:col-span-1 flex flex-col justify-end items-start md:items-end md:border-l md:border-gray-100 pl-0 md:pl-6 pt-4 md:pt-0 mt-4 md:mt-0 border-t border-gray-100 md:border-t-0 space-y-3 w-full">
                                        @if($order->payment_method === 'midtrans' && $order->status === 'pending')
                                            <!-- Tombol Bayar jika belum dibayar -->
                                            <a href="{{ route('orders.show', $order->order_code) }}" class="w-full text-center inline-flex justify-center items-center px-4 py-2 bg-[#C5A880] hover:bg-[#B4966E] text-white text-[10px] font-bold tracking-wider uppercase rounded shadow transition">
                                                <i class="fa-solid fa-wallet mr-2"></i> Bayar Sekarang
                                            </a>
                                        @endif
                                        <a href="{{ route('orders.show', $order->order_code) }}" class="w-full text-center inline-flex justify-center items-center px-4 py-2 border border-gray-300 hover:border-[#C5A880] text-gray-700 hover:text-[#C5A880] text-[10px] font-bold tracking-wider uppercase rounded bg-white transition">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
