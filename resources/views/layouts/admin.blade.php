<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Furnishare')</title>
    
    <!-- Google Fonts: Outfit & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #FAF8F5;
        }
        .serif-logo {
            font-family: 'Playfair Display', serif;
        }
        .text-bronze {
            color: #C5A880;
        }
        .bg-bronze {
            background-color: #C5A880;
        }
    </style>
</head>
<body class="min-h-screen flex bg-gray-50 text-gray-800">

    <!-- Left Sidebar Menu -->
    <aside class="w-64 bg-[#1A1A1A] text-gray-400 flex flex-col justify-between flex-shrink-0 min-h-screen shadow-lg">
        <div>
            <!-- Sidebar Header / Logo -->
            <div class="h-20 flex items-center justify-center border-b border-gray-800 px-6">
                <a href="{{ route('admin.dashboard') }}" class="serif-logo text-xl font-bold tracking-wider text-white">
                    FURNISHARE<span class="text-[#C5A880]">.</span>
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="mt-8 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg text-xs font-semibold uppercase tracking-wider {{ request()->routeIs('admin.dashboard') ? 'bg-[#C5A880] text-white' : 'hover:bg-gray-800 hover:text-white' }} transition duration-200">
                    <i class="fa-solid fa-chart-line text-sm mr-3"></i> Ringkasan Bisnis
                </a>
                
                <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-3 rounded-lg text-xs font-semibold uppercase tracking-wider {{ request()->routeIs('admin.categories.*') ? 'bg-[#C5A880] text-white' : 'hover:bg-gray-800 hover:text-white' }} transition duration-200">
                    <i class="fa-solid fa-layer-group text-sm mr-3"></i> Kelola Kategori
                </a>

                <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3 rounded-lg text-xs font-semibold uppercase tracking-wider {{ request()->routeIs('admin.products.*') ? 'bg-[#C5A880] text-white' : 'hover:bg-gray-800 hover:text-white' }} transition duration-200">
                    <i class="fa-solid fa-couch text-sm mr-3"></i> Kelola Produk
                </a>

                <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-3 rounded-lg text-xs font-semibold uppercase tracking-wider {{ request()->routeIs('admin.orders.*') ? 'bg-[#C5A880] text-white' : 'hover:bg-gray-800 hover:text-white' }} transition duration-200">
                    <i class="fa-solid fa-truck-ramp-box text-sm mr-3"></i> Kelola Pesanan
                </a>
            </nav>
        </div>

        <!-- Sidebar Footer -->
        <div class="p-6 border-t border-gray-800">
            <a href="{{ route('home') }}" class="flex items-center text-xs hover:text-white transition duration-200">
                <i class="fa-solid fa-arrow-left-long mr-2"></i> Ke Halaman Toko
            </a>
            
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="w-full text-left text-xs text-red-400 hover:text-red-300 font-semibold transition">
                    <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Log Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Right Side Content Pane -->
    <div class="flex-grow flex flex-col min-h-screen">
        <!-- Top header panel -->
        <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-8">
            <div class="text-xs text-gray-500 font-light">
                Selamat Datang Kembali, <span class="font-bold text-gray-800">{{ auth()->user()->name }}</span>
            </div>
            
            <div class="flex items-center space-x-4">
                <span class="bg-gray-100 text-gray-600 text-[10px] font-bold uppercase px-3 py-1 rounded-full border border-gray-200">
                    ADMIN PANEL
                </span>
            </div>
        </header>

        <!-- Dynamic Main Admin Content Grid -->
        <main class="p-8 flex-grow">
            <!-- Alerts inside Admin -->
            @if(session('success'))
                <div class="flex items-center p-4 mb-6 text-sm text-emerald-800 border border-emerald-200 rounded-lg bg-emerald-50" role="alert">
                    <i class="fa-solid fa-circle-check text-base mr-3"></i>
                    <div>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="flex items-center p-4 mb-6 text-sm text-red-800 border border-red-200 rounded-lg bg-red-50" role="alert">
                    <i class="fa-solid fa-triangle-exclamation text-base mr-3"></i>
                    <div>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
