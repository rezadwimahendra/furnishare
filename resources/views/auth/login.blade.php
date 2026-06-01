@section('title', 'Masuk - Furnishare')

<x-guest-layout>
    <!-- Header Form -->
    <div class="mb-8">
        <h2 class="serif-title text-2xl font-bold text-[#1A1A1A]">Selamat Datang Kembali</h2>
        <p class="text-xs text-gray-500 mt-1.5">Masuk ke akun Furnishare Anda untuk mengelola pesanan dan keranjang.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-5">
            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Alamat Email</label>
            <div class="relative rounded-xl shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-regular fa-envelope text-sm"></i>
                </div>
                <input id="email" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       autocomplete="username"
                       placeholder="nama@email.com"
                       class="block w-full pl-10 pr-4 py-3 bg-[#FAF8F5] border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-xl text-sm transition-all duration-300 placeholder-gray-400/80 outline-none">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div class="mb-5">
            <div class="flex justify-between items-center mb-2">
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-700">Kata Sandi</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-[#C5A880] hover:text-[#B4966E] transition duration-200" href="{{ route('password.request') }}">
                        Lupa Sandi?
                    </a>
                @endif
            </div>
            <div class="relative rounded-xl shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-solid fa-lock text-sm"></i>
                </div>
                <input id="password" 
                       type="password" 
                       name="password" 
                       required 
                       autocomplete="current-password"
                       placeholder="••••••••"
                       class="block w-full pl-10 pr-4 py-3 bg-[#FAF8F5] border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-xl text-sm transition-all duration-300 placeholder-gray-400/80 outline-none">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mb-6">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" 
                       type="checkbox" 
                       class="rounded border-gray-300 text-[#C5A880] focus:ring-[#C5A880]/30 focus:border-[#C5A880] h-4 w-4" 
                       name="remember">
                <span class="ms-2.5 text-xs text-gray-500 font-medium">Ingat saya di perangkat ini</span>
            </label>
        </div>

        <!-- Action Button -->
        <div class="space-y-4">
            <button type="submit" class="w-full py-3.5 px-4 bg-[#1A1A1A] hover:bg-[#C5A880] active:bg-[#B4966E] text-white font-semibold rounded-full shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 text-sm tracking-wide">
                Masuk ke Akun
            </button>
            
            <div class="text-center pt-2">
                <span class="text-xs text-gray-500 font-light">Belum memiliki akun?</span>
                <a href="{{ route('register') }}" class="text-xs font-bold text-[#C5A880] hover:text-[#B4966E] ml-1 transition duration-200">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
