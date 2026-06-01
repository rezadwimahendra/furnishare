@extends('layouts.customer')

@section('title', 'Keranjang Belanja - Furnishare')

@section('content')
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="serif-title text-3xl font-bold text-gray-900 mb-10">Keranjang Belanja Anda</h1>

            @if($cartItems->isEmpty())
                <div class="text-center py-24 bg-[#FAF8F5] rounded-2xl border border-dashed border-gray-200">
                    <i class="fa-solid fa-bag-shopping text-5xl text-gray-300 mb-6 block"></i>
                    <h3 class="serif-title text-xl font-bold text-gray-800">Keranjang Anda Kosong</h3>
                    <p class="text-xs text-gray-500 max-w-sm mx-auto mt-2 leading-relaxed mb-8">
                        Anda belum menambahkan produk apapun ke keranjang belanja Anda. Temukan berbagai furniture impian Anda di katalog kami.
                    </p>
                    <a href="{{ route('products.index') }}" class="inline-flex justify-center items-center px-8 py-3.5 border border-transparent text-xs font-bold tracking-wider uppercase rounded-full text-white bg-[#1A1A1A] hover:bg-[#C5A880] transition-all duration-300">
                        Kembali Belanja
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
                    
                    <!-- Left: Cart Items List (2 Columns) -->
                    <div class="lg:col-span-2 space-y-6">
                        @php
                            $productImages = [
                                'kursi-makan-oak-minimalis' => 'https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=300',
                                'kursi-kerja-ergonomis-eira' => 'https://images.unsplash.com/photo-1505797149-43b0069ec26b?q=80&w=300',
                                'kursi-lounge-rattan-modern' => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?q=80&w=300',
                                'meja-makan-jati-scandinavian' => 'https://images.unsplash.com/photo-1530018607912-eff2df114fbe?q=80&w=300',
                                'meja-kerja-minimalis-vardo' => 'https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?q=80&w=300',
                                'meja-kopi-bundar-terrazzo' => 'https://images.unsplash.com/photo-1565793298595-6a879b1d9492?q=80&w=300',
                                'sofa-modular-nordic-comfort' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?q=80&w=300',
                                'sofa-bed-lipat-aiko' => 'https://images.unsplash.com/photo-1540518614846-7eded433c457?q=80&w=300',
                                'lemari-pakaian-jati-klasik' => 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?q=80&w=300',
                                'rak-buku-sekat-freja' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?q=80&w=300',
                                'cermin-dinding-estetik-aura' => 'https://images.unsplash.com/photo-1618220179428-22790b461013?q=80&w=300',
                                'lampu-meja-keramik-luna' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?q=80&w=300',
                            ];
                        @endphp
                        @foreach($cartItems as $item)
                            <div class="flex flex-col sm:flex-row items-start sm:items-center bg-[#FAF8F5] p-6 rounded-2xl border border-gray-50 shadow-sm gap-6 relative">
                                <!-- Image Frame -->
                                <div class="h-24 w-24 rounded-xl overflow-hidden bg-white border border-gray-100 flex-shrink-0">
                                    <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : ($productImages[$item->product->slug] ?? 'https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=300') }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                </div>

                                <!-- Content Frame -->
                                <div class="flex-grow">
                                    <span class="text-[10px] uppercase font-bold text-[#C5A880] tracking-wider">{{ $item->product->category->name }}</span>
                                    <h3 class="font-semibold text-gray-800 text-sm mt-0.5">{{ $item->product->name }}</h3>
                                    
                                    <!-- Render Customizations details elegantly -->
                                    <div class="mt-2 flex flex-wrap gap-2 text-[10px] text-gray-400">
                                        @if(!empty($item->customizations['color']))
                                            <span class="bg-white border border-gray-100 px-2 py-0.5 rounded">
                                                Warna: <strong class="text-gray-600">{{ $item->customizations['color'] }}</strong>
                                            </span>
                                        @endif
                                        @if(!empty($item->customizations['material']))
                                            <span class="bg-white border border-gray-100 px-2 py-0.5 rounded">
                                                Bahan: <strong class="text-gray-600">{{ $item->customizations['material'] }}</strong>
                                            </span>
                                        @endif
                                        @if(!empty($item->customizations['size']))
                                            <span class="bg-white border border-gray-100 px-2 py-0.5 rounded">
                                                Ukuran: <strong class="text-gray-600">{{ $item->customizations['size'] }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Quantity Selector and Price details -->
                                <div class="flex items-center justify-between sm:justify-start w-full sm:w-auto gap-8 pt-4 sm:pt-0 border-t sm:border-t-0 border-gray-200">
                                    
                                    <!-- Quantity Input -->
                                    <div class="flex items-center border border-gray-200 rounded-full bg-white px-1 shadow-sm scale-90">
                                        <button type="button" onclick="updateQty({{ $item->id }}, -1)" class="w-8 h-8 rounded-full text-gray-500 hover:text-[#C5A880] hover:bg-gray-50 flex items-center justify-center transition">
                                            <i class="fa-solid fa-minus text-xs"></i>
                                        </button>
                                        <input type="number" id="qty-{{ $item->id }}" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="w-10 border-none text-center text-xs font-semibold focus:outline-none focus:ring-0 text-gray-800" readonly>
                                        <button type="button" onclick="updateQty({{ $item->id }}, 1)" class="w-8 h-8 rounded-full text-gray-500 hover:text-[#C5A880] hover:bg-gray-50 flex items-center justify-center transition">
                                            <i class="fa-solid fa-plus text-xs"></i>
                                        </button>
                                    </div>

                                    <!-- Prices -->
                                    <div class="text-right">
                                        <div class="text-xs text-gray-400 font-light">Total Item</div>
                                        <div class="text-sm font-bold text-gray-900">
                                            Rp {{ number_format($item->total_item_price, 0, ',', '.') }}
                                        </div>
                                    </div>

                                    <!-- Delete Item Form -->
                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-300 hover:text-red-500 transition duration-200 p-1" title="Hapus dari Keranjang">
                                            <i class="fa-regular fa-trash-can text-lg"></i>
                                        </button>
                                    </form>

                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Right: Summary checkout card (1 Column) -->
                    <div class="bg-[#FAF8F5] p-8 rounded-2xl border border-gray-100 shadow-sm space-y-6">
                        <h3 class="serif-title text-lg font-bold text-gray-800">Ringkasan Belanja</h3>
                        <div class="w-8 h-0.5 bg-[#C5A880]"></div>
                        
                        <div class="space-y-4 text-xs font-light">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Total Harga Produk (Subtotal)</span>
                                <span class="font-semibold text-gray-800">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Pengiriman</span>
                                <span class="font-semibold text-gray-800">Flat-Rate Jabodetabek</span>
                            </div>
                            <p class="text-[10px] text-gray-400 leading-normal font-light">
                                Biaya pengiriman dan penanganan flat sebesar Rp 50.000 untuk pengantaran furniture premium aman akan ditambahkan saat checkout.
                            </p>
                            <div class="border-t border-gray-100 pt-4 flex justify-between text-sm font-bold">
                                <span class="text-gray-800">Estimasi Total</span>
                                <span class="text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="pt-2">
                            <a href="{{ route('checkout.index') }}" class="w-full inline-flex justify-center items-center bg-[#1A1A1A] hover:bg-[#C5A880] text-white text-xs font-bold tracking-wider uppercase py-4 px-6 rounded-full shadow-md hover:shadow-lg transition-all duration-300">
                                Lanjut Ke Checkout <i class="fa-solid fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>

                </div>
            @endif

        </div>
    </section>

    <!-- AJAX Quantities Updates Script -->
    <script>
        function updateQty(itemId, amount) {
            const field = document.getElementById('qty-' + itemId);
            let current = parseInt(field.value) || 1;
            const max = parseInt(field.getAttribute('max')) || 999;

            current += amount;
            if (current < 1) return;
            if (current > max) {
                alert('Stok produk terbatas hanya ' + max + ' Pcs.');
                return;
            }

            field.value = current;

            // Trigger Fetch PATCH
            fetch('/keranjang/update/' + itemId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    quantity: current
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Refresh view to recalculate totals
                    window.location.reload();
                } else {
                    alert(data.message || 'Gagal memperbarui kuantitas.');
                    window.location.reload();
                }
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan koneksi.');
            });
        }
    </script>
@endsection
