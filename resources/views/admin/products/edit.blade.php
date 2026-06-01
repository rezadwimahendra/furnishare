@extends('layouts.admin')

@section('title', 'Edit Produk - Furnishare Admin')

@section('content')
    <div class="mb-10">
        <a href="{{ route('admin.products.index') }}" class="text-xs text-gray-400 hover:text-gray-600 transition mb-3 inline-block">
            <i class="fa-solid fa-arrow-left-long mr-1"></i> Kembali ke Daftar Produk
        </a>
        <h1 class="serif-logo text-3xl font-bold text-gray-900">Edit Produk Furniture</h1>
    </div>

    @php
        $colors = $product->custom_options['colors'] ?? [];
        $foam_colors = $product->custom_options['foam_colors'] ?? [];
        $materials = $product->custom_options['materials'] ?? [];
        $sizes = $product->custom_options['sizes'] ?? [];
    @endphp

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        @method('PUT')

        <!-- Main Product Information (Left: 2 Columns) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Core Details Card -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-8 space-y-6">
                <h3 class="serif-logo text-base font-bold text-gray-900 pb-3 border-b border-gray-100">Informasi Produk Utama</h3>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Nama Furniture</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required placeholder="Contoh: Kursi Kayu Jati Minimalis" class="w-full bg-gray-50 border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-4 py-3 text-xs text-gray-800 focus:outline-none">
                    @error('name')
                        <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Deskripsi Detail</label>
                    <textarea id="description" name="description" rows="8" placeholder="Tulis deskripsi detail produk, termasuk keunggulan, bahan baku utama, dimensi ukuran dasar, dan rekomendasi penataan ruang." class="w-full bg-gray-50 border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-4 py-3 text-xs text-gray-800 focus:outline-none leading-relaxed">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Custom Options Section (Dynamic Customization Fields) -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-8 space-y-8">
                <div>
                    <h3 class="serif-logo text-base font-bold text-gray-900 mb-1">Opsi Customisasi Furniture</h3>
                    <p class="text-[10px] text-gray-400 font-light">Tentukan kustomisasi warna, material, dan ukuran yang dapat dipilih pembeli beserta penambahan harga.</p>
                </div>
                
                <div class="w-full h-px bg-gray-100"></div>

                <!-- 1. Colors Customization -->
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Opsi Pilihan Warna</label>
                        <button type="button" onclick="addColorRow()" class="text-[10px] font-bold text-[#C5A880] hover:underline uppercase flex items-center">
                            <i class="fa-solid fa-plus-circle mr-1"></i> Tambah Warna
                        </button>
                    </div>

                    <div id="colors-container" class="space-y-3">
                        @if(empty($colors))
                            <!-- Default empty row if none saved -->
                            <div class="flex items-center gap-3 color-row">
                                <input type="text" name="colors[name][]" placeholder="Nama Warna (Contoh: Charcoal)" class="flex-grow bg-gray-50 border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-3 py-2 text-xs text-gray-800 focus:outline-none">
                                <div class="flex items-center gap-2 border border-gray-200 bg-gray-50 px-3 py-1.5 rounded-lg flex-shrink-0">
                                    <input type="color" name="colors[value][]" value="#1A1A1A" class="w-6 h-6 border-0 bg-transparent cursor-pointer rounded">
                                    <span class="text-[10px] font-mono text-gray-400">Pilih Warna</span>
                                </div>
                                <input type="file" name="colors[image][]" class="w-44 text-[10px] text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-[9px] file:font-semibold file:bg-[#1A1A1A] file:text-white hover:file:bg-[#C5A880] cursor-pointer">
                                <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700 px-2 py-1"><i class="fa-regular fa-trash-can"></i></button>
                            </div>
                        @else
                            @foreach($colors as $color)
                                <div class="flex items-center gap-3 color-row">
                                    <input type="text" name="colors[name][]" value="{{ $color['name'] ?? '' }}" placeholder="Nama Warna (Contoh: Charcoal)" class="flex-grow bg-gray-50 border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-3 py-2 text-xs text-gray-800 focus:outline-none">
                                    <div class="flex items-center gap-2 border border-gray-200 bg-gray-50 px-3 py-1.5 rounded-lg flex-shrink-0">
                                        <input type="color" name="colors[value][]" value="{{ $color['value'] ?? '#000000' }}" class="w-6 h-6 border-0 bg-transparent cursor-pointer rounded">
                                        <span class="text-[10px] font-mono text-gray-400">Pilih Warna</span>
                                    </div>
                                    @if(isset($color['image']))
                                        <div class="w-8 h-8 rounded shrink-0 bg-gray-200 overflow-hidden">
                                            <img src="{{ str_starts_with($color['image'], 'http') ? $color['image'] : asset('storage/' . $color['image']) }}" class="w-full h-full object-cover">
                                        </div>
                                    @endif
                                    <input type="file" name="colors[image][]" class="w-44 text-[10px] text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-[9px] file:font-semibold file:bg-[#1A1A1A] file:text-white hover:file:bg-[#C5A880] cursor-pointer">
                                    <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700 px-2 py-1"><i class="fa-regular fa-trash-can"></i></button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- 1b. Foam Colors Customization (Kursi & Sofa) -->
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Opsi Pilihan Warna Busa</label>
                        <button type="button" onclick="addFoamColorRow()" class="text-[10px] font-bold text-[#C5A880] hover:underline uppercase flex items-center">
                            <i class="fa-solid fa-plus-circle mr-1"></i> Tambah Warna Busa
                        </button>
                    </div>

                    <div id="foam-colors-container" class="space-y-3">
                        @if(empty($foam_colors))
                            <!-- Default empty row if none saved -->
                            <div class="flex items-center gap-3 foam-color-row">
                                <input type="text" name="foam_colors[name][]" placeholder="Nama Warna Busa (Contoh: Putih Tulang)" class="flex-grow bg-gray-50 border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-3 py-2 text-xs text-gray-800 focus:outline-none">
                                <div class="flex items-center gap-2 border border-gray-200 bg-gray-50 px-3 py-1.5 rounded-lg flex-shrink-0">
                                    <input type="color" name="foam_colors[value][]" value="#F8F6F0" class="w-6 h-6 border-0 bg-transparent cursor-pointer rounded">
                                    <span class="text-[10px] font-mono text-gray-400">Pilih Warna</span>
                                </div>
                                <input type="file" name="foam_colors[image][]" class="w-44 text-[10px] text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-[9px] file:font-semibold file:bg-[#1A1A1A] file:text-white hover:file:bg-[#C5A880] cursor-pointer">
                                <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700 px-2 py-1"><i class="fa-regular fa-trash-can"></i></button>
                            </div>
                        @else
                            @foreach($foam_colors as $fc)
                                <div class="flex items-center gap-3 foam-color-row">
                                    <input type="text" name="foam_colors[name][]" value="{{ $fc['name'] ?? '' }}" placeholder="Nama Warna Busa (Contoh: Putih Tulang)" class="flex-grow bg-gray-50 border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-3 py-2 text-xs text-gray-800 focus:outline-none">
                                    <div class="flex items-center gap-2 border border-gray-200 bg-gray-50 px-3 py-1.5 rounded-lg flex-shrink-0">
                                        <input type="color" name="foam_colors[value][]" value="{{ $fc['value'] ?? '#F8F6F0' }}" class="w-6 h-6 border-0 bg-transparent cursor-pointer rounded">
                                        <span class="text-[10px] font-mono text-gray-400">Pilih Warna</span>
                                    </div>
                                    @if(isset($fc['image']))
                                        <div class="w-8 h-8 rounded shrink-0 bg-gray-200 overflow-hidden">
                                            <img src="{{ str_starts_with($fc['image'], 'http') ? $fc['image'] : asset('storage/' . $fc['image']) }}" class="w-full h-full object-cover">
                                        </div>
                                    @endif
                                    <input type="file" name="foam_colors[image][]" class="w-44 text-[10px] text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-[9px] file:font-semibold file:bg-[#1A1A1A] file:text-white hover:file:bg-[#C5A880] cursor-pointer">
                                    <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700 px-2 py-1"><i class="fa-regular fa-trash-can"></i></button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- 2. Materials Customization -->
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Opsi Pilihan Material</label>
                        <button type="button" onclick="addMaterialRow()" class="text-[10px] font-bold text-[#C5A880] hover:underline uppercase flex items-center">
                            <i class="fa-solid fa-plus-circle mr-1"></i> Tambah Material
                        </button>
                    </div>

                    <div id="materials-container" class="space-y-3">
                        @if(empty($materials))
                            <!-- Default empty row if none saved -->
                            <div class="flex items-center gap-3 material-row">
                                <input type="text" name="materials[name][]" placeholder="Nama Material (Contoh: Kayu Jati Premium)" class="flex-grow bg-gray-50 border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-3 py-2 text-xs text-gray-800 focus:outline-none">
                                <div class="flex items-center bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 w-48 flex-shrink-0">
                                    <span class="text-[10px] text-gray-400 mr-1.5 font-bold">+$</span>
                                    <input type="number" name="materials[price_modifier][]" value="0" min="0" placeholder="Tambahan Harga" class="bg-transparent border-0 w-full focus:outline-none text-xs font-semibold text-gray-800 focus:ring-0 p-0">
                                </div>
                                <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700 px-2 py-1"><i class="fa-regular fa-trash-can"></i></button>
                            </div>
                        @else
                            @foreach($materials as $material)
                                <div class="flex items-center gap-3 material-row">
                                    <input type="text" name="materials[name][]" value="{{ $material['name'] ?? '' }}" placeholder="Nama Material (Contoh: Kayu Jati Premium)" class="flex-grow bg-gray-50 border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-3 py-2 text-xs text-gray-800 focus:outline-none">
                                    <div class="flex items-center bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 w-48 flex-shrink-0">
                                        <span class="text-[10px] text-gray-400 mr-1.5 font-bold">+$</span>
                                        <input type="number" name="materials[price_modifier][]" value="{{ (int)($material['price_modifier'] ?? 0) }}" min="0" placeholder="Tambahan Harga" class="bg-transparent border-0 w-full focus:outline-none text-xs font-semibold text-gray-800 focus:ring-0 p-0">
                                    </div>
                                    <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700 px-2 py-1"><i class="fa-regular fa-trash-can"></i></button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- 3. Sizes Customization -->
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Opsi Pilihan Ukuran</label>
                        <button type="button" onclick="addSizeRow()" class="text-[10px] font-bold text-[#C5A880] hover:underline uppercase flex items-center">
                            <i class="fa-solid fa-plus-circle mr-1"></i> Tambah Ukuran
                        </button>
                    </div>

                    <div id="sizes-container" class="space-y-3">
                        @if(empty($sizes))
                            <!-- Default empty row if none saved -->
                            <div class="flex items-center gap-3 size-row">
                                <input type="text" name="sizes[name][]" placeholder="Nama Ukuran (Contoh: 3 Seater / Large)" class="flex-grow bg-gray-50 border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-3 py-2 text-xs text-gray-800 focus:outline-none">
                                <div class="flex items-center bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 w-48 flex-shrink-0">
                                    <span class="text-[10px] text-gray-400 mr-1.5 font-bold">+$</span>
                                    <input type="number" name="sizes[price_modifier][]" value="0" min="0" placeholder="Tambahan Harga" class="bg-transparent border-0 w-full focus:outline-none text-xs font-semibold text-gray-800 focus:ring-0 p-0">
                                </div>
                                <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700 px-2 py-1"><i class="fa-regular fa-trash-can"></i></button>
                            </div>
                        @else
                            @foreach($sizes as $size)
                                <div class="flex items-center gap-3 size-row">
                                    <input type="text" name="sizes[name][]" value="{{ $size['name'] ?? '' }}" placeholder="Nama Ukuran (Contoh: 3 Seater / Large)" class="flex-grow bg-gray-50 border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-3 py-2 text-xs text-gray-800 focus:outline-none">
                                    <div class="flex items-center bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 w-48 flex-shrink-0">
                                        <span class="text-[10px] text-gray-400 mr-1.5 font-bold">+$</span>
                                        <input type="number" name="sizes[price_modifier][]" value="{{ (int)($size['price_modifier'] ?? 0) }}" min="0" placeholder="Tambahan Harga" class="bg-transparent border-0 w-full focus:outline-none text-xs font-semibold text-gray-800 focus:ring-0 p-0">
                                    </div>
                                    <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700 px-2 py-1"><i class="fa-regular fa-trash-can"></i></button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>

        </div>

        <!-- Inventory and Publish Panel (Right: 1 Column) -->
        <div class="space-y-6">
            
            <!-- Details Panel Card -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-8 space-y-6">
                <h3 class="serif-logo text-base font-bold text-gray-900 pb-3 border-b border-gray-100">Kategori & Harga</h3>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Kategori Furniture</label>
                    <select id="category_id" name="category_id" required class="w-full bg-gray-50 border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-4 py-3 text-xs text-gray-800 focus:outline-none">
                        <option value="" disabled>Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Harga Base (Rupiah)</label>
                    <div class="flex items-center bg-gray-50 border border-gray-200 rounded-lg px-4 py-3">
                        <span class="text-xs text-gray-400 font-bold mr-2">Rp</span>
                        <input type="number" id="price" name="price" value="{{ old('price', (int)$product->price) }}" required min="0" placeholder="1500000" class="bg-transparent border-0 w-full focus:outline-none text-xs font-bold text-gray-800 focus:ring-0 p-0">
                    </div>
                    @error('price')
                        <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label for="stock" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Stok Tersedia</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required min="0" placeholder="25" class="w-full bg-gray-50 border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-4 py-3 text-xs text-gray-800 focus:outline-none">
                    @error('stock')
                        <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Thumbnail Card -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-8 space-y-6">
                <h3 class="serif-logo text-base font-bold text-gray-900 pb-3 border-b border-gray-100">Cover & Promosi</h3>

                <!-- Active Cover Preview -->
                <div>
                    <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Cover Aktif Saat Ini</span>
                    <div class="h-40 w-full bg-gray-50 border border-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <img src="{{ $product->image_url ?? 'https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=400' }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                </div>

                <!-- Cover Image Upload -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Ubah Cover Image (Opsional)</label>
                    <input type="file" name="image" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-[10px] file:font-semibold file:bg-[#1A1A1A] file:text-white hover:file:bg-[#C5A880] cursor-pointer transition">
                    <p class="text-[9px] text-gray-400 mt-1.5">Mendukung format JPEG, PNG, JPG, WEBP. Maksimal ukuran file 2MB.</p>
                    @error('image')
                        <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Popular Tag -->
                <div class="flex items-center justify-between p-4 bg-amber-50/50 border border-amber-100 rounded-xl">
                    <div>
                        <span class="text-xs font-bold text-amber-800 flex items-center">
                            <i class="fa-solid fa-star mr-1"></i> Rekomendasi Populer
                        </span>
                        <p class="text-[9px] text-amber-600 mt-0.5">Tampilkan di halaman depan banner utama.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_popular" value="1" class="sr-only peer" {{ old('is_popular', $product->is_popular) ? 'checked' : '' }}>
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#C5A880]"></div>
                    </label>
                </div>
            </div>

            <!-- Submit Button Card -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-8 space-y-4">
                <button type="submit" class="w-full inline-flex justify-center items-center bg-[#1A1A1A] hover:bg-[#C5A880] text-white text-xs font-bold tracking-wider uppercase py-4 rounded-xl shadow-md transition duration-200">
                    Simpan Perubahan <i class="fa-solid fa-check ml-2 text-[10px]"></i>
                </button>
                <a href="{{ route('admin.products.index') }}" class="w-full inline-flex justify-center items-center border border-gray-200 hover:border-gray-400 text-gray-500 hover:text-gray-800 text-xs font-semibold py-3.5 rounded-xl transition duration-200 bg-gray-50/50">
                    Batal & Kembali
                </a>
            </div>

        </div>

    </form>

    <!-- JavaScript to handle dynamically adding and removing customizer options -->
    <script>
        function removeRow(button) {
            const row = button.closest('.flex');
            const container = row.parentNode;
            if (container.children.length > 1) {
                row.remove();
            } else {
                row.querySelectorAll('input').forEach(input => {
                    if (input.type === 'color') input.value = '#000000';
                    else if (input.type === 'number') input.value = '0';
                    else input.value = '';
                });
            }
        }

        function addColorRow() {
            const container = document.getElementById('colors-container');
            const newRow = document.createElement('div');
            newRow.className = 'flex items-center gap-3 color-row animate-fade-in';
            newRow.innerHTML = `
                <input type="text" name="colors[name][]" placeholder="Nama Warna (Contoh: Charcoal)" class="flex-grow bg-gray-50 border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-3 py-2 text-xs text-gray-800 focus:outline-none">
                <div class="flex items-center gap-2 border border-gray-200 bg-gray-50 px-3 py-1.5 rounded-lg flex-shrink-0">
                    <input type="color" name="colors[value][]" value="#000000" class="w-6 h-6 border-0 bg-transparent cursor-pointer rounded">
                    <span class="text-[10px] font-mono text-gray-400">Pilih Warna</span>
                </div>
                <input type="file" name="colors[image][]" class="w-44 text-[10px] text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-[9px] file:font-semibold file:bg-[#1A1A1A] file:text-white hover:file:bg-[#C5A880] cursor-pointer">
                <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700 px-2 py-1"><i class="fa-regular fa-trash-can"></i></button>
            `;
            container.appendChild(newRow);
        }

        function addFoamColorRow() {
            const container = document.getElementById('foam-colors-container');
            const newRow = document.createElement('div');
            newRow.className = 'flex items-center gap-3 foam-color-row animate-fade-in';
            newRow.innerHTML = `
                <input type="text" name="foam_colors[name][]" placeholder="Nama Warna Busa (Contoh: Putih Tulang)" class="flex-grow bg-gray-50 border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-3 py-2 text-xs text-gray-800 focus:outline-none">
                <div class="flex items-center gap-2 border border-gray-200 bg-gray-50 px-3 py-1.5 rounded-lg flex-shrink-0">
                    <input type="color" name="foam_colors[value][]" value="#F8F6F0" class="w-6 h-6 border-0 bg-transparent cursor-pointer rounded">
                    <span class="text-[10px] font-mono text-gray-400">Pilih Warna</span>
                </div>
                <input type="file" name="foam_colors[image][]" class="w-44 text-[10px] text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-[9px] file:font-semibold file:bg-[#1A1A1A] file:text-white hover:file:bg-[#C5A880] cursor-pointer">
                <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700 px-2 py-1"><i class="fa-regular fa-trash-can"></i></button>
            `;
            container.appendChild(newRow);
        }

        function addMaterialRow() {
            const container = document.getElementById('materials-container');
            const newRow = document.createElement('div');
            newRow.className = 'flex items-center gap-3 material-row animate-fade-in';
            newRow.innerHTML = `
                <input type="text" name="materials[name][]" placeholder="Nama Material (Contoh: Kayu Jati Premium)" class="flex-grow bg-gray-50 border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-3 py-2 text-xs text-gray-800 focus:outline-none">
                <div class="flex items-center bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 w-48 flex-shrink-0">
                    <span class="text-[10px] text-gray-400 mr-1.5 font-bold">+$</span>
                    <input type="number" name="materials[price_modifier][]" value="0" min="0" placeholder="Tambahan Harga" class="bg-transparent border-0 w-full focus:outline-none text-xs font-semibold text-gray-800 focus:ring-0 p-0">
                </div>
                <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700 px-2 py-1"><i class="fa-regular fa-trash-can"></i></button>
            `;
            container.appendChild(newRow);
        }

        function addSizeRow() {
            const container = document.getElementById('sizes-container');
            const newRow = document.createElement('div');
            newRow.className = 'flex items-center gap-3 size-row animate-fade-in';
            newRow.innerHTML = `
                <input type="text" name="sizes[name][]" placeholder="Nama Ukuran (Contoh: 3 Seater / Large)" class="flex-grow bg-gray-50 border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-3 py-2 text-xs text-gray-800 focus:outline-none">
                <div class="flex items-center bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 w-48 flex-shrink-0">
                    <span class="text-[10px] text-gray-400 mr-1.5 font-bold">+$</span>
                    <input type="number" name="sizes[price_modifier][]" value="0" min="0" placeholder="Tambahan Harga" class="bg-transparent border-0 w-full focus:outline-none text-xs font-semibold text-gray-800 focus:ring-0 p-0">
                </div>
                <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700 px-2 py-1"><i class="fa-regular fa-trash-can"></i></button>
            `;
            container.appendChild(newRow);
        }
    </script>
@endsection
