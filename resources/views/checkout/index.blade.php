@extends('layouts.customer')

@section('title', 'Proses Checkout - Furnishare')

@section('content')
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="serif-title text-3xl font-bold text-gray-900 mb-10">Formulir Pengiriman dan Pembayaran</h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
                
                <!-- Left: Shipping Information Form (2 Columns) -->
                <div class="lg:col-span-2 bg-[#FAF8F5] p-8 rounded-2xl border border-gray-100 shadow-sm">
                    <h3 class="serif-title text-lg font-bold text-gray-800 mb-6">Informasi Pembeli dan Pengiriman</h3>
                    <div class="w-8 h-0.5 bg-[#C5A880] mb-8"></div>

                    <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="checkout-form">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Full name -->
                            <div>
                                <label for="buyer_name" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Nama Penerima</label>
                                <input type="text" id="buyer_name" name="buyer_name" value="{{ old('buyer_name', auth()->user()->name) }}" required class="w-full bg-white border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-4 py-3 text-xs text-gray-800 focus:outline-none">
                                @error('buyer_name')
                                    <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="buyer_phone" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Nomor Telepon / WhatsApp</label>
                                <input type="tel" id="buyer_phone" name="buyer_phone" value="{{ old('buyer_phone', auth()->user()->phone) }}" placeholder="08xxxxxxxxxx" required class="w-full bg-white border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-4 py-3 text-xs text-gray-800 focus:outline-none">
                                @error('buyer_phone')
                                    <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="buyer_email" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Alamat Email Konfirmasi</label>
                            <input type="email" id="buyer_email" name="buyer_email" value="{{ old('buyer_email', auth()->user()->email) }}" required class="w-full bg-white border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-4 py-3 text-xs text-gray-800 focus:outline-none">
                            @error('buyer_email')
                                <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                        </div>

                        <!-- Shipping Address -->
                        <div>
                            <label for="shipping_address" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Alamat Lengkap Pengiriman</label>
                            
                            <textarea id="shipping_address" name="shipping_address" rows="3" placeholder="Tuliskan alamat lengkap pengiriman (Jalan, RT/RW, Kecamatan, Kabupaten, Kodepos)" required class="w-full bg-white border border-gray-200 focus:border-[#C5A880] focus:ring-1 focus:ring-[#C5A880] rounded-lg px-4 py-3 text-xs text-gray-800 focus:outline-none leading-relaxed">{{ old('shipping_address', auth()->user()->address) }}</textarea>
                            @error('shipping_address')
                                <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                            
                            <input type="hidden" name="shipping_distance" value="0">
                            <input type="hidden" name="shipping_cost" value="100000">
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="space-y-4 pt-4 border-t border-gray-100">
                            <h3 class="serif-title text-xs font-bold text-gray-850 uppercase tracking-widest flex items-center">
                                <i class="fa-solid fa-credit-card text-[#C5A880] mr-2"></i> Metode Pembayaran:
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- COD -->
                                <label class="relative block border border-gray-250 rounded-xl p-4 bg-white cursor-pointer focus:outline-none hover:bg-gray-50/50 transition duration-300">
                                    <input type="radio" name="payment_method" value="cod" class="sr-only peer payment-method-radio" {{ old('payment_method', 'cod') === 'cod' ? 'checked' : '' }} onchange="togglePaymentMethod()">
                                    <div class="peer-checked:border-[#C5A880] absolute inset-0 border border-transparent rounded-xl pointer-events-none transition duration-300 ring-2 ring-transparent peer-checked:ring-[#C5A880] peer-checked:ring-offset-1"></div>
                                    <div class="flex items-center space-x-3">
                                        <div class="h-8 w-8 rounded-full bg-[#FAF8F5] flex items-center justify-center text-[#C5A880] text-sm">
                                            <i class="fa-solid fa-hand-holding-dollar"></i>
                                        </div>
                                        <div>
                                            <div class="text-xs font-semibold text-gray-850">Cash on Delivery (COD)</div>
                                            <div class="text-[9px] text-gray-400 mt-0.5">Bayar tunai di tempat saat barang sampai</div>
                                        </div>
                                    </div>
                                </label>

                                <!-- Online Payment / Midtrans -->
                                <label class="relative block border border-gray-250 rounded-xl p-4 bg-white cursor-pointer focus:outline-none hover:bg-gray-50/50 transition duration-300">
                                    <input type="radio" name="payment_method" value="midtrans" class="sr-only peer payment-method-radio" {{ old('payment_method') === 'midtrans' ? 'checked' : '' }} onchange="togglePaymentMethod()">
                                    <div class="peer-checked:border-[#C5A880] absolute inset-0 border border-transparent rounded-xl pointer-events-none transition duration-300 ring-2 ring-transparent peer-checked:ring-[#C5A880] peer-checked:ring-offset-1"></div>
                                    <div class="flex items-center space-x-3">
                                        <div class="h-8 w-8 rounded-full bg-[#FAF8F5] flex items-center justify-center text-[#C5A880] text-sm">
                                            <i class="fa-solid fa-credit-card"></i>
                                        </div>
                                        <div>
                                            <div class="text-xs font-semibold text-gray-850">Bayar Online</div>
                                            <div class="text-[9px] text-gray-400 mt-0.5">QRIS, VA Bank, e-Wallet via Midtrans</div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @error('payment_method')
                                <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pilihan Bank dihapus -->

                        <!-- Upload KTP for COD -->
                        <div id="ktp-upload-container" class="hidden p-5 bg-white rounded-xl border border-gray-150 space-y-4">
                            <h4 class="text-xs font-bold text-gray-800 flex items-center">
                                <i class="fa-solid fa-id-card text-[#C5A880] mr-2"></i> Verifikasi KTP (Wajib untuk COD)
                            </h4>
                            <p class="text-[10px] text-gray-500">
                                <i class="fa-solid fa-lock text-gray-400 mr-1"></i> Data KTP hanya digunakan untuk verifikasi keamanan transaksi COD.
                            </p>
                            
                            <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-[#C5A880] transition-colors relative" id="ktp-drop-zone">
                                <div class="space-y-2 text-center" id="ktp-upload-placeholder">
                                    <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-400"></i>
                                    <div class="flex text-xs text-gray-600 justify-center">
                                        <label for="ktp_image" class="relative cursor-pointer bg-white rounded-md font-semibold text-[#C5A880] hover:text-[#A88C66] focus-within:outline-none">
                                            <span>Upload Foto KTP</span>
                                            <input id="ktp_image" name="ktp_image" type="file" class="sr-only" accept=".jpg,.jpeg,.png" onchange="previewKTP(event)">
                                        </label>
                                    </div>
                                    <p class="text-[9px] text-gray-500">PNG, JPG, JPEG (Max 2MB)</p>
                                </div>
                                <div id="ktp-preview-container" class="hidden absolute inset-0 w-full h-full bg-white rounded-lg overflow-hidden flex items-center justify-center p-2 group">
                                    <img id="ktp-preview" class="max-h-full object-contain rounded" src="" alt="KTP Preview">
                                    <button type="button" onclick="removeKTP()" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-2 opacity-0 group-hover:opacity-100 transition shadow hover:bg-red-600">
                                        <i class="fa-solid fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            @error('ktp_image')
                                <p class="text-[10px] text-red-500 mt-1" id="ktp-error-text">{{ $message }}</p>
                            @enderror
                            <p class="text-[10px] text-red-500 mt-1 hidden" id="ktp-js-error-text"></p>
                        </div>

                        <!-- Submit CTA -->
                        <div class="pt-6">
                            <button type="submit" class="w-full inline-flex justify-center items-center bg-[#1A1A1A] hover:bg-[#C5A880] text-white text-xs font-bold tracking-wider uppercase py-4 px-6 rounded-full shadow-lg hover:shadow-xl transition-all duration-300">
                                Buat Pesanan Sekarang <i class="fa-solid fa-check ml-2"></i>
                            </button>
                        </div>

                    </form>
                </div>

                <script>
                    function togglePaymentMethod() {
                        const ktpContainer = document.getElementById('ktp-upload-container');
                        const selectedMethodInput = document.querySelector('input[name="payment_method"]:checked');
                        if (!selectedMethodInput) return;
                        
                        const selectedMethod = selectedMethodInput.value;
                        
                        if (selectedMethod === 'midtrans') {
                            ktpContainer.classList.add('hidden');
                            document.getElementById('ktp_image').required = false;
                        } else {
                            ktpContainer.classList.remove('hidden');
                            document.getElementById('ktp_image').required = true;
                        }
                    }

                    // KTP Preview Features
                    function previewKTP(event) {
                        const file = event.target.files[0];
                        const errorText = document.getElementById('ktp-js-error-text');
                        errorText.classList.add('hidden');
                        
                        if (file) {
                            // File size validation (2MB = 2 * 1024 * 1024 bytes)
                            if(file.size > 2097152) {
                                errorText.textContent = "Ukuran file kelewat besar. Maksimal 2MB.";
                                errorText.classList.remove('hidden');
                                removeKTP();
                                return;
                            }
                            
                            // Type validation
                            if(!['image/jpeg', 'image/jpg', 'image/png'].includes(file.type)) {
                                errorText.textContent = "Format file tidak didukung. Mohon upload JPG/PNG.";
                                errorText.classList.remove('hidden');
                                removeKTP();
                                return;
                            }

                            const reader = new FileReader();
                            reader.onload = function(e) {
                                document.getElementById('ktp-preview').src = e.target.result;
                                document.getElementById('ktp-preview-container').classList.remove('hidden');
                                document.getElementById('ktp-upload-placeholder').classList.add('hidden');
                            }
                            reader.readAsDataURL(file);
                        }
                    }

                    function removeKTP() {
                        document.getElementById('ktp_image').value = '';
                        document.getElementById('ktp-preview-container').classList.add('hidden');
                        document.getElementById('ktp-upload-placeholder').classList.remove('hidden');
                        document.getElementById('ktp-preview').src = '';
                    }

                    // Form Submission Interception
                    document.getElementById('checkout-form').addEventListener('submit', function(e) {
                        const method = document.querySelector('input[name="payment_method"]:checked').value;
                        if (method === 'cod') {
                            const ktpFile = document.getElementById('ktp_image').files.length;
                            if (ktpFile === 0) {
                                e.preventDefault();
                                const errorText = document.getElementById('ktp-js-error-text');
                                errorText.textContent = "KTP WAJIB diupload untuk metode pembayaran COD.";
                                errorText.classList.remove('hidden');
                                
                                // Scroll to alert
                                document.getElementById('ktp-upload-container').scrollIntoView({ behavior: 'smooth', block: 'center' });
                                
                                // Flash red border
                                const dropZone = document.getElementById('ktp-drop-zone');
                                dropZone.classList.add('border-red-500', 'bg-red-50');
                                setTimeout(() => {
                                    dropZone.classList.remove('border-red-500', 'bg-red-50');
                                }, 2000);
                            }
                        }
                    });

                    document.addEventListener('DOMContentLoaded', function() {
                        togglePaymentMethod();
                    });
                </script>

                <!-- Right: Order Summary Frame (1 Column) -->
                <div class="space-y-6">
                    <div class="bg-[#FAF8F5] p-8 rounded-2xl border border-gray-100 shadow-sm space-y-6">
                        <h3 class="serif-title text-lg font-bold text-gray-800">Ringkasan Pesanan</h3>
                        <div class="w-8 h-0.5 bg-[#C5A880]"></div>

                        <!-- Items Scroll -->
                        <div class="divide-y divide-gray-100 max-h-80 overflow-y-auto space-y-4 pr-2">
                            @foreach($cartItems as $item)
                                <div class="flex items-center space-x-4 pt-4 first:pt-0">
                                    <div class="h-12 w-12 rounded-lg bg-white border border-gray-100 overflow-hidden flex-shrink-0">
                                        <img src="https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=200" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="text-xs font-semibold text-gray-800 line-clamp-1">{{ $item->product->name }}</h4>
                                        <p class="text-[9px] text-gray-400 mt-0.5">{{ $item->quantity }} Pcs x Rp {{ number_format($item->custom_price, 0, ',', '.') }}</p>
                                    </div>
                                    <span class="text-xs font-bold text-gray-700">
                                        Rp {{ number_format($item->total_item_price, 0, ',', '.') }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <!-- Price Tally -->
                        <div class="border-t border-gray-100 pt-4 space-y-3 text-xs font-light">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Subtotal Produk</span>
                                <span class="font-semibold text-gray-800">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Biaya Pengiriman</span>
                                <span class="font-semibold text-gray-800" id="shipping_fee_display">Rp {{ number_format($shippingFee, 0, ',', '.') }}</span>
                            </div>
                            <div class="border-t border-gray-100 pt-3 flex justify-between text-sm font-bold">
                                <span class="text-gray-800">Total Tagihan</span>
                                <span class="text-gray-900" id="total_price_display">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
