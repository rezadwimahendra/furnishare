@extends('layouts.admin')

@section('title', 'Kelola Produk - Furnishare Admin')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
        <div>
            <h1 class="serif-logo text-3xl font-bold text-gray-900 mb-2">Manajemen Produk Furniture</h1>
            <p class="text-xs text-gray-500 font-light">Kelola katalog produk furniture Anda, termasuk penyesuaian stok, harga, status produk populer, dan opsi custom.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="inline-flex justify-center items-center bg-[#1A1A1A] hover:bg-[#C5A880] text-white text-xs font-bold tracking-wider uppercase py-3 px-5 rounded-lg shadow-sm hover:shadow transition duration-200">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Produk
        </a>
    </div>

    <!-- Products Table Card -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-8">
        @if($products->isEmpty())
            <div class="text-center py-16 text-xs text-gray-400 font-light">
                <i class="fa-solid fa-couch text-4xl mb-4 block text-gray-300"></i> Belum ada produk furniture tersimpan.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs font-light">
                    <thead>
                        <tr class="border-b border-gray-100 text-gray-400 font-bold uppercase text-[10px]">
                            <th class="py-3">Gambar</th>
                            <th class="py-3">Nama Produk</th>
                            <th class="py-3">Kategori</th>
                            <th class="py-3 text-right">Harga Base</th>
                            <th class="py-3 text-center">Stok</th>
                            <th class="py-3 text-center">Populer</th>
                            <th class="py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-600">
                        @foreach($products as $prod)
                            <tr>
                                <!-- Thumbnail Image Cell -->
                                <td class="py-4">
                                    <div class="h-14 w-14 rounded-lg overflow-hidden bg-gray-50 border border-gray-100 flex-shrink-0">
                                        @if($prod->image)
                                            <img src="{{ asset('storage/' . $prod->image) }}" alt="{{ $prod->name }}" class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ $prod->image_url ?? 'https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=150' }}" alt="{{ $prod->name }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                </td>

                                <!-- Product Name -->
                                <td class="py-4 max-w-xs">
                                    <div class="font-semibold text-gray-800 text-sm">
                                        {{ $prod->name }}
                                    </div>
                                    <span class="block text-[9px] text-gray-400 font-mono mt-0.5">/{{ $prod->slug }}</span>
                                </td>

                                <!-- Category -->
                                <td class="py-4 text-gray-500">
                                    <span class="bg-gray-50 text-gray-600 border border-gray-100 text-[10px] px-2 py-0.5 rounded font-medium">
                                        {{ $prod->category->name ?? 'Tanpa Kategori' }}
                                    </span>
                                </td>

                                <!-- Price -->
                                <td class="py-4 text-right font-bold text-gray-800">
                                    Rp {{ number_format($prod->price, 0, ',', '.') }}
                                </td>

                                <!-- Stock -->
                                <td class="py-4 text-center">
                                    @if($prod->stock == 0)
                                        <span class="text-red-500 font-bold bg-red-50 px-2 py-0.5 rounded text-[10px]">Habis</span>
                                    @elseif($prod->stock <= 5)
                                        <span class="text-amber-600 font-bold bg-amber-50 px-2 py-0.5 rounded text-[10px]">Kritis ({{ $prod->stock }})</span>
                                    @else
                                        <span class="text-gray-800 font-medium">{{ $prod->stock }} Unit</span>
                                    @endif
                                </td>

                                <!-- Popular Badge -->
                                <td class="py-4 text-center">
                                    @if($prod->is_popular)
                                        <span class="bg-amber-50 border border-amber-200 text-amber-600 text-[9px] font-bold px-2 py-0.5 rounded">
                                            <i class="fa-solid fa-star text-[8px] mr-1"></i> Ya
                                        </span>
                                    @else
                                        <span class="text-gray-400 font-light">-</span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.products.edit', $prod->id) }}" class="bg-gray-100 hover:bg-[#C5A880] hover:text-white text-gray-600 px-3 py-1.5 rounded transition text-[10px] font-bold">
                                            <i class="fa-solid fa-pen-to-square"></i> EDIT
                                        </a>
                                        
                                        <form action="{{ route('admin.products.destroy', $prod->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
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

            <!-- Custom Pagination -->
            <div class="mt-8 border-t border-gray-50 pt-6">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
