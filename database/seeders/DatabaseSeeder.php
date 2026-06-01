<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users
        User::create([
            'name' => 'Admin Furnishare',
            'email' => 'admin@furnishare.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password123'),
            'is_admin' => false,
        ]);

        // 2. Seed Categories
        $categoriesData = [
            [
                'name' => 'Kursi',
                'slug' => 'kursi',
                'description' => 'Pilihan kursi makan, kursi kerja, kursi santai kayu, dan ergonomis untuk kenyamanan Anda.',
                'image' => 'category_chair.jpg'
            ],
            [
                'name' => 'Meja',
                'slug' => 'meja',
                'description' => 'Meja kerja, meja makan, dan meja kopi minimalis berbahan kayu solid berkualitas tinggi.',
                'image' => 'category_table.jpg'
            ],
            [
                'name' => 'Lemari',
                'slug' => 'lemari',
                'description' => 'Lemari pakaian, rak buku, kabinet laci, dan solusi penyimpanan barang fungsional lainnya.',
                'image' => 'category_cabinet.jpg'
            ],
            [
                'name' => 'Sofa',
                'slug' => 'sofa',
                'description' => 'Sofa premium empuk dari bahan kain katun atau kulit sintetis untuk kenyamanan maksimal ruang keluarga.',
                'image' => 'category_sofa.jpg'
            ],
            [
                'name' => 'Dekorasi',
                'slug' => 'dekorasi',
                'description' => 'Hiasan dinding, cermin estetik, vas bunga, dan berbagai aksesoris dekorasi rumah minimalis.',
                'image' => 'category_decor.jpg'
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[$cat['slug']] = Category::create($cat);
        }

        // 3. Define Standard Custom Options for Furniture
        $chairCustomOptions = [
            'colors' => [
                ['name' => 'Natural Oak', 'value' => '#D8B48F'],
                ['name' => 'Classic Walnut', 'value' => '#5C4033'],
                ['name' => 'Charcoal Black', 'value' => '#212529']
            ],
            'materials' => [
                ['name' => 'Kayu Pinus', 'price_modifier' => 0],
                ['name' => 'Kayu Mahoni Premium', 'price_modifier' => 150000],
                ['name' => 'Kayu Jati Solid', 'price_modifier' => 350000]
            ],
            'sizes' => [
                ['name' => 'Standard', 'price_modifier' => 0],
                ['name' => 'Tinggi Kustom (Bar)', 'price_modifier' => 75000]
            ]
        ];

        $tableCustomOptions = [
            'colors' => [
                ['name' => 'Light Maple', 'value' => '#F7DFCD'],
                ['name' => 'Warm Mahogany', 'value' => '#4E2C15'],
                ['name' => 'Obsidian Dark', 'value' => '#1C1C1C']
            ],
            'materials' => [
                ['name' => 'Kayu Pinus Pilihan', 'price_modifier' => 0],
                ['name' => 'Kayu Oak Merah', 'price_modifier' => 300000],
                ['name' => 'Kayu Jati Grade A', 'price_modifier' => 750000]
            ],
            'sizes' => [
                ['name' => '4 Kursi (120x80cm)', 'price_modifier' => 0],
                ['name' => '6 Kursi (160x90cm)', 'price_modifier' => 450000],
                ['name' => '8 Kursi (200x100cm)', 'price_modifier' => 950000]
            ]
        ];

        $sofaCustomOptions = [
            'colors' => [
                ['name' => 'Warm Beige', 'value' => '#E8E1D5'],
                ['name' => 'Sage Green', 'value' => '#8C9A86'],
                ['name' => 'Classic Navy', 'value' => '#2B3E50'],
                ['name' => 'Smoke Gray', 'value' => '#8E9092']
            ],
            'materials' => [
                ['name' => 'Kain Linen Berserat', 'price_modifier' => 0],
                ['name' => 'Kain Beludru Premium', 'price_modifier' => 500000],
                ['name' => 'Kulit Sintetis Premium', 'price_modifier' => 1200000]
            ],
            'sizes' => [
                ['name' => '2-Seater (Lebar 160cm)', 'price_modifier' => 0],
                ['name' => '3-Seater (Lebar 210cm)', 'price_modifier' => 800000],
                ['name' => 'L-Shape Lounge', 'price_modifier' => 2200000]
            ]
        ];

        $cabinetCustomOptions = [
            'colors' => [
                ['name' => 'Pure White', 'value' => '#FAFAFA'],
                ['name' => 'Natural Oak', 'value' => '#D8B48F'],
                ['name' => 'Elegant Teak', 'value' => '#8B5A2B']
            ],
            'materials' => [
                ['name' => 'MDF Berkualitas', 'price_modifier' => 0],
                ['name' => 'Kayu Lapis Mahoni', 'price_modifier' => 400000],
                ['name' => 'Kayu Jati Kering', 'price_modifier' => 1000000]
            ],
            'sizes' => [
                ['name' => '2 Pintu Standard', 'price_modifier' => 0],
                ['name' => '3 Pintu Ekstra Rak', 'price_modifier' => 600000]
            ]
        ];

        $decorCustomOptions = [
            'colors' => [
                ['name' => 'Gold Brass', 'value' => '#D4AF37'],
                ['name' => 'Matte Black', 'value' => '#111111'],
                ['name' => 'Silver Chrome', 'value' => '#C0C0C0']
            ],
            'materials' => [
                ['name' => 'Plastik & Kaca', 'price_modifier' => 0],
                ['name' => 'Besi Tempa & Kaca', 'price_modifier' => 100000]
            ],
            'sizes' => [
                ['name' => 'Kecil', 'price_modifier' => 0],
                ['name' => 'Sedang', 'price_modifier' => 50000],
                ['name' => 'Besar', 'price_modifier' => 120000]
            ]
        ];

        // 4. Seed Products
        $products = [
            // Category: Kursi
            [
                'category_id' => $categories['kursi']->id,
                'name' => 'Kursi Makan Oak Minimalis',
                'slug' => 'kursi-makan-oak-minimalis',
                'description' => 'Kursi makan dengan struktur kokoh dari kayu oak pilihan. Memiliki lekuk ergonomis pada sandaran punggung yang dirancang khusus untuk kenyamanan bersantap bersama keluarga. Desain modern abad pertengahan yang abadi.',
                'price' => 650000.00,
                'image' => 'chair_1.jpg',
                'stock' => 24,
                'is_popular' => true,
                'custom_options' => [
                    'colors' => [
                        ['name' => 'Asli (Sesuai Foto)', 'value' => 'linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)', 'image' => 'https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=800'],
                        ['name' => 'Natural Oak', 'value' => '#D8B48F', 'image' => 'https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=800'],
                        ['name' => 'Classic Walnut', 'value' => '#5C4033', 'image' => 'https://images.unsplash.com/photo-1503602642458-232111445657?q=80&w=800'],
                        ['name' => 'Charcoal Black', 'value' => '#212529', 'image' => 'https://images.unsplash.com/photo-1506898667547-42e22a46e125?q=80&w=800']
                    ],
                    'materials' => $chairCustomOptions['materials'],
                    'sizes' => $chairCustomOptions['sizes']
                ],
            ],
            [
                'category_id' => $categories['kursi']->id,
                'name' => 'Kursi Kerja Ergonomis Eira',
                'slug' => 'kursi-kerja-ergonomis-eira',
                'description' => 'Kursi kerja premium yang mendukung postur tubuh secara optimal selama jam kerja panjang. Menggunakan busa cetak tahan kempes, sandaran tangan yang dapat diatur, serta roda nilon halus yang tidak merusak lantai.',
                'price' => 1250000.00,
                'image' => 'chair_2.jpg',
                'stock' => 15,
                'is_popular' => false,
                'custom_options' => [
                    'colors' => [
                        ['name' => 'Asli (Sesuai Foto)', 'value' => 'linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)', 'image' => 'https://images.unsplash.com/photo-1505797149-43b0069ec26b?q=80&w=800'],
                        ['name' => 'Natural Oak', 'value' => '#D8B48F', 'image' => 'https://images.unsplash.com/photo-1505797149-43b0069ec26b?q=80&w=800'],
                        ['name' => 'Classic Walnut', 'value' => '#5C4033', 'image' => 'https://images.unsplash.com/photo-1580481072645-022f9a6dbf27?q=80&w=800'],
                        ['name' => 'Charcoal Black', 'value' => '#212529', 'image' => 'https://images.unsplash.com/photo-1685718712398-356bc4b5ebbe?q=80&w=800']
                    ],
                    'materials' => $chairCustomOptions['materials'],
                    'sizes' => $chairCustomOptions['sizes']
                ],
            ],
            [
                'category_id' => $categories['kursi']->id,
                'name' => 'Kursi Lounge Rattan Modern',
                'slug' => 'kursi-lounge-rattan-modern',
                'description' => 'Gabungan keindahan alami rotan lokal dengan estetika besi hitam modern. Cocok diletakkan di teras, sudut membaca ruang tamu, atau balkon untuk menciptakan suasana rileks nan estetik.',
                'price' => 890000.00,
                'image' => 'chair_3.jpg',
                'stock' => 10,
                'is_popular' => true,
                'custom_options' => [
                    'colors' => [
                        ['name' => 'Asli (Sesuai Foto)', 'value' => 'linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)', 'image' => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?q=80&w=800'],
                        ['name' => 'Natural Oak', 'value' => '#D8B48F', 'image' => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?q=80&w=800'],
                        ['name' => 'Classic Walnut', 'value' => '#5C4033', 'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=800'],
                        ['name' => 'Charcoal Black', 'value' => '#212529', 'image' => 'https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?q=80&w=800']
                    ],
                    'materials' => $chairCustomOptions['materials'],
                    'sizes' => $chairCustomOptions['sizes']
                ],
            ],

            // Category: Meja
            [
                'category_id' => $categories['meja']->id,
                'name' => 'Meja Makan Jati Scandinavian',
                'slug' => 'meja-makan-jati-scandinavian',
                'description' => 'Meja makan berkapasitas besar dengan sentuhan desain Skandinavia yang anggun. Terbuat dari kayu jati solid yang awet hingga puluhan tahun dengan finishing natural matte tahan gores dan air.',
                'price' => 3750000.00,
                'image' => 'table_1.jpg',
                'stock' => 6,
                'is_popular' => true,
                'custom_options' => [
                    'colors' => [
                        ['name' => 'Asli (Sesuai Foto)', 'value' => 'linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)', 'image' => 'https://images.unsplash.com/photo-1530018607912-eff2df114fbe?q=80&w=800'],
                        ['name' => 'Light Maple', 'value' => '#F7DFCD', 'image' => 'https://images.unsplash.com/photo-1530018607912-eff2df114fbe?q=80&w=800'],
                        ['name' => 'Warm Mahogany', 'value' => '#4E2C15', 'image' => 'https://images.unsplash.com/photo-1577140917170-285929fb55b7?q=80&w=800'],
                        ['name' => 'Obsidian Dark', 'value' => '#1C1C1C', 'image' => 'https://images.unsplash.com/photo-1604014237800-1c9102c219da?q=80&w=800']
                    ],
                    'materials' => $tableCustomOptions['materials'],
                    'sizes' => $tableCustomOptions['sizes']
                ],
            ],
            [
                'category_id' => $categories['meja']->id,
                'name' => 'Meja Kerja Minimalis Vardo',
                'slug' => 'meja-kerja-minimalis-vardo',
                'description' => 'Tingkatkan produktivitas kerja di rumah dengan Meja Kerja Vardo. Dilengkapi sistem manajemen kabel tersembunyi untuk menjaga kerapian meja, serta laci penyimpanan keyboard atau dokumen.',
                'price' => 1450000.00,
                'image' => 'table_2.jpg',
                'stock' => 12,
                'is_popular' => false,
                'custom_options' => [
                    'colors' => [
                        ['name' => 'Asli (Sesuai Foto)', 'value' => 'linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)', 'image' => 'https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?q=80&w=800'],
                        ['name' => 'Light Maple', 'value' => '#F7DFCD', 'image' => 'https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?q=80&w=800'],
                        ['name' => 'Warm Mahogany', 'value' => '#4E2C15', 'image' => 'https://images.unsplash.com/photo-1532372320978-9b4d6a3a854c?q=80&w=800'],
                        ['name' => 'Obsidian Dark', 'value' => '#1C1C1C', 'image' => 'https://images.unsplash.com/photo-1519219788971-8d9797e0928e?q=80&w=800']
                    ],
                    'materials' => $tableCustomOptions['materials'],
                    'sizes' => $tableCustomOptions['sizes']
                ],
            ],
            [
                'category_id' => $categories['meja']->id,
                'name' => 'Meja Kopi Bundar Terrazzo',
                'slug' => 'meja-kopi-bundar-terrazzo',
                'description' => 'Meja tamu berdiameter sedang dengan permukaan terrazzo corak modern yang artistik dan kaki kayu mahoni solid. Memberikan aksen ceria sekaligus mewah di ruang tengah Anda.',
                'price' => 950000.00,
                'image' => 'table_3.jpg',
                'stock' => 8,
                'is_popular' => true,
                'custom_options' => [
                    'colors' => [
                        ['name' => 'Asli (Sesuai Foto)', 'value' => 'linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)', 'image' => 'https://images.unsplash.com/photo-1565793298595-6a879b1d9492?q=80&w=800'],
                        ['name' => 'Light Maple', 'value' => '#F7DFCD', 'image' => 'https://images.unsplash.com/photo-1565793298595-6a879b1d9492?q=80&w=800'],
                        ['name' => 'Warm Mahogany', 'value' => '#4E2C15', 'image' => 'https://images.unsplash.com/photo-1533090161767-e6ffed986c88?q=80&w=800'],
                        ['name' => 'Obsidian Dark', 'value' => '#1C1C1C', 'image' => 'https://images.unsplash.com/photo-1595515106969-1ce29566ff1c?q=80&w=800']
                    ],
                    'materials' => $tableCustomOptions['materials'],
                    'sizes' => $tableCustomOptions['sizes']
                ],
            ],

            // Category: Sofa
            [
                'category_id' => $categories['sofa']->id,
                'name' => 'Sofa Modular Nordic Comfort',
                'slug' => 'sofa-modular-nordic-comfort',
                'description' => 'Sofa mewah bergaya Nordic dengan bantalan super empuk dan busa berdensitas tinggi berlapis bulu angsa sintetis. Struktur kokoh dari kayu solid dan kain pelapis rajut linen yang sejuk di kulit.',
                'price' => 5400000.00,
                'image' => 'sofa_1.jpg',
                'stock' => 5,
                'is_popular' => true,
                'custom_options' => [
                    'colors' => [
                        ['name' => 'Asli (Sesuai Foto)', 'value' => 'linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)', 'image' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?q=80&w=800'],
                        ['name' => 'Warm Beige', 'value' => '#E8E1D5', 'image' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?q=80&w=800'],
                        ['name' => 'Sage Green', 'value' => '#8C9A86', 'image' => 'https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?q=80&w=800'],
                        ['name' => 'Classic Navy', 'value' => '#2B3E50', 'image' => 'https://images.unsplash.com/photo-1540518614846-7eded433c457?q=80&w=800'],
                        ['name' => 'Smoke Gray', 'value' => '#8E9092', 'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=800']
                    ],
                    'materials' => $sofaCustomOptions['materials'],
                    'sizes' => $sofaCustomOptions['sizes']
                ],
            ],
            [
                'category_id' => $categories['sofa']->id,
                'name' => 'Sofa Bed Lipat Aiko',
                'slug' => 'sofa-bed-lipat-aiko',
                'description' => 'Solusi cerdas multifungsi untuk ruangan terbatas. Dapat digunakan sebagai tempat duduk nyaman di siang hari dan diubah menjadi tempat tidur berkualitas di malam hari hanya dengan satu klik sistem lipat.',
                'price' => 2800000.00,
                'image' => 'sofa_2.jpg',
                'stock' => 10,
                'is_popular' => false,
                'custom_options' => [
                    'colors' => [
                        ['name' => 'Asli (Sesuai Foto)', 'value' => 'linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)', 'image' => 'https://images.unsplash.com/photo-1540518614846-7eded433c457?q=80&w=800'],
                        ['name' => 'Warm Beige', 'value' => '#E8E1D5', 'image' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?q=80&w=800'],
                        ['name' => 'Sage Green', 'value' => '#8C9A86', 'image' => 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?q=80&w=800'],
                        ['name' => 'Classic Navy', 'value' => '#2B3E50', 'image' => 'https://images.unsplash.com/photo-1540518614846-7eded433c457?q=80&w=800'],
                        ['name' => 'Smoke Gray', 'value' => '#8E9092', 'image' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?q=80&w=800']
                    ],
                    'materials' => $sofaCustomOptions['materials'],
                    'sizes' => $sofaCustomOptions['sizes']
                ],
            ],

            // Category: Lemari
            [
                'category_id' => $categories['lemari']->id,
                'name' => 'Lemari Pakaian Jati Klasik',
                'slug' => 'lemari-pakaian-jati-klasik',
                'description' => 'Lemari pakaian 2 pintu geser dengan penyimpanan gantung luas, laci internal, dan cermin full-body. Konstruksi kuat dari kayu jati dengan pengerjaan detail ukiran rapi khas pengrajin Jepara.',
                'price' => 4500000.00,
                'image' => 'cabinet_1.jpg',
                'stock' => 4,
                'is_popular' => false,
                'custom_options' => [
                    'colors' => [
                        ['name' => 'Asli (Sesuai Foto)', 'value' => 'linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)', 'image' => 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?q=80&w=800'],
                        ['name' => 'Pure White', 'value' => '#FAFAFA', 'image' => 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?q=80&w=800'],
                        ['name' => 'Natural Oak', 'value' => '#D8B48F', 'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?q=80&w=800'],
                        ['name' => 'Elegant Teak', 'value' => '#8B5A2B', 'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=800']
                    ],
                    'materials' => $cabinetCustomOptions['materials'],
                    'sizes' => $cabinetCustomOptions['sizes']
                ],
            ],
            [
                'category_id' => $categories['lemari']->id,
                'name' => 'Rak Buku Sekat Freja',
                'slug' => 'rak-buku-sekat-freja',
                'description' => 'Rak buku sekaligus penyekat ruangan minimalis dua sisi. Sangat fungsional untuk menaruh koleksi buku, tanaman hias kecil, pajangan foto, atau mainan dekoratif.',
                'price' => 1800000.00,
                'image' => 'cabinet_2.jpg',
                'stock' => 9,
                'is_popular' => true,
                'custom_options' => [
                    'colors' => [
                        ['name' => 'Asli (Sesuai Foto)', 'value' => 'linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)', 'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?q=80&w=800'],
                        ['name' => 'Pure White', 'value' => '#FAFAFA', 'image' => 'https://images.unsplash.com/photo-1594620302200-9a7b2241a111?q=80&w=800'],
                        ['name' => 'Natural Oak', 'value' => '#D8B48F', 'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?q=80&w=800'],
                        ['name' => 'Elegant Teak', 'value' => '#8B5A2B', 'image' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=800']
                    ],
                    'materials' => $cabinetCustomOptions['materials'],
                    'sizes' => $cabinetCustomOptions['sizes']
                ],
            ],

            // Category: Dekorasi
            [
                'category_id' => $categories['dekorasi']->id,
                'name' => 'Cermin Dinding Estetik Aura',
                'slug' => 'cermin-dinding-estetik-aura',
                'description' => 'Cermin gantung berbentuk asimetris berbingkai kayu jati tipis. Memberikan ilusi ruangan lebih luas sekaligus mempercantik area foyer masuk rumah atau meja rias Anda.',
                'price' => 450000.00,
                'image' => 'decor_1.jpg',
                'stock' => 20,
                'is_popular' => true,
                'custom_options' => [
                    'colors' => [
                        ['name' => 'Asli (Sesuai Foto)', 'value' => 'linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)', 'image' => 'https://images.unsplash.com/photo-1618220179428-22790b461013?q=80&w=800'],
                        ['name' => 'Gold Brass', 'value' => '#D4AF37', 'image' => 'https://images.unsplash.com/photo-1618220179428-22790b461013?q=80&w=800'],
                        ['name' => 'Matte Black', 'value' => '#111111', 'image' => 'https://images.unsplash.com/photo-1617806118233-18e1db207f62?q=80&w=800'],
                        ['name' => 'Silver Chrome', 'value' => '#C0C0C0', 'image' => 'https://images.unsplash.com/photo-1618220179428-22790b461013?q=80&w=800']
                    ],
                    'materials' => $decorCustomOptions['materials'],
                    'sizes' => $decorCustomOptions['sizes']
                ],
            ],
            [
                'category_id' => $categories['dekorasi']->id,
                'name' => 'Lampu Meja Keramik Luna',
                'slug' => 'lampu-meja-keramik-luna',
                'description' => 'Lampu meja tidur dengan dudukan keramik bertekstur kasar natural dan tudung kain linen krem hangat. Memberikan pencahayaan temaram tempaan yang rileks di kamar tidur.',
                'price' => 350000.00,
                'image' => 'decor_2.jpg',
                'stock' => 18,
                'is_popular' => false,
                'custom_options' => [
                    'colors' => [
                        ['name' => 'Asli (Sesuai Foto)', 'value' => 'linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)', 'image' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?q=80&w=800'],
                        ['name' => 'Gold Brass', 'value' => '#D4AF37', 'image' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?q=80&w=800'],
                        ['name' => 'Matte Black', 'value' => '#111111', 'image' => 'https://images.unsplash.com/photo-1513506003901-1e6a229e2d15?q=80&w=800'],
                        ['name' => 'Silver Chrome', 'value' => '#C0C0C0', 'image' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?q=80&w=800']
                    ],
                    'materials' => $decorCustomOptions['materials'],
                    'sizes' => $decorCustomOptions['sizes']
                ],
            ],
        ];

        foreach ($products as $prod) {
            Product::create($prod);
        }
    }
}
