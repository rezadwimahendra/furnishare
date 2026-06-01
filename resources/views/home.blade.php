@extends('layouts.customer')

@section('title', 'Furnishare - Seni Ruang Minimalis Modern')

@section('content')
    <!-- Premium Video Background Hero Section (Edge-to-Edge) -->
    <section class="relative w-full h-[70vh] min-h-[500px] sm:h-[80vh] flex items-center justify-start overflow-hidden bg-[#1A1A1A] z-0">
        <!-- HTML5 Loopable Background Video -->
        <video autoplay loop muted playsinline poster="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?q=80&w=1200" class="absolute inset-0 w-full h-full object-cover z-0 opacity-70">
            <source src="{{ asset('videos/hero.mp4') }}" type="video/mp4">
            <source src="https://assets.mixkit.co/videos/preview/mixkit-modern-apartment-with-minimalist-design-and-furniture-41907-large.mp4" type="video/mp4">
            <source src="https://vimeo.com/external/549525424.sd.mp4?s=d00e66ec33c37db8751893c5d808f97e68dfd0e5&profile_id=164&oauth2_token_id=57447761" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Luxurious Charcoal Gradient Mask Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/50 to-black/30 z-10"></div>

        <!-- Hero Content Wrapper -->
        <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex items-center">
            <div class="max-w-2xl text-left">
                <!-- Subtitle with Premium Bronze Color -->
                <span class="text-xs font-bold tracking-widest text-[#C5A880] uppercase mb-4 block transform translate-y-0 opacity-100 transition-all duration-700">
                    {{ $banner['subtitle'] }}
                </span>
                
                <!-- Luxe Serif Title -->
                <h1 class="serif-title text-4xl sm:text-6xl font-bold text-white leading-tight mb-6 drop-shadow-md">
                    {{ $banner['title'] }}
                </h1>
                
                <!-- Premium Description -->
                <p class="text-sm sm:text-base text-gray-300 max-w-lg leading-relaxed mb-8 drop-shadow-md">
                    {{ $banner['description'] }}
                </p>
                
                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('products.index') }}" class="inline-flex justify-center items-center px-8 py-3.5 border border-transparent text-sm font-semibold rounded-full shadow-lg text-[#1A1A1A] bg-[#C5A880] hover:bg-[#B4966E] hover:text-white transition-all duration-300 transform hover:-translate-y-0.5">
                        Jelajahi Koleksi <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                    </a>
                    <a href="{{ route('products.index', ['kategori' => 'sofa']) }}" class="inline-flex justify-center items-center px-8 py-3.5 border border-white/30 backdrop-blur-sm text-sm font-semibold rounded-full text-white bg-white/10 hover:bg-white hover:text-[#1A1A1A] transition-all duration-300 transform hover:-translate-y-0.5">
                        Lihat Sofa Premium
                    </a>
                </div>
            </div>
        </div>

        <!-- Micro-animated Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 flex flex-col items-center text-white/50 hover:text-white/90 transition-colors duration-300 cursor-pointer">
            <span class="text-[9px] tracking-widest uppercase font-bold mb-1.5">Scroll Down</span>
            <i class="fa-solid fa-chevron-down text-xs animate-bounce"></i>
        </div>
    </section>

    <!-- Categories Grid -->
    <section class="py-20 bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-16">
                <span class="text-xs font-bold tracking-widest text-[#C5A880] uppercase mb-2 block">PILIHAN KATEGORI</span>
                <h2 class="serif-title text-3xl font-bold text-[#1A1A1A]">Belanja Berdasarkan Ruang</h2>
                <div class="w-12 h-0.5 bg-[#C5A880] mx-auto mt-4"></div>
            </div>

            <!-- Categories Cards -->
            <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                @php
                    $categoryImages = [
                        'kursi' => 'https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=400',
                        'meja' => 'https://images.unsplash.com/photo-1530018607912-eff2df114fbe?q=80&w=400',
                        'lemari' => 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?q=80&w=400',
                        'sofa' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?q=80&w=400',
                        'dekorasi' => 'https://images.unsplash.com/photo-1618220179428-22790b461013?q=80&w=400',
                    ];
                @endphp
                @foreach($categories as $cat)
                    <a href="{{ route('products.index', ['kategori' => $cat->slug]) }}" class="group relative block bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 text-center p-6 border border-gray-100">
                        <div class="h-28 w-28 rounded-full overflow-hidden mx-auto mb-4 bg-gray-100 transform group-hover:scale-105 transition-all duration-300">
                            <img src="{{ $categoryImages[$cat->slug] ?? 'https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=400' }}" alt="{{ $cat->name }}" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-semibold text-gray-800 group-hover:text-[#C5A880] transition duration-200 text-sm tracking-wide">{{ $cat->name }}</h3>
                        <p class="text-[10px] text-gray-400 mt-1 leading-normal font-light line-clamp-1">{{ $cat->description }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Popular Products Showcase -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-end mb-12">
                <div class="text-left mb-4 sm:mb-0">
                    <span class="text-xs font-bold tracking-widest text-[#C5A880] uppercase mb-2 block">PALING DIMINATI</span>
                    <h2 class="serif-title text-3xl font-bold text-[#1A1A1A]">Produk Populer Terlaris</h2>
                </div>
                <a href="{{ route('products.index') }}" class="group text-xs font-bold tracking-widest text-[#1A1A1A] hover:text-[#C5A880] uppercase flex items-center transition duration-300">
                    Lihat Semua Produk <i class="fa-solid fa-arrow-right ml-2 transform group-hover:translate-x-1 transition duration-200"></i>
                </a>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
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
                @foreach($popularProducts as $prod)
                    <div class="group relative bg-[#FAF8F5] rounded-2xl overflow-hidden border border-gray-50 hover:shadow-2xl hover:border-gray-100 transition-all duration-300">
                        <div class="relative overflow-hidden h-72">
                            <img src="{{ $prod->image ? asset('storage/' . $prod->image) : ($productImages[$prod->slug] ?? 'https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=500') }}" alt="{{ $prod->name }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-all duration-500">
                            <!-- Tag Popular -->
                            <span class="absolute top-4 left-4 bg-[#C5A880] text-white text-[10px] font-bold tracking-widest px-3 py-1 rounded-full">POPULER</span>
                        </div>
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
        </div>
    </section>

    <!-- Mid-Promo visual Banner -->
    <section class="bg-[#1A1A1A] py-20 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-neutral-800 via-neutral-900 to-black -z-10"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-xl text-left">
                <span class="text-xs font-bold tracking-widest text-[#C5A880] uppercase mb-3 block">LAYANAN PRESTISE KAMI</span>
                <h2 class="serif-title text-3xl sm:text-5xl font-bold mb-6 leading-tight">Konstruksi Custom Sesuai Keinginan Anda</h2>
                <p class="text-xs text-gray-400 mb-8 leading-relaxed">
                    Setiap produk di Furnishare dapat disesuaikan secara instan dari segi warna kayu, ukuran volume, hingga jenis kain pelapis premium. Kami mengantarkan impian furniture fungsional Anda langsung dari pusat pengrajin berlisensi ke depan pintu rumah Anda.
                </p>
                <div class="flex items-center space-x-6 text-xs text-gray-300">
                    <div>
                        <i class="fa-solid fa-medal text-xl text-[#C5A880] mb-2 block"></i>
                        <span class="font-semibold block text-white">Garansi 2 Tahun</span>
                        Struktur Kayu Kokoh
                    </div>
                    <div>
                        <i class="fa-solid fa-truck-fast text-xl text-[#C5A880] mb-2 block"></i>
                        <span class="font-semibold block text-white">Gratis Pengiriman</span>
                        Jabodetabek Flat-Fee
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Products Section -->
    <section class="py-20 bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-16">
                <span class="text-xs font-bold tracking-widest text-[#C5A880] uppercase mb-2 block">KOLEKSI TERBARU</span>
                <h2 class="serif-title text-3xl font-bold text-[#1A1A1A]">Hadir Baru di Catalog</h2>
                <div class="w-12 h-0.5 bg-[#C5A880] mx-auto mt-4"></div>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($latestProducts as $prod)
                    <div class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300">
                        <div class="relative overflow-hidden h-72">
                            <img src="{{ $prod->image ? asset('storage/' . $prod->image) : ($productImages[$prod->slug] ?? 'https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=500') }}" alt="{{ $prod->name }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-all duration-500">
                        </div>
                        <div class="p-6">
                            <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider mb-1">{{ $prod->category->name }}</p>
                            <h3 class="font-medium text-gray-800 text-sm group-hover:text-[#C5A880] transition duration-200 line-clamp-1">
                                <a href="{{ route('products.show', $prod->slug) }}">{{ $prod->name }}</a>
                            </h3>
                            <div class="flex justify-between items-center mt-4">
                                <p class="text-sm font-bold text-gray-900">Rp {{ number_format($prod->price, 0, ',', '.') }}</p>
                                <a href="{{ route('products.show', $prod->slug) }}" class="text-xs font-semibold text-[#C5A880] hover:text-[#B4966E] transition">
                                    Detail <i class="fa-solid fa-chevron-right ml-1 text-[8px]"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
