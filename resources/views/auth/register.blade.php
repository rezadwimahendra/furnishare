@section('title', 'Daftar - Furnishare')

<x-guest-layout>
    <!-- Header Form -->
    <div class="mb-8">
        <h2 class="serif-title text-2xl font-bold text-[#1A1A1A]">Buat Akun Baru</h2>
        <p class="text-xs text-gray-500 mt-1.5">Daftarkan diri Anda untuk mulai memesan furnitur minimalis impian.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-5">
            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Nama Lengkap</label>
            <div class="relative rounded-xl shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-regular fa-user text-sm"></i>
                </div>
                <input id="name" 
                       type="text" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required 
                       autofocus 
                       autocomplete="name"
                       placeholder="Nama lengkap Anda"
                       class="block w-full pl-10 pr-4 py-3 bg-[#FAF8F5] border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-xl text-sm transition-all duration-300 placeholder-gray-400/80 outline-none">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

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
                       autocomplete="username"
                       placeholder="nama@email.com"
                       class="block w-full pl-10 pr-4 py-3 bg-[#FAF8F5] border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-xl text-sm transition-all duration-300 placeholder-gray-400/80 outline-none">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div class="mb-5">
            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Kata Sandi</label>
            <div class="relative rounded-xl shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-solid fa-lock text-sm"></i>
                </div>
                <input id="password" 
                       type="password" 
                       name="password" 
                       required 
                       autocomplete="new-password"
                       placeholder="Minimal 8 karakter"
                       class="block w-full pl-10 pr-4 py-3 bg-[#FAF8F5] border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-xl text-sm transition-all duration-300 placeholder-gray-400/80 outline-none">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Konfirmasi Kata Sandi</label>
            <div class="relative rounded-xl shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-solid fa-shield-halved text-sm"></i>
                </div>
                <input id="password_confirmation" 
                       type="password" 
                       name="password_confirmation" 
                       required 
                       placeholder="Ulangi kata sandi"
                       class="block w-full pl-10 pr-4 py-3 bg-[#FAF8F5] border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-xl text-sm transition-all duration-300 placeholder-gray-400/80 outline-none">
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <!-- Action Button -->
        <div class="space-y-4">
            <button type="submit" class="w-full py-3.5 px-4 bg-[#1A1A1A] hover:bg-[#C5A880] active:bg-[#B4966E] text-white font-semibold rounded-full shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 text-sm tracking-wide">
                Daftar Akun Baru
            </button>
            
            <div class="text-center pt-2">
                <span class="text-xs text-gray-500 font-light">Sudah memiliki akun?</span>
                <a href="{{ route('login') }}" class="text-xs font-bold text-[#C5A880] hover:text-[#B4966E] ml-1 transition duration-200">
                    Masuk Sekarang
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
