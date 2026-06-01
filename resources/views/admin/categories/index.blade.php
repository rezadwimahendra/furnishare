@extends('layouts.admin')

@section('title', 'Kelola Kategori - Furnishare Admin')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
        <div>
            <h1 class="serif-logo text-3xl font-bold text-gray-900 mb-2">Manajemen Kategori Furniture</h1>
            <p class="text-xs text-gray-500 font-light">Kelompokkan produk furniture Anda ke dalam kategori-kategori berdasarkan fungsi dan ruang di dalam rumah.</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="inline-flex justify-center items-center bg-[#1A1A1A] hover:bg-[#C5A880] text-white text-xs font-bold tracking-wider uppercase py-3 px-5 rounded-lg shadow-sm hover:shadow transition duration-200">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Kategori
        </a>
    </div>

    <!-- Categories Table Card -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-8">
        @if($categories->isEmpty())
            <div class="text-center py-16 text-xs text-gray-400 font-light">
                <i class="fa-solid fa-layer-group text-4xl mb-4 block text-gray-300"></i> Belum ada kategori tersimpan.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs font-light">
                    <thead>
                        <tr class="border-b border-gray-100 text-gray-400 font-bold uppercase text-[10px]">
                            <th class="py-3">Cover Image</th>
                            <th class="py-3">Nama Kategori</th>
                            <th class="py-3">Deskripsi</th>
                            <th class="py-3 text-center">Jumlah Produk</th>
                            <th class="py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-600">
                        @php
                            $categoryImages = [
                                'kursi' => 'https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=150',
                                'meja' => 'https://images.unsplash.com/photo-1530018607912-eff2df114fbe?q=80&w=150',
                                'lemari' => 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?q=80&w=150',
                                'sofa' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?q=80&w=150',
                                'dekorasi' => 'https://images.unsplash.com/photo-1618220179428-22790b461013?q=80&w=150',
                            ];
                        @endphp
                        @foreach($categories as $cat)
                            <tr>
                                <!-- Cover Image Cell -->
                                <td class="py-4">
                                    <div class="h-12 w-12 rounded-lg overflow-hidden bg-gray-100 border border-gray-100 flex-shrink-0">
                                        @if($cat->image)
                                            <img src="{{ asset('storage/' . $cat->image) }}" alt="{{ $cat->name }}" class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ $categoryImages[$cat->slug] ?? 'https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=150' }}" alt="{{ $cat->name }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                </td>

                                <!-- Category Name -->
                                <td class="py-4 font-semibold text-gray-800 text-sm">
                                    {{ $cat->name }}
                                    <span class="block text-[10px] text-gray-400 font-mono mt-0.5">/{{ $cat->slug }}</span>
                                </td>

                                <!-- Category Description -->
                                <td class="py-4 max-w-sm text-gray-400 leading-relaxed font-light">
                                    {{ $cat->description ?? 'Tidak ada deskripsi.' }}
                                </td>

                                <!-- Product Count -->
                                <td class="py-4 text-center font-bold text-gray-800">
                                    {{ $cat->products_count }} Unit
                                </td>

                                <!-- Actions -->
                                <td class="py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.categories.edit', $cat->id) }}" class="bg-gray-100 hover:bg-[#C5A880] hover:text-white text-gray-600 px-3 py-1.5 rounded transition text-[10px] font-bold">
                                            <i class="fa-solid fa-pen-to-square"></i> EDIT
                                        </a>
                                        
                                        <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Semua produk yang terhubung juga akan ikut terhapus.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-50 hover:bg-red-500 hover:text-white text-red-600 px-3 py-1.5 rounded transition text-[10px] font-bold">
                                                <i class="fa-regular fa-trash-can"></i> HAPUS
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
