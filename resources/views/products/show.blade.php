@extends('layouts.customer')

@section('title', $product->name . ' - Furnishare')

@section('content')
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex mb-8 text-xs text-gray-500 font-light" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="hover:text-[#C5A880]">Home</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fa-solid fa-chevron-right text-[8px] mx-2"></i>
                            <a href="{{ route('products.index') }}" class="hover:text-[#C5A880]">Katalog</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fa-solid fa-chevron-right text-[8px] mx-2"></i>
                            <a href="{{ route('products.index', ['kategori' => $product->category->slug]) }}" class="hover:text-[#C5A880]">{{ $product->category->name }}</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fa-solid fa-chevron-right text-[8px] mx-2"></i>
                            <span class="text-gray-400 truncate max-w-[150px] sm:max-w-none">{{ $product->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Product Details Frame -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
                
                <!-- Left: Interactive Visual Frame (Product Image) -->
                <div>
                    @php
                        $productImages = [
                            'kursi-makan-oak-minimalis' => 'https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=800',
                            'kursi-kerja-ergonomis-eira' => 'https://images.unsplash.com/photo-1505797149-43b0069ec26b?q=80&w=800',
                            'kursi-lounge-rattan-modern' => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?q=80&w=800',
                            'meja-makan-jati-scandinavian' => 'https://images.unsplash.com/photo-1530018607912-eff2df114fbe?q=80&w=800',
                            'meja-kerja-minimalis-vardo' => 'https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?q=80&w=800',
                            'meja-kopi-bundar-terrazzo' => 'https://images.unsplash.com/photo-1565793298595-6a879b1d9492?q=80&w=800',
                            'sofa-modular-nordic-comfort' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?q=80&w=800',
                            'sofa-bed-lipat-aiko' => 'https://images.unsplash.com/photo-1540518614846-7eded433c457?q=80&w=800',
                            'lemari-pakaian-jati-klasik' => 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?q=80&w=800',
                            'rak-buku-sekat-freja' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?q=80&w=800',
                            'cermin-dinding-estetik-aura' => 'https://images.unsplash.com/photo-1618220179428-22790b461013?q=80&w=800',
                            'lampu-meja-keramik-luna' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?q=80&w=800',
                        ];
                        $imageSrc = $product->image ? asset('storage/' . $product->image) : ($productImages[$product->slug] ?? 'https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=800');
                    @endphp
                    <div class="relative bg-[#FAF8F5] rounded-2xl overflow-hidden shadow-sm border border-gray-100 p-4">
                        <img id="product-display-image" src="{{ $imageSrc }}" alt="{{ $product->name }}" class="w-full h-[500px] object-cover rounded-xl transition duration-500">
                        <div class="absolute bottom-8 right-8 bg-white/85 backdrop-blur px-4 py-2 rounded-lg shadow text-center border border-gray-100">
                            <span class="text-[10px] uppercase text-gray-500 font-bold tracking-widest block">Ketersediaan Stok</span>
                            <span class="font-bold text-sm text-gray-800">{{ $product->stock }} Pcs</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Content & Customizer Options Form -->
                <div>
                    <span class="text-xs font-bold tracking-widest text-[#C5A880] uppercase mb-2 block">
                        {{ $product->category->name }}
                    </span>
                    <h1 class="serif-title text-3xl sm:text-4xl font-bold text-gray-900 leading-tight mb-4">
                        {{ $product->name }}
                    </h1>
                    
                    <!-- Dynamic Price Tag -->
                    <div class="mb-6 flex items-center space-x-4">
                        <span id="displayed-price" class="text-2xl sm:text-3xl font-extrabold text-gray-900" data-base-price="{{ $product->price }}">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                        @if($product->is_popular)
                            <span class="bg-[#C5A880]/15 text-[#C5A880] text-[10px] font-bold tracking-widest px-3.5 py-1 rounded-full uppercase">Paling Diminati</span>
                        @endif
                    </div>

                    <p class="text-xs text-gray-500 leading-relaxed mb-8 font-light">
                        {{ $product->description }}
                    </p>

                    <!-- Customizer Form -->
                    <form action="{{ route('cart.store') }}" method="POST" class="space-y-8">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        @if(!empty($product->custom_options))
                            
                            <!-- 1. Color Selection (Dots) -->
                            @if(!empty($product->custom_options['colors']))
                                <div>
                                    <h3 class="text-xs font-bold tracking-widest uppercase text-gray-800 mb-3 flex items-center">
                                        <i class="fa-solid fa-palette text-xs text-[#C5A880] mr-2"></i> Pilihan Warna Finisihing: <span id="selected-color-name" class="ml-2 font-light text-gray-500 normal-case">{{ $product->custom_options['colors'][0]['name'] }}</span>
                                    </h3>
                                    <div class="flex items-center space-x-3">
                                        @foreach($product->custom_options['colors'] as $index => $color)
                                            @php
                                                $colorImgUrl = isset($color['image']) ? (str_starts_with($color['image'], 'http') ? $color['image'] : asset('storage/' . $color['image'])) : $imageSrc;
                                            @endphp
                                            <label class="relative cursor-pointer focus:outline-none">
                                                <input type="radio" name="color" value="{{ $color['name'] }}" data-image="{{ $colorImgUrl }}" class="sr-only peer" {{ $index === 0 ? 'checked' : '' }} onchange="updateColorName('{{ $color['name'] }}', this)">
                                                <span class="block w-9 h-9 rounded-full border border-gray-200 peer-checked:ring-2 peer-checked:ring-[#C5A880] peer-checked:ring-offset-2 transition-all duration-300 shadow-inner" style="background: {{ $color['value'] }};"></span>
                                                <!-- Selected overlay check -->
                                                <span class="absolute inset-0 flex items-center justify-center text-white text-[10px] opacity-0 peer-checked:opacity-100 transition-opacity">
                                                    <i class="fa-solid fa-check"></i>
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- 1b. Foam Color Selection (Dots) -->
                            @if(!empty($product->custom_options['foam_colors']))
                                <div>
                                    <h3 class="text-xs font-bold tracking-widest uppercase text-gray-800 mb-3 flex items-center">
                                        <i class="fa-solid fa-couch text-xs text-[#C5A880] mr-2"></i> Pilihan Warna Busa: <span id="selected-foam-color-name" class="ml-2 font-light text-gray-500 normal-case">{{ $product->custom_options['foam_colors'][0]['name'] }}</span>
                                    </h3>
                                    <div class="flex items-center space-x-3">
                                        @foreach($product->custom_options['foam_colors'] as $index => $fcolor)
                                            @php
                                                $foamImgUrl = isset($fcolor['image']) ? (str_starts_with($fcolor['image'], 'http') ? $fcolor['image'] : asset('storage/' . $fcolor['image'])) : null;
                                            @endphp
                                            <label class="relative cursor-pointer focus:outline-none">
                                                <input type="radio" name="foam_color" value="{{ $fcolor['name'] }}" {!! $foamImgUrl ? 'data-image="' . $foamImgUrl . '"' : '' !!} class="sr-only peer" {{ $index === 0 ? 'checked' : '' }} onchange="updateFoamColorName('{{ $fcolor['name'] }}', this)">
                                                <span class="block w-9 h-9 rounded-full border border-gray-200 peer-checked:ring-2 peer-checked:ring-[#C5A880] peer-checked:ring-offset-2 transition-all duration-300 shadow-inner" style="background: {{ $fcolor['value'] }};"></span>
                                                <!-- Selected overlay check -->
                                                <span class="absolute inset-0 flex items-center justify-center text-white text-[10px] opacity-0 peer-checked:opacity-100 transition-opacity">
                                                    <i class="fa-solid fa-check" style="filter: drop-shadow(0 0 2px rgba(0,0,0,0.5));"></i>
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- 2. Material Selection (Radios) -->
                            @if(!empty($product->custom_options['materials']))
                                <div>
                                    <h3 class="text-xs font-bold tracking-widest uppercase text-gray-800 mb-3 flex items-center">
                                        <i class="fa-solid fa-tree text-xs text-[#C5A880] mr-2"></i> Bahan Kayu / Kain Pelapis:
                                    </h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                        @foreach($product->custom_options['materials'] as $index => $mat)
                                            <label class="relative block border border-gray-200 rounded-xl p-4 cursor-pointer focus:outline-none hover:bg-[#FAF8F5]/50 transition duration-300">
                                                <input type="radio" name="material" value="{{ $mat['name'] }}" data-modifier="{{ $mat['price_modifier'] }}" class="sr-only peer material-radio" {{ $index === 0 ? 'checked' : '' }} onchange="calculatePrice()">
                                                <div class="peer-checked:border-[#C5A880] absolute inset-0 border border-transparent rounded-xl pointer-events-none transition duration-300 ring-2 ring-transparent peer-checked:ring-[#C5A880] peer-checked:ring-offset-1"></div>
                                                <div class="text-xs font-semibold text-gray-800">{{ $mat['name'] }}</div>
                                                <div class="text-[10px] text-gray-400 mt-1">
                                                    @if($mat['price_modifier'] > 0)
                                                        + Rp {{ number_format($mat['price_modifier'], 0, ',', '.') }}
                                                    @else
                                                        Tanpa Biaya
                                                    @endif
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- 3. Size Selection (Radios) -->
                            @if(!empty($product->custom_options['sizes']))
                                <div>
                                    <h3 class="text-xs font-bold tracking-widest uppercase text-gray-800 mb-3 flex items-center">
                                        <i class="fa-solid fa-ruler-combined text-xs text-[#C5A880] mr-2"></i> Penyesuaian Ukuran:
                                    </h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                        @foreach($product->custom_options['sizes'] as $index => $sz)
                                            <label class="relative block border border-gray-200 rounded-xl p-4 cursor-pointer focus:outline-none hover:bg-[#FAF8F5]/50 transition duration-300">
                                                <input type="radio" name="size" value="{{ $sz['name'] }}" data-modifier="{{ $sz['price_modifier'] }}" class="sr-only peer size-radio" {{ $index === 0 ? 'checked' : '' }} onchange="calculatePrice()">
                                                <div class="peer-checked:border-[#C5A880] absolute inset-0 border border-transparent rounded-xl pointer-events-none transition duration-300 ring-2 ring-transparent peer-checked:ring-[#C5A880] peer-checked:ring-offset-1"></div>
                                                <div class="text-xs font-semibold text-gray-800">{{ $sz['name'] }}</div>
                                                <div class="text-[10px] text-gray-400 mt-1">
                                                    @if($sz['price_modifier'] > 0)
                                                        + Rp {{ number_format($sz['price_modifier'], 0, ',', '.') }}
                                                    @else
                                                        Tanpa Biaya
                                                    @endif
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        @endif

                        <!-- Quantity and Add to Cart Button -->
                        <div class="pt-6 border-t border-gray-100 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 items-center">
                            <!-- Quantity input selector -->
                            <div class="flex items-center border border-gray-200 rounded-full bg-white px-2 shadow-sm flex-shrink-0">
                                <button type="button" onclick="adjustQuantity(-1)" class="w-10 h-10 rounded-full text-gray-500 hover:text-[#C5A880] hover:bg-gray-50 flex items-center justify-center transition">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                                <input type="number" id="quantity-field" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-12 border-none text-center text-sm font-semibold focus:outline-none focus:ring-0 text-gray-800">
                                <button type="button" onclick="adjustQuantity(1)" class="w-10 h-10 rounded-full text-gray-500 hover:text-[#C5A880] hover:bg-gray-50 flex items-center justify-center transition">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>

                            <!-- Cart Submit CTA -->
                            @if($product->stock > 0)
                                <button type="submit" class="flex-grow w-full sm:w-auto inline-flex justify-center items-center bg-[#1A1A1A] hover:bg-[#C5A880] text-white text-sm font-bold tracking-wider uppercase py-4 px-6 rounded-full shadow-lg hover:shadow-xl transition-all duration-300">
                                    <i class="fa-solid fa-bag-shopping mr-2 text-sm"></i> Keranjang
                                </button>
                            @else
                                <button type="button" disabled class="flex-grow w-full sm:w-auto inline-flex justify-center items-center bg-gray-200 text-gray-400 text-sm font-bold tracking-wider uppercase py-4 px-6 rounded-full cursor-not-allowed">
                                    Stok Habis
                                </button>
                            @endif

                            <!-- WhatsApp Inquiry CTA -->
                            <a href="#" id="wa-query-btn" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto inline-flex justify-center items-center border border-[#25D366] text-[#25D366] hover:bg-[#25D366] hover:text-white text-sm font-bold tracking-wider uppercase py-3.5 px-6 rounded-full shadow-sm hover:shadow transition-all duration-300">
                                <i class="fa-brands fa-whatsapp mr-2 text-lg"></i> Tanya Admin
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Related Products Showcase -->
            @if($relatedProducts->isNotEmpty())
                <div class="mt-24 border-t border-gray-100 pt-20">
                    <h2 class="serif-title text-2xl font-bold text-gray-900 mb-10 text-center">Produk Terkait Lainnya</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach($relatedProducts as $rel)
                            <div class="group bg-[#FAF8F5] rounded-2xl overflow-hidden border border-gray-50 hover:shadow-xl transition-all duration-300">
                                <div class="relative overflow-hidden h-60">
                                    <img src="{{ $rel->image ? asset('storage/' . $rel->image) : ($productImages[$rel->slug] ?? 'https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=500') }}" alt="{{ $rel->name }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-all duration-500">
                                </div>
                                <div class="p-6">
                                    <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider mb-1">{{ $rel->category->name }}</p>
                                    <h3 class="font-medium text-gray-800 text-sm group-hover:text-[#C5A880] transition line-clamp-1">
                                        <a href="{{ route('products.show', $rel->slug) }}">{{ $rel->name }}</a>
                                    </h3>
                                    <div class="flex justify-between items-center mt-4">
                                        <p class="text-sm font-bold text-gray-900">Rp {{ number_format($rel->price, 0, ',', '.') }}</p>
                                        <a href="{{ route('products.show', $rel->slug) }}" class="text-xs font-bold text-[#C5A880] hover:text-[#B4966E] transition">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>

    <!-- Custom Price Visual Script -->
    <script>
        function updateColorName(name, element) {
            document.getElementById('selected-color-name').innerText = name;
            
            const newImage = element.getAttribute('data-image');
            const displayImage = document.getElementById('product-display-image');
            if (newImage && displayImage) {
                displayImage.src = newImage;
            }
            
            updateWhatsAppLink();
        }

        function updateFoamColorName(name, element) {
            document.getElementById('selected-foam-color-name').innerText = name;
            
            const newImage = element.getAttribute('data-image');
            const displayImage = document.getElementById('product-display-image');
            if (newImage && displayImage) {
                displayImage.src = newImage;
            }
            
            updateWhatsAppLink();
        }

        function calculatePrice() {
            const priceTag = document.getElementById('displayed-price');
            const basePrice = parseFloat(priceTag.getAttribute('data-base-price'));
            
            let materialModifier = 0;
            let sizeModifier = 0;

            // 1. Check material checked radio
            const selectedMaterial = document.querySelector('.material-radio:checked');
            if (selectedMaterial) {
                materialModifier = parseFloat(selectedMaterial.getAttribute('data-modifier') || 0);
            }

            // 2. Check size checked radio
            const selectedSize = document.querySelector('.size-radio:checked');
            if (selectedSize) {
                sizeModifier = parseFloat(selectedSize.getAttribute('data-modifier') || 0);
            }

            // Total custom price
            const total = basePrice + materialModifier + sizeModifier;
            
            // Format to Indonesian Rupiah
            const formatted = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(total);

            // Replace standard IDR prefix from standard JS format
            priceTag.innerText = formatted.replace('Rp', 'Rp ');

            updateWhatsAppLink();
        }

        function adjustQuantity(amount) {
            const field = document.getElementById('quantity-field');
            let current = parseInt(field.value) || 1;
            const max = parseInt(field.getAttribute('max')) || 999;
            
            current += amount;
            if (current < 1) current = 1;
            if (current > max) current = max;

            field.value = current;
        }

        function updateWhatsAppLink() {
            const waBtn = document.getElementById('wa-query-btn');
            if (!waBtn) return;

            const productName = "{{ $product->name }}";
            
            // Get selected color
            let colorName = "";
            const selectedColorInput = document.querySelector('input[name="color"]:checked');
            if (selectedColorInput) {
                colorName = selectedColorInput.value;
            } else {
                const colorSpan = document.getElementById('selected-color-name');
                if (colorSpan) colorName = colorSpan.innerText;
            }
            
            // Get selected material
            let materialName = "-";
            const selectedMaterial = document.querySelector('.material-radio:checked');
            if (selectedMaterial) {
                materialName = selectedMaterial.value;
            }

            // Get selected size
            let sizeName = "-";
            const selectedSize = document.querySelector('.size-radio:checked');
            if (selectedSize) {
                sizeName = selectedSize.value;
            }

            // Get selected foam color
            let foamColorName = "-";
            const selectedFoamColorInput = document.querySelector('input[name="foam_color"]:checked');
            if (selectedFoamColorInput) {
                foamColorName = selectedFoamColorInput.value;
            } else {
                const foamColorSpan = document.getElementById('selected-foam-color-name');
                if (foamColorSpan) foamColorName = foamColorSpan.innerText;
            }

            const message = `Halo Furnishare, saya ingin bertanya tentang produk *${productName}* dengan spesifikasi kustom berikut:\n- Warna Kayu: ${colorName}\n- Warna Busa: ${foamColorName}\n- Material: ${materialName}\n- Ukuran: ${sizeName}\n\nApakah spesifikasi ini ready stock dan bisa diorder?`;
            
            waBtn.href = `https://wa.me/6282371362312?text=${encodeURIComponent(message)}`;
        }

        // Initialize WhatsApp link on load
        document.addEventListener('DOMContentLoaded', function() {
            updateWhatsAppLink();
        });
    </script>
@endsection
