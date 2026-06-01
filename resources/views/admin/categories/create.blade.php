@extends('layouts.admin')

@section('title', 'Tambah Kategori - Furnishare Admin')

@section('content')
    <div class="mb-10">
        <a href="{{ route('admin.categories.index') }}" class="text-xs text-gray-400 hover:text-gray-600 transition mb-3 inline-block">
            <i class="fa-solid fa-arrow-left-long mr-1"></i> Kembali ke Daftar Kategori
        </a>
        <h1 class="serif-logo text-3xl font-bold text-gray-900">Tambah Kategori Baru</h1>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-8 max-w-2xl">
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Nama Kategori</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Contoh: Kursi Santai" class="w-full bg-gray-50 border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-4 py-3 text-xs text-gray-800 focus:outline-none">
                @error('name')
                    <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Deskripsi Kategori</label>
                <textarea id="description" name="description" rows="4" placeholder="Tuliskan penjelasan singkat mengenai ruang lingkup kategori produk ini." class="w-full bg-gray-50 border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-4 py-3 text-xs text-gray-800 focus:outline-none leading-relaxed">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image Upload -->
            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Gambar Sampul Kategori (Opsional)</label>
                <input type="file" name="image" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-[#C5A880] hover:file:text-white cursor-pointer transition">
                <p class="text-[9px] text-gray-400 mt-1">Mendukung format JPEG, PNG, JPG, WEBP. Maksimal ukuran file 2MB.</p>
                @error('image')
                    <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="pt-4 border-t border-gray-100 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.categories.index') }}" class="text-xs font-semibold text-gray-500 hover:text-gray-800 py-3 px-6 transition">
                    Batalkan
                </a>
                <button type="submit" class="inline-flex justify-center items-center bg-[#1A1A1A] hover:bg-[#C5A880] text-white text-xs font-bold tracking-wider uppercase py-3.5 px-6 rounded-lg transition">
                    Simpan Kategori <i class="fa-solid fa-check ml-2"></i>
                </button>
            </div>
        </form>
    </div>
@endsection
