<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Furnishare - Autentikasi')</title>

        <!-- Google Fonts: Outfit & Playfair Display -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
        
        <!-- FontAwesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
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
        </style>
    </head>
    <body class="antialiased min-h-screen bg-[#FAF8F5]">
        <div class="min-h-screen grid grid-cols-1 lg:grid-cols-12">
            
            <!-- Left Side: Visual Showcase (Only on desktop) -->
            <div class="hidden lg:flex lg:col-span-5 xl:col-span-6 relative bg-[#1A1A1A] flex-col justify-between p-12 text-white overflow-hidden">
                <!-- Background Image -->
                <div class="absolute inset-0 z-0">
                    <img src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?q=80&w=1200" alt="Furnishare Showroom" class="w-full h-full object-cover opacity-60">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                </div>
                
                <!-- Logo -->
                <div class="relative z-10">
                    <a href="{{ route('home') }}" class="serif-title text-3xl font-bold tracking-wider text-white">
                        FURNISHARE<span class="text-[#C5A880]">.</span>
                    </a>
                </div>
                
                <!-- Quote/Text -->
                <div class="relative z-10 max-w-md">
                    <p class="text-xs font-bold tracking-widest text-[#C5A880] uppercase mb-2">Seni Ruang Minimalis Modern</p>
                    <h2 class="serif-title text-3xl font-semibold leading-tight mb-4">
                        "Rumah adalah kanvas dari jiwa Anda. Isi dengan harmoni dan keindahan fungsional."
                    </h2>
                    <div class="w-12 h-0.5 bg-[#C5A880] mb-4"></div>
                    <p class="text-xs text-gray-300">Temukan koleksi furnitur eksklusif yang dirancang oleh pengrajin berlisensi.</p>
                </div>
                
                <!-- Footer Info -->
                <div class="relative z-10 flex justify-between items-center text-xs text-gray-400">
                    <p>&copy; {{ date('Y') }} Furnishare. Hak Cipta Dilindungi.</p>
                    <a href="{{ route('home') }}" class="hover:text-white transition">Kembali ke Beranda <i class="fa-solid fa-arrow-right ml-1"></i></a>
                </div>
            </div>
            
            <!-- Right Side: Auth Forms -->
            <div class="col-span-1 lg:col-span-7 xl:col-span-6 flex flex-col justify-center items-center px-4 py-12 sm:px-16 lg:px-20 bg-[#FAF8F5]">
                <div class="w-full max-w-md">
                    
                    <!-- Mobile Logo (Hidden on desktop) -->
                    <div class="lg:hidden text-center mb-8">
                        <a href="{{ route('home') }}" class="serif-title text-3xl font-bold tracking-wider text-[#1A1A1A]">
                            FURNISHARE<span class="text-[#C5A880]">.</span>
                        </a>
                        <p class="text-xs text-gray-400 mt-2 font-light">Seni Ruang Minimalis Modern</p>
                    </div>

                    <!-- Main Container Card -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100/80 p-8 sm:p-10 transition-all duration-300">
                        {{ $slot }}
                    </div>

                    <!-- Return Home link for Mobile -->
                    <div class="lg:hidden text-center mt-6">
                        <a href="{{ route('home') }}" class="text-xs text-gray-500 hover:text-[#C5A880] transition">
                            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </body>
</html>
