@extends('layouts.customer')

@section('title', 'Katalog Furniture Premium - Furnishare')

@section('content')
    <!-- Banner Category Title -->
    <section class="bg-[#FAF8F5] py-12 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="serif-title text-3xl sm:text-5xl font-bold text-gray-900 mb-2">
                @if(request('kategori'))
                    Koleksi {{ ucfirst(request('kategori')) }}
                @else
                    Koleksi Furniture Premium
                @endif
            </h1>
            <p class="text-xs text-gray-400 max-w-xl font-light">
                Jelajahi pilihan terbaik kami dari kursi minimalis, meja jati solid, sofa premium modular, kabinet estetik, hingga hiasan dekoratif rumah.
            </p>
        </div>
    </section>

    <!-- Catalog Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-10">
                
                <!-- 1. Filters Sidebar (Desktop) -->
                <div class="w-full lg:w-1/4 flex-shrink-0">
                    <div class="sticky top-28 bg-[#FAF8F5] p-8 rounded-2xl border border-gray-100 shadow-sm space-y-8">
                        <!-- Search Form Inside Sidebar -->
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-gray-800 mb-4">Pencarian</h3>
                            <form action="{{ route('products.index') }}" method="GET" class="relative">
                                @if(request('kategori'))
                                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                                @endif
                                @if(request('sort'))
                                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                                @endif
                                <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}" class="w-full bg-white border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-4 py-2.5 text-xs text-gray-700 focus:outline-none">
                                <button type="submit" class="absolute right-3 top-3 text-gray-400 hover:text-[#C5A880]">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Categories Filter List -->
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-gray-800 mb-4">Kategori</h3>
                            <div class="space-y-2">
                                <a href="{{ route('products.index', ['search' => request('search'), 'sort' => request('sort')]) }}" class="flex items-center justify-between text-xs {{ !request('kategori') ? 'text-[#C5A880] font-semibold' : 'text-gray-600 hover:text-[#C5A880]' }}">
                                    <span>Semua Furniture</span>
                                    <span class="bg-white border border-gray-100 text-[10px] px-2 py-0.5 rounded text-gray-500 font-normal">
                                        {{ \App\Models\Product::count() }}
                                    </span>
                                </a>
                                @foreach($categories as $cat)
                                    <a href="{{ route('products.index', ['kategori' => $cat->slug, 'search' => request('search'), 'sort' => request('sort')]) }}" class="flex items-center justify-between text-xs {{ request('kategori') === $cat->slug ? 'text-[#C5A880] font-semibold' : 'text-gray-600 hover:text-[#C5A880]' }} transition duration-200">
                                        <span>{{ $cat->name }}</span>
                                        <span class="bg-white border border-gray-100 text-[10px] px-2 py-0.5 rounded text-gray-500 font-normal">
                                            {{ $cat->products_count ?? $cat->products()->count() }}
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Reset Filter -->
                        @if(request('kategori') || request('search') || request('sort'))
                            <div class="pt-4 border-t border-gray-100">
                                <a href="{{ route('products.index') }}" class="w-full text-center block bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium py-2.5 rounded-lg transition duration-200">
                                    Hapus Semua Filter
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- 2. Products List Area -->
                <div class="w-full lg:w-3/4">
                    <!-- Sort and Result Count header -->
                    <div class="flex flex-col sm:flex-row justify-between items-center bg-[#FAF8F5] px-6 py-4 rounded-xl mb-8 border border-gray-50 gap-4">
                        <div class="text-xs text-gray-500 font-light">
                            Menampilkan <span class="font-bold text-gray-800">{{ $products->firstItem() ?? 0 }}</span> - <span class="font-bold text-gray-800">{{ $products->lastItem() ?? 0 }}</span> dari <span class="font-bold text-gray-800">{{ $products->total() }}</span> produk
                        </div>
                        
                        <div class="flex items-center space-x-2 text-xs">
                            <span class="text-gray-500">Urutkan:</span>
                            <form action="{{ route('products.index') }}" method="GET" id="sortForm">
                                @if(request('kategori'))
                                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                                @endif
                                @if(request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                @endif
                                <select name="sort" onchange="document.getElementById('sortForm').submit()" class="border-gray-200 rounded-lg py-1.5 px-3 text-xs focus:ring-[#C5A880] focus:border-[#C5A880] bg-white cursor-pointer focus:outline-none">
                                    <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                                    <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    @if($products->isEmpty())
                        <div class="text-center py-20 bg-[#FAF8F5] rounded-2xl border border-dashed border-gray-200">
                            <i class="fa-solid fa-couch text-4xl text-gray-300 mb-4 block"></i>
                            <h3 class="serif-title text-lg font-bold text-gray-800">Tidak Ada Produk Ditemukan</h3>
                            <p class="text-xs text-gray-500 max-w-sm mx-auto mt-2 leading-relaxed">
                                Maaf, kami tidak dapat menemukan produk yang sesuai dengan filter pencarian Anda. Coba hapus beberapa filter atau kata kunci.
                            </p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                            @php
                                $productImages = [
                                    'kursi-makan-oak-minimalis' => 'https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=500',
                                    'kursi-kerja-ergonomis-eira' => 'https://images.unsplash.com/photo-1505797149-43b0069ec26b?q=80&w=500',
                                    'kursi-lounge-rattan-modern' => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?q=80&w=500',
                                    'meja-makan-jati-scandinavian' => 'https://images.unsplash.com/photo-1530018607912-eff2df114fbe?q=80&w=500',
                                    'meja-kerja-minimalis-vardo' => 'https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?q=80&w=500',
                                    'meja-kopi-bundar-terrazzo' => 'https://images.unsplash.com/photo-1565793298595-6a879b1d9492?q=80&w=500',
                                    'sofa-modular-nordic-comfort' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?q=80&w=500',
                                    'sofa-bed-lipat-aiko' => 'https://images.unsplash.com/photo-1540518614846-7eded433c457?q=80&w=500',
                                    'lemari-pakaian-jati-klasik' => 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?q=80&w=500',
                                    'rak-buku-sekat-freja' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?q=80&w=500',
                                    'cermin-dinding-estetik-aura' => 'https://images.unsplash.com/photo-1618220179428-22790b461013?q=80&w=500',
                                    'lampu-meja-keramik-luna' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?q=80&w=500',
                                ];
                            @endphp
                            @foreach($products as $prod)
                                <div class="group relative bg-[#FAF8F5] rounded-2xl overflow-hidden border border-gray-50 hover:shadow-xl hover:border-gray-100 transition-all duration-300">
                                    <!-- Image frame -->
                                    <div class="relative overflow-hidden h-72">
                                        <img src="{{ $prod->image ? asset('storage/' . $prod->image) : ($productImages[$prod->slug] ?? 'https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=500') }}" alt="{{ $prod->name }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-all duration-500">
                                        @if($prod->is_popular)
                                            <span class="absolute top-4 left-4 bg-[#C5A880] text-white text-[9px] font-bold tracking-widest px-3 py-1 rounded-full">POPULER</span>
                                        @endif
                                    </div>
                                    
                                    <!-- Content Frame -->
                                    <div class="p-6">
                                        <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider mb-1">{{ $prod->category->name }}</p>
                                        <h3 class="font-medium text-gray-800 text-sm group-hover:text-[#C5A880] transition duration-200 line-clamp-1">
                                            <a href="{{ route('products.show', $prod->slug) }}">{{ $prod->name }}</a>
                                        </h3>
                                        <div class="flex justify-between items-center mt-4">
                                            <p class="text-sm font-bold text-gray-900">Rp {{ number_format($prod->price, 0, ',', '.') }}</p>
                                            <a href="{{ route('products.show', $prod->slug) }}" class="h-8 w-8 rounded-full bg-white group-hover:bg-[#C5A880] border border-gray-100 group-hover:border-transparent flex items-center justify-center text-gray-600 group-hover:text-white shadow-sm transition-all duration-300">
                                                <i class="fa-solid fa-arrow-right text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination Frame -->
                        <div class="mt-12">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>
@endsection
