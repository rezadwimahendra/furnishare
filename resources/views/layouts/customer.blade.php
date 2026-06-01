<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Furnishare - Platform E-Commerce Furniture Modern, Minimalis, dan Premium">
    <title>@yield('title', 'Furnishare - Seni Ruang Minimalis Modern')</title>
    
    <!-- Google Fonts: Outfit & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #FAF8F5; /* Warm Minimalist Cream */
            color: #1A1A1A; /* Luxe Charcoal */
        }
        .serif-title {
            font-family: 'Playfair Display', serif;
        }
        .text-bronze {
            color: #C5A880;
        }
        .bg-bronze {
            background-color: #C5A880;
        }
        .bg-bronze-dark {
            background-color: #B4966E;
        }
        .border-bronze {
            border-color: #C5A880;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between antialiased selection:bg-[#C5A880] selection:text-white">

    <!-- Header / Sticky Navigation -->
    <header class="sticky top-0 z-50 bg-[#FAF8F5]/90 backdrop-blur-md border-b border-gray-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="serif-title text-2xl font-bold tracking-wider text-[#1A1A1A] hover:text-[#C5A880] transition duration-300">
                        FURNISHARE<span class="text-[#C5A880]">.</span>
                    </a>
                </div>

                <!-- Navigation Menu -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="text-sm font-medium tracking-wide {{ request()->routeIs('home') ? 'text-[#C5A880] border-b-2 border-[#C5A880]' : 'text-gray-600 hover:text-[#C5A880]' }} pb-1 transition duration-300">HOME</a>
                    <a href="{{ route('products.index') }}" class="text-sm font-medium tracking-wide {{ request()->routeIs('products.index') && !request()->has('kategori') ? 'text-[#C5A880] border-b-2 border-[#C5A880]' : 'text-gray-600 hover:text-[#C5A880]' }} pb-1 transition duration-300">SEMUA PRODUK</a>
                    
                    <!-- Dropdown Kategori -->
                    <div class="relative group">
                        <button class="flex items-center text-sm font-medium tracking-wide text-gray-600 hover:text-[#C5A880] pb-1 transition duration-300 focus:outline-none">
                            KATEGORI <i class="fa-solid fa-chevron-down ml-1 text-[10px]"></i>
                        </button>
                        <div class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black/5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 z-50">
                            <div class="py-1">
                                <a href="{{ route('products.index', ['kategori' => 'kursi']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FAF8F5] hover:text-[#C5A880]">Kursi</a>
                                <a href="{{ route('products.index', ['kategori' => 'meja']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FAF8F5] hover:text-[#C5A880]">Meja</a>
                                <a href="{{ route('products.index', ['kategori' => 'lemari']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FAF8F5] hover:text-[#C5A880]">Lemari</a>
                                <a href="{{ route('products.index', ['kategori' => 'sofa']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FAF8F5] hover:text-[#C5A880]">Sofa</a>
                                <a href="{{ route('products.index', ['kategori' => 'dekorasi']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FAF8F5] hover:text-[#C5A880]">Dekorasi</a>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Icons & Auth -->
                <div class="flex items-center space-x-6">
                    <!-- Search button (trigger modal/form) -->
                    <form action="{{ route('products.index') }}" method="GET" class="hidden lg:flex items-center bg-gray-100 rounded-full px-4 py-1.5 border border-transparent focus-within:border-[#C5A880] transition duration-300">
                        <input type="text" name="search" placeholder="Cari furniture..." value="{{ request('search') }}" class="bg-transparent border-none text-xs focus:outline-none w-40 text-gray-700">
                        <button type="submit" class="text-gray-500 hover:text-[#C5A880] transition duration-200">
                            <i class="fa-solid fa-magnifying-glass text-sm"></i>
                        </button>
                    </form>

                    <!-- Shopping Cart Icon -->
                    <a href="{{ route('cart.index') }}" class="relative text-gray-600 hover:text-[#C5A880] transition duration-300 py-1.5 px-2">
                        <i class="fa-solid fa-cart-shopping text-xl"></i>
                        @auth
                            @php
                                $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                            @endphp
                            @if($cartCount > 0)
                                <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-[#C5A880] text-[9px] font-bold text-white ring-2 ring-[#FAF8F5]">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        @endauth
                    </a>

                    <!-- User Account / Login Dropdown -->
                    @auth
                        <div class="relative group">
                            <button class="flex items-center text-sm font-medium text-gray-700 hover:text-[#C5A880] transition duration-300 focus:outline-none">
                                <span class="hidden sm:inline mr-2">{{ auth()->user()->name }}</span>
                                <i class="fa-regular fa-user text-lg"></i>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black/5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 z-50">
                                <div class="py-1">
                                    @if(auth()->user()->is_admin)
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FAF8F5] hover:text-[#C5A880] font-semibold"><i class="fa-solid fa-chart-line mr-2"></i>Dashboard Admin</a>
                                        <div class="border-t border-gray-100"></div>
                                    @endif
                                    <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FAF8F5] hover:text-[#C5A880]"><i class="fa-solid fa-receipt mr-2"></i>Riwayat Pesanan</a>
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FAF8F5] hover:text-[#C5A880]"><i class="fa-regular fa-id-badge mr-2"></i>Profil Saya</a>
                                    
                                    <!-- Logout Form -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50"><i class="fa-solid fa-arrow-right-from-bracket mr-2"></i>Keluar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium tracking-wide text-gray-600 hover:text-[#C5A880] transition duration-300">MASUK</a>
                        <a href="{{ route('register') }}" class="hidden sm:inline-block text-xs font-medium tracking-wider bg-[#1A1A1A] hover:bg-[#C5A880] text-white py-2.5 px-5 rounded-full shadow-sm hover:shadow-md transition duration-300">DAFTAR</a>
                    @endauth

                    <!-- Mobile Menu Trigger -->
                    <button id="mobile-menu-btn" class="md:hidden text-gray-600 hover:text-[#C5A880] focus:outline-none p-2 relative z-50">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown Panel -->
        <div id="mobile-menu-container" class="hidden md:hidden absolute top-20 left-0 w-full bg-white shadow-xl border-t border-gray-100 z-40 transition-all duration-300 transform origin-top">
            <div class="px-4 py-6 space-y-5">
                <!-- Search -->
                <form action="{{ route('products.index') }}" method="GET" class="flex items-center bg-gray-50 rounded-full px-4 py-2 border border-gray-200">
                    <input type="text" name="search" placeholder="Cari furniture..." value="{{ request('search') }}" class="bg-transparent border-none text-sm focus:outline-none w-full text-gray-700">
                    <button type="submit" class="text-gray-500"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>

                <!-- Navigation Links -->
                <nav class="flex flex-col space-y-4">
                    <a href="{{ route('home') }}" class="text-base font-semibold text-gray-800 hover:text-[#C5A880]">Home</a>
                    <a href="{{ route('products.index') }}" class="text-base font-semibold text-gray-800 hover:text-[#C5A880]">Semua Produk</a>
                    
                    <div class="border-t border-gray-100 pt-4">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 block">Kategori Belanja</span>
                        <div class="grid grid-cols-2 gap-3 pl-2">
                            <a href="{{ route('products.index', ['kategori' => 'kursi']) }}" class="text-sm text-gray-600 hover:text-[#C5A880]">Kursi</a>
                            <a href="{{ route('products.index', ['kategori' => 'meja']) }}" class="text-sm text-gray-600 hover:text-[#C5A880]">Meja</a>
                            <a href="{{ route('products.index', ['kategori' => 'lemari']) }}" class="text-sm text-gray-600 hover:text-[#C5A880]">Lemari</a>
                            <a href="{{ route('products.index', ['kategori' => 'sofa']) }}" class="text-sm text-gray-600 hover:text-[#C5A880]">Sofa</a>
                            <a href="{{ route('products.index', ['kategori' => 'dekorasi']) }}" class="text-sm text-gray-600 hover:text-[#C5A880]">Dekorasi</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <script>
        // Simple Vanilla JS to toggle mobile menu
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu-container');
            const icon = btn.querySelector('i');

            if (btn && menu) {
                btn.addEventListener('click', function() {
                    menu.classList.toggle('hidden');
                    
                    // Toggle Icon
                    if (menu.classList.contains('hidden')) {
                        icon.classList.remove('fa-xmark');
                        icon.classList.add('fa-bars');
                    } else {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-xmark');
                    }
                });
            }
        });
    </script>

    <!-- Main Content Area -->
    <main class="flex-grow">
        <!-- Toast Alerts -->
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="flex items-center p-4 mb-4 text-sm text-emerald-800 border border-emerald-200 rounded-lg bg-emerald-50" role="alert">
                    <i class="fa-solid fa-circle-check text-base mr-3"></i>
                    <div>
                        <span class="font-medium">Berhasil!</span> {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-200 rounded-lg bg-red-50" role="alert">
                    <i class="fa-solid fa-triangle-exclamation text-base mr-3"></i>
                    <div>
                        <span class="font-medium">Gagal!</span> {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#1A1A1A] text-gray-400 pt-16 pb-8 border-t border-gray-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 pb-12 border-b border-gray-800">
                <!-- Company Bio -->
                <div class="col-span-1 md:col-span-1">
                    <h3 class="serif-title text-white text-xl font-bold tracking-wider mb-5">FURNISHARE<span class="text-[#C5A880]">.</span></h3>
                    <p class="text-xs text-gray-400 leading-relaxed mb-6">
                        Furnishare merupakan platform premium penyedia furniture berdesain minimalis dan modern. Kami menggabungkan keindahan arsitektural dengan material terbaik untuk ruang hidup yang menginspirasi.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="h-8 w-8 rounded-full bg-gray-800 hover:bg-[#C5A880] text-white flex items-center justify-center transition duration-300 text-xs"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="h-8 w-8 rounded-full bg-gray-800 hover:bg-[#C5A880] text-white flex items-center justify-center transition duration-300 text-xs"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="h-8 w-8 rounded-full bg-gray-800 hover:bg-[#C5A880] text-white flex items-center justify-center transition duration-300 text-xs"><i class="fa-brands fa-pinterest-p"></i></a>
                    </div>
                </div>

                <!-- Collections -->
                <div>
                    <h4 class="text-sm font-semibold tracking-wider text-white uppercase mb-5">Koleksi Kami</h4>
                    <ul class="space-y-3 text-xs">
                        <li><a href="{{ route('products.index', ['kategori' => 'sofa']) }}" class="hover:text-white transition duration-200">Sofa Premium</a></li>
                        <li><a href="{{ route('products.index', ['kategori' => 'meja']) }}" class="hover:text-white transition duration-200">Meja Solid Wood</a></li>
                        <li><a href="{{ route('products.index', ['kategori' => 'kursi']) }}" class="hover:text-white transition duration-200">Kursi Makan & Bar</a></li>
                        <li><a href="{{ route('products.index', ['kategori' => 'lemari']) }}" class="hover:text-white transition duration-200">Kabinet & Lemari</a></li>
                        <li><a href="{{ route('products.index', ['kategori' => 'dekorasi']) }}" class="hover:text-white transition duration-200">Dekorasi Rumah</a></li>
                    </ul>
                </div>

                <!-- Customer Service -->
                <div>
                    <h4 class="text-sm font-semibold tracking-wider text-white uppercase mb-5">Bantuan & Layanan</h4>
                    <ul class="space-y-3 text-xs">
                        <li><a href="#" class="hover:text-white transition duration-200">FAQ / Tanya Jawab</a></li>
                        <li><a href="#" class="hover:text-white transition duration-200">Kebijakan Garansi</a></li>
                        <li><a href="#" class="hover:text-white transition duration-200">Panduan Perawatan</a></li>
                        <li><a href="#" class="hover:text-white transition duration-200">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-white transition duration-200">Kebijakan Pengiriman</a></li>
                    </ul>
                </div>

                <!-- Contact & Showroom -->
                <div>
                    <h4 class="text-sm font-semibold tracking-wider text-white uppercase mb-5">Showroom & Kontak</h4>
                    <ul class="space-y-4 text-xs">
                        <li class="flex items-start">
                            <i class="fa-solid fa-location-dot mt-1 mr-3 text-[#C5A880]"></i>
                            <span>Jl. Furniture Indah Raya No. 42, Kebayoran Baru, Jakarta Selatan, 12150</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fa-solid fa-phone mr-3 text-[#C5A880]"></i>
                            <span>+62 823-7136-2312</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fa-solid fa-envelope mr-3 text-[#C5A880]"></i>
                            <span>contact@furnishare.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright and Legal -->
            <div class="flex flex-col sm:flex-row justify-between items-center pt-8 text-xs text-gray-500">
                <p>&copy; {{ date('Y') }} Furnishare. Semua Hak Cipta Dilindungi.</p>
                <div class="flex space-x-6 mt-4 sm:mt-0">
                    <a href="#" class="hover:text-white transition">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-white transition">Peta Situs</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6282371362312?text=Halo%20Furnishare%2C%20saya%20tertarik%20dengan%20koleksi%20furniture%20modern%20Anda%20dan%20ingin%20berkonsultasi." 
       target="_blank" 
       rel="noopener noreferrer" 
       class="fixed bottom-6 right-6 z-50 bg-[#25D366] hover:bg-[#20ba5a] text-white h-14 w-14 rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group"
       title="Hubungi Kami di WhatsApp">
        <i class="fa-brands fa-whatsapp text-3xl"></i>
        <!-- Tooltip/Badge on Hover -->
        <span class="absolute right-16 bg-[#1A1A1A] text-white text-[10px] font-bold tracking-wider uppercase py-2 px-3 rounded-lg shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap">
            Hubungi Admin
        </span>
    </a>

    @stack('scripts')
</body>
</html>
