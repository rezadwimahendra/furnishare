-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2026 at 08:20 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `furnishare`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `customizations` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Kursi', 'kursi', 'Pilihan kursi makan, kursi kerja, kursi santai kayu, dan ergonomis untuk kenyamanan Anda.', 'category_chair.jpg', '2026-05-22 07:07:17', '2026-05-22 07:07:17'),
(2, 'Meja', 'meja', 'Meja kerja, meja makan, dan meja kopi minimalis berbahan kayu solid berkualitas tinggi.', 'category_table.jpg', '2026-05-22 07:07:17', '2026-05-22 07:07:17'),
(3, 'Lemari', 'lemari', 'Lemari pakaian, rak buku, kabinet laci, dan solusi penyimpanan barang fungsional lainnya.', 'category_cabinet.jpg', '2026-05-22 07:07:17', '2026-05-22 07:07:17'),
(4, 'Sofa', 'sofa', 'Sofa premium empuk dari bahan kain katun atau kulit sintetis untuk kenyamanan maksimal ruang keluarga.', 'category_sofa.jpg', '2026-05-22 07:07:17', '2026-05-22 07:07:17'),
(5, 'Dekorasi', 'dekorasi', 'Hiasan dinding, cermin estetik, vas bunga, dan berbagai aksesoris dekorasi rumah minimalis.', 'category_decor.jpg', '2026-05-22 07:07:17', '2026-05-22 07:07:17'),
(6, 'kursi murah', 'kursi-murah', 'kualitas jelek', 'categories/6ypFtOdQP3e5xZrP874uiIzdOFw6Kw7H24oVOEfs.png', '2026-05-25 05:20:08', '2026-05-25 05:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_20_000001_create_categories_table', 1),
(5, '2026_05_20_000002_create_products_table', 1),
(6, '2026_05_20_000003_create_carts_table', 1),
(7, '2026_05_20_000004_create_orders_table', 1),
(8, '2026_05_20_000005_create_order_details_table', 1),
(9, '2026_05_22_144448_add_ktp_and_shipping_to_orders_table', 2),
(10, '2026_05_22_150641_add_phone_address_to_users_table', 3),
(11, '2026_05_25_110000_add_snap_token_to_orders_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `order_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` decimal(12,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cod',
  `payment_bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ktp_image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_distance` decimal(8,2) DEFAULT NULL,
  `shipping_cost` decimal(12,2) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_code`, `buyer_name`, `buyer_email`, `buyer_phone`, `shipping_address`, `total_price`, `payment_method`, `payment_bank`, `ktp_image_path`, `shipping_distance`, `shipping_cost`, `status`, `snap_token`, `created_at`, `updated_at`) VALUES
(1, 2, 'FRN-20260522-DHVLTJ', 'Budi Santoso', 'budi@gmail.com', '081234567890', 'Jl. Merdeka No. 10, Jakarta', '700000.00', 'bank_transfer', 'bca', NULL, NULL, NULL, 'pending', NULL, '2026-05-22 07:08:03', '2026-05-22 07:08:03'),
(2, 2, 'FRN-20260522-IG5JEU', 'Budi Santoso', 'budi@gmail.com', '081234567890', 'Jl. Merdeka No. 10, Jakarta', '700000.00', 'bank_transfer', 'bca', NULL, NULL, NULL, 'pending', NULL, '2026-05-22 07:08:14', '2026-05-22 07:08:14'),
(3, 2, 'FRN-20260522-CV3Y56', 'Budi Santoso', 'budi@gmail.com', '081234567890', 'Jl. Merdeka No. 10, Jakarta', '700000.00', 'cod', NULL, NULL, NULL, NULL, 'pending', NULL, '2026-05-22 07:08:14', '2026-05-22 07:08:14'),
(4, 2, 'FRN-20260522-XPRUGY', 'Budi Santoso', 'budi@gmail.com', '0823646543', 'guyangan', '3800000.00', 'bank_transfer', 'bca', NULL, NULL, NULL, 'pending', NULL, '2026-05-22 07:10:08', '2026-05-22 07:10:08'),
(5, 2, 'FRN-20260522-OFJYKW', 'Budi Santoso', 'budi@gmail.com', '0825464654', 'ada', '700000.00', 'bank_transfer', 'bni', NULL, NULL, NULL, 'processing', NULL, '2026-05-22 07:12:47', '2026-05-22 07:15:31'),
(6, 3, 'FRN-20260522-VF1AUV', 'na', 'noval@gmail.com', '0855575555', 'guyangan', '1400000.00', 'cod', NULL, 'ktp_images/dzFDCpMDwOHpMb6GAayG4gkWFu37CUSl1rtvKoh1.jpg', '0.00', '100000.00', 'completed', NULL, '2026-05-22 08:43:21', '2026-05-22 08:44:53'),
(7, 2, 'FRN-20260525-FBYUBG', 'Budi Santoso', 'budi@gmail.com', '08464913494', 'bangsri', '750000.00', 'midtrans', NULL, NULL, '0.00', '100000.00', 'pending', NULL, '2026-05-25 04:43:43', '2026-05-25 04:43:43'),
(8, 2, 'FRN-20260525-FRFKTR', 'Budi Santoso', 'budi@gmail.com', '08464913494', 'guyangan', '750000.00', 'midtrans', NULL, NULL, '0.00', '100000.00', 'pending', NULL, '2026-05-25 04:44:01', '2026-05-25 04:44:01'),
(9, 2, 'FRN-20260525-NCM5QI', 'Budi Santoso', 'budi@gmail.com', '08464913494', 'guyangan', '750000.00', 'midtrans', NULL, NULL, '0.00', '100000.00', 'pending', NULL, '2026-05-25 04:44:18', '2026-05-25 04:44:18'),
(10, 2, 'FRN-20260525-NQYF8Q', 'Budi Santoso', 'budi@gmail.com', '08464913494', 'hwhe', '750000.00', 'midtrans', NULL, NULL, '0.00', '100000.00', 'pending', NULL, '2026-05-25 04:44:37', '2026-05-25 04:44:37'),
(11, 2, 'FRN-20260525-L4OCBU', 'Budi Santoso', 'budi@gmail.com', '08464913494', 'bangsri', '750000.00', 'midtrans', NULL, NULL, '0.00', '100000.00', 'pending', '5316eac9-dd4f-4d15-adf1-48b2fdb3332b', '2026-05-25 04:47:52', '2026-05-25 04:47:53'),
(12, 2, 'FRN-20260525-FO3Y6A', 'Budi Santoso', 'budi@gmail.com', '08464913494', 'guyangan', '1775000.00', 'midtrans', NULL, NULL, '0.00', '100000.00', 'pending', 'ef2192f4-eab6-42f3-90c1-10ae7a647abd', '2026-05-25 04:59:08', '2026-05-25 04:59:09'),
(13, 2, 'FRN-20260525-POGHRN', 'Budi Santoso', 'budi@gmail.com', '08464913494', 'guyangan', '750000.00', 'midtrans', NULL, NULL, '0.00', '100000.00', 'pending', '474c5598-c785-4897-9138-725df056daa1', '2026-05-25 05:17:53', '2026-05-25 05:17:54'),
(14, 2, 'FRN-20260525-X8VO0I', 'Budi Santoso', 'budi@gmail.com', '08464913494', 'Guyangan', '100020.00', 'midtrans', NULL, NULL, '0.00', '100000.00', 'pending', '1f5a4bf3-6d07-4ce1-8b11-0aa390e67e02', '2026-05-25 05:21:57', '2026-05-25 05:21:57'),
(15, 2, 'FRN-20260529-IUVZUV', 'Budi Santoso', 'budi@gmail.com', '0856546465', 'guyangan', '990000.00', 'midtrans', NULL, NULL, '0.00', '100000.00', 'pending', 'f65f0616-fffb-4fb9-81d0-187efe15558b', '2026-05-28 19:36:14', '2026-05-28 19:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `customizations` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `price`, `quantity`, `customizations`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Kursi Makan Oak Minimalis', '650000.00', 1, '{\"color\": {\"name\": \"Natural Oak\", \"value\": \"#D8B48F\"}, \"total_modifier\": 0}', '2026-05-22 07:08:03', '2026-05-22 07:08:03'),
(2, 2, 1, 'Kursi Makan Oak Minimalis', '650000.00', 1, '{\"color\": {\"name\": \"Natural Oak\", \"value\": \"#D8B48F\"}, \"total_modifier\": 0}', '2026-05-22 07:08:14', '2026-05-22 07:08:14'),
(3, 3, 1, 'Kursi Makan Oak Minimalis', '650000.00', 1, '{\"color\": {\"name\": \"Natural Oak\", \"value\": \"#D8B48F\"}, \"total_modifier\": 0}', '2026-05-22 07:08:14', '2026-05-22 07:08:14'),
(4, 4, 4, 'Meja Makan Jati Scandinavian', '3750000.00', 1, '{\"size\": \"4 Kursi (120x80cm)\", \"color\": \"Asli (Sesuai Foto)\", \"material\": \"Kayu Pinus Pilihan\", \"total_modifier\": 0, \"size_price_modifier\": 0, \"material_price_modifier\": 0}', '2026-05-22 07:10:08', '2026-05-22 07:10:08'),
(5, 5, 1, 'Kursi Makan Oak Minimalis', '650000.00', 1, '{\"size\": \"Standard\", \"color\": \"Asli (Sesuai Foto)\", \"material\": \"Kayu Pinus\", \"total_modifier\": 0, \"size_price_modifier\": 0, \"material_price_modifier\": 0}', '2026-05-22 07:12:47', '2026-05-22 07:12:47'),
(6, 6, 1, 'Kursi Makan Oak Minimalis', '650000.00', 2, '{\"size\": \"Standard\", \"color\": \"Natural Oak\", \"material\": \"Kayu Pinus\", \"total_modifier\": 0, \"size_price_modifier\": 0, \"material_price_modifier\": 0}', '2026-05-22 08:43:21', '2026-05-22 08:43:21'),
(7, 7, 1, 'Kursi Makan Oak Minimalis', '650000.00', 1, '{\"size\": \"Standard\", \"color\": \"Asli (Sesuai Foto)\", \"material\": \"Kayu Pinus\", \"total_modifier\": 0, \"size_price_modifier\": 0, \"material_price_modifier\": 0}', '2026-05-25 04:43:43', '2026-05-25 04:43:43'),
(8, 8, 1, 'Kursi Makan Oak Minimalis', '650000.00', 1, '{\"size\": \"Standard\", \"color\": \"Asli (Sesuai Foto)\", \"material\": \"Kayu Pinus\", \"total_modifier\": 0, \"size_price_modifier\": 0, \"material_price_modifier\": 0}', '2026-05-25 04:44:01', '2026-05-25 04:44:01'),
(9, 9, 1, 'Kursi Makan Oak Minimalis', '650000.00', 1, '{\"size\": \"Standard\", \"color\": \"Asli (Sesuai Foto)\", \"material\": \"Kayu Pinus\", \"total_modifier\": 0, \"size_price_modifier\": 0, \"material_price_modifier\": 0}', '2026-05-25 04:44:18', '2026-05-25 04:44:18'),
(10, 10, 1, 'Kursi Makan Oak Minimalis', '650000.00', 1, '{\"size\": \"Standard\", \"color\": \"Asli (Sesuai Foto)\", \"material\": \"Kayu Pinus\", \"total_modifier\": 0, \"size_price_modifier\": 0, \"material_price_modifier\": 0}', '2026-05-25 04:44:37', '2026-05-25 04:44:37'),
(11, 11, 1, 'Kursi Makan Oak Minimalis', '650000.00', 1, '{\"size\": \"Standard\", \"color\": \"Asli (Sesuai Foto)\", \"material\": \"Kayu Pinus\", \"total_modifier\": 0, \"size_price_modifier\": 0, \"material_price_modifier\": 0}', '2026-05-25 04:47:52', '2026-05-25 04:47:52'),
(12, 12, 2, 'Kursi Kerja Ergonomis Eira', '1675000.00', 1, '{\"size\": \"Tinggi Kustom (Bar)\", \"color\": \"Classic Walnut\", \"material\": \"Kayu Jati Solid\", \"total_modifier\": 425000, \"size_price_modifier\": 75000, \"material_price_modifier\": 350000}', '2026-05-25 04:59:08', '2026-05-25 04:59:08'),
(13, 13, 1, 'Kursi Makan Oak Minimalis', '650000.00', 1, '{\"size\": \"Standard\", \"color\": \"Asli (Sesuai Foto)\", \"material\": \"Kayu Pinus\", \"foam_color\": \"Putih Tulang\", \"total_modifier\": 0, \"size_price_modifier\": 0, \"material_price_modifier\": 0}', '2026-05-25 05:17:53', '2026-05-25 05:17:53'),
(14, 14, 13, 'kursi jelek', '20.00', 1, '{\"size\": null, \"color\": null, \"material\": null, \"foam_color\": null, \"total_modifier\": 0, \"size_price_modifier\": 0, \"material_price_modifier\": 0}', '2026-05-25 05:21:57', '2026-05-25 05:21:57'),
(15, 15, 3, 'Kursi Lounge Rattan Modern', '890000.00', 1, '{\"size\": \"Standard\", \"color\": \"Asli (Sesuai Foto)\", \"material\": \"Kayu Pinus\", \"foam_color\": \"Putih Tulang\", \"total_modifier\": 0, \"size_price_modifier\": 0, \"material_price_modifier\": 0}', '2026-05-28 19:36:14', '2026-05-28 19:36:14');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `is_popular` tinyint(1) NOT NULL DEFAULT '0',
  `custom_options` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `price`, `image`, `stock`, `is_popular`, `custom_options`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kursi Makan Oak Minimalis', 'kursi-makan-oak-minimalis', 'Kursi makan dengan struktur kokoh dari kayu oak pilihan. Memiliki lekuk ergonomis pada sandaran punggung yang dirancang khusus untuk kenyamanan bersantap bersama keluarga. Desain modern abad pertengahan yang abadi.', '650000.00', 'chair_1.jpg', 12, 1, '{\"sizes\": [{\"name\": \"Standard\", \"price_modifier\": 0}, {\"name\": \"Tinggi Kustom (Bar)\", \"price_modifier\": 75000}], \"colors\": [{\"name\": \"Asli (Sesuai Foto)\", \"image\": \"https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=800\", \"value\": \"linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)\"}, {\"name\": \"Natural Oak\", \"image\": \"https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=800\", \"value\": \"#D8B48F\"}, {\"name\": \"Classic Walnut\", \"image\": \"https://images.unsplash.com/photo-1503602642458-232111445657?q=80&w=800\", \"value\": \"#5C4033\"}, {\"name\": \"Charcoal Black\", \"image\": \"https://images.unsplash.com/photo-1506898667547-42e22a46e125?q=80&w=800\", \"value\": \"#212529\"}], \"materials\": [{\"name\": \"Kayu Pinus\", \"price_modifier\": 0}, {\"name\": \"Kayu Mahoni Premium\", \"price_modifier\": 150000}, {\"name\": \"Kayu Jati Solid\", \"price_modifier\": 350000}], \"foam_colors\": [{\"name\": \"Putih Tulang\", \"value\": \"#F8F6F0\"}, {\"name\": \"Hitam Karbon\", \"value\": \"#1A1A1A\"}, {\"name\": \"Kelabu Asap\", \"value\": \"#8E9092\"}]}', '2026-05-22 07:07:17', '2026-05-25 05:17:53'),
(2, 1, 'Kursi Kerja Ergonomis Eira', 'kursi-kerja-ergonomis-eira', 'Kursi kerja premium yang mendukung postur tubuh secara optimal selama jam kerja panjang. Menggunakan busa cetak tahan kempes, sandaran tangan yang dapat diatur, serta roda nilon halus yang tidak merusak lantai.', '1250000.00', 'chair_2.jpg', 14, 0, '{\"sizes\": [{\"name\": \"Standard\", \"price_modifier\": 0}, {\"name\": \"Tinggi Kustom (Bar)\", \"price_modifier\": 75000}], \"colors\": [{\"name\": \"Asli (Sesuai Foto)\", \"image\": \"https://images.unsplash.com/photo-1505797149-43b0069ec26b?q=80&w=800\", \"value\": \"linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)\"}, {\"name\": \"Natural Oak\", \"image\": \"https://images.unsplash.com/photo-1505797149-43b0069ec26b?q=80&w=800\", \"value\": \"#D8B48F\"}, {\"name\": \"Classic Walnut\", \"image\": \"https://images.unsplash.com/photo-1580481072645-022f9a6dbf27?q=80&w=800\", \"value\": \"#5C4033\"}, {\"name\": \"Charcoal Black\", \"image\": \"https://images.unsplash.com/photo-1685718712398-356bc4b5ebbe?q=80&w=800\", \"value\": \"#212529\"}], \"materials\": [{\"name\": \"Kayu Pinus\", \"price_modifier\": 0}, {\"name\": \"Kayu Mahoni Premium\", \"price_modifier\": 150000}, {\"name\": \"Kayu Jati Solid\", \"price_modifier\": 350000}], \"foam_colors\": [{\"name\": \"Putih Tulang\", \"value\": \"#F8F6F0\"}, {\"name\": \"Hitam Karbon\", \"value\": \"#1A1A1A\"}, {\"name\": \"Kelabu Asap\", \"value\": \"#8E9092\"}]}', '2026-05-22 07:07:17', '2026-05-25 05:08:10'),
(3, 1, 'Kursi Lounge Rattan Modern', 'kursi-lounge-rattan-modern', 'Gabungan keindahan alami rotan lokal dengan estetika besi hitam modern. Cocok diletakkan di teras, sudut membaca ruang tamu, atau balkon untuk menciptakan suasana rileks nan estetik.', '890000.00', 'chair_3.jpg', 9, 1, '{\"sizes\": [{\"name\": \"Standard\", \"price_modifier\": 0}, {\"name\": \"Tinggi Kustom (Bar)\", \"price_modifier\": 75000}], \"colors\": [{\"name\": \"Asli (Sesuai Foto)\", \"image\": \"https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?q=80&w=800\", \"value\": \"linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)\"}, {\"name\": \"Natural Oak\", \"image\": \"https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?q=80&w=800\", \"value\": \"#D8B48F\"}, {\"name\": \"Classic Walnut\", \"image\": \"https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=800\", \"value\": \"#5C4033\"}, {\"name\": \"Charcoal Black\", \"image\": \"https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?q=80&w=800\", \"value\": \"#212529\"}], \"materials\": [{\"name\": \"Kayu Pinus\", \"price_modifier\": 0}, {\"name\": \"Kayu Mahoni Premium\", \"price_modifier\": 150000}, {\"name\": \"Kayu Jati Solid\", \"price_modifier\": 350000}], \"foam_colors\": [{\"name\": \"Putih Tulang\", \"value\": \"#F8F6F0\"}, {\"name\": \"Hitam Karbon\", \"value\": \"#1A1A1A\"}, {\"name\": \"Kelabu Asap\", \"value\": \"#8E9092\"}]}', '2026-05-22 07:07:17', '2026-05-28 19:36:14'),
(4, 2, 'Meja Makan Jati Scandinavian', 'meja-makan-jati-scandinavian', 'Meja makan berkapasitas besar dengan sentuhan desain Skandinavia yang anggun. Terbuat dari kayu jati solid yang awet hingga puluhan tahun dengan finishing natural matte tahan gores dan air.', '3750000.00', 'table_1.jpg', 5, 1, '{\"sizes\": [{\"name\": \"4 Kursi (120x80cm)\", \"price_modifier\": 0}, {\"name\": \"6 Kursi (160x90cm)\", \"price_modifier\": 450000}, {\"name\": \"8 Kursi (200x100cm)\", \"price_modifier\": 950000}], \"colors\": [{\"name\": \"Asli (Sesuai Foto)\", \"image\": \"https://images.unsplash.com/photo-1530018607912-eff2df114fbe?q=80&w=800\", \"value\": \"linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)\"}, {\"name\": \"Light Maple\", \"image\": \"https://images.unsplash.com/photo-1530018607912-eff2df114fbe?q=80&w=800\", \"value\": \"#F7DFCD\"}, {\"name\": \"Warm Mahogany\", \"image\": \"https://images.unsplash.com/photo-1577140917170-285929fb55b7?q=80&w=800\", \"value\": \"#4E2C15\"}, {\"name\": \"Obsidian Dark\", \"image\": \"https://images.unsplash.com/photo-1604014237800-1c9102c219da?q=80&w=800\", \"value\": \"#1C1C1C\"}], \"materials\": [{\"name\": \"Kayu Pinus Pilihan\", \"price_modifier\": 0}, {\"name\": \"Kayu Oak Merah\", \"price_modifier\": 300000}, {\"name\": \"Kayu Jati Grade A\", \"price_modifier\": 750000}]}', '2026-05-22 07:07:17', '2026-05-22 07:10:08'),
(5, 2, 'Meja Kerja Minimalis Vardo', 'meja-kerja-minimalis-vardo', 'Tingkatkan produktivitas kerja di rumah dengan Meja Kerja Vardo. Dilengkapi sistem manajemen kabel tersembunyi untuk menjaga kerapian meja, serta laci penyimpanan keyboard atau dokumen.', '1450000.00', 'table_2.jpg', 12, 0, '{\"sizes\": [{\"name\": \"4 Kursi (120x80cm)\", \"price_modifier\": 0}, {\"name\": \"6 Kursi (160x90cm)\", \"price_modifier\": 450000}, {\"name\": \"8 Kursi (200x100cm)\", \"price_modifier\": 950000}], \"colors\": [{\"name\": \"Asli (Sesuai Foto)\", \"image\": \"https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?q=80&w=800\", \"value\": \"linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)\"}, {\"name\": \"Light Maple\", \"image\": \"https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?q=80&w=800\", \"value\": \"#F7DFCD\"}, {\"name\": \"Warm Mahogany\", \"image\": \"https://images.unsplash.com/photo-1532372320978-9b4d6a3a854c?q=80&w=800\", \"value\": \"#4E2C15\"}, {\"name\": \"Obsidian Dark\", \"image\": \"https://images.unsplash.com/photo-1519219788971-8d9797e0928e?q=80&w=800\", \"value\": \"#1C1C1C\"}], \"materials\": [{\"name\": \"Kayu Pinus Pilihan\", \"price_modifier\": 0}, {\"name\": \"Kayu Oak Merah\", \"price_modifier\": 300000}, {\"name\": \"Kayu Jati Grade A\", \"price_modifier\": 750000}]}', '2026-05-22 07:07:17', '2026-05-22 07:07:17'),
(6, 2, 'Meja Kopi Bundar Terrazzo', 'meja-kopi-bundar-terrazzo', 'Meja tamu berdiameter sedang dengan permukaan terrazzo corak modern yang artistik dan kaki kayu mahoni solid. Memberikan aksen ceria sekaligus mewah di ruang tengah Anda.', '950000.00', 'table_3.jpg', 8, 1, '{\"sizes\": [{\"name\": \"4 Kursi (120x80cm)\", \"price_modifier\": 0}, {\"name\": \"6 Kursi (160x90cm)\", \"price_modifier\": 450000}, {\"name\": \"8 Kursi (200x100cm)\", \"price_modifier\": 950000}], \"colors\": [{\"name\": \"Asli (Sesuai Foto)\", \"image\": \"https://images.unsplash.com/photo-1565793298595-6a879b1d9492?q=80&w=800\", \"value\": \"linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)\"}, {\"name\": \"Light Maple\", \"image\": \"https://images.unsplash.com/photo-1565793298595-6a879b1d9492?q=80&w=800\", \"value\": \"#F7DFCD\"}, {\"name\": \"Warm Mahogany\", \"image\": \"https://images.unsplash.com/photo-1533090161767-e6ffed986c88?q=80&w=800\", \"value\": \"#4E2C15\"}, {\"name\": \"Obsidian Dark\", \"image\": \"https://images.unsplash.com/photo-1595515106969-1ce29566ff1c?q=80&w=800\", \"value\": \"#1C1C1C\"}], \"materials\": [{\"name\": \"Kayu Pinus Pilihan\", \"price_modifier\": 0}, {\"name\": \"Kayu Oak Merah\", \"price_modifier\": 300000}, {\"name\": \"Kayu Jati Grade A\", \"price_modifier\": 750000}]}', '2026-05-22 07:07:17', '2026-05-22 07:07:17'),
(7, 4, 'Sofa Modular Nordic Comfort', 'sofa-modular-nordic-comfort', 'Sofa mewah bergaya Nordic dengan bantalan super empuk dan busa berdensitas tinggi berlapis bulu angsa sintetis. Struktur kokoh dari kayu solid dan kain pelapis rajut linen yang sejuk di kulit.', '5400000.00', 'sofa_1.jpg', 5, 1, '{\"sizes\": [{\"name\": \"2-Seater (Lebar 160cm)\", \"price_modifier\": 0}, {\"name\": \"3-Seater (Lebar 210cm)\", \"price_modifier\": 800000}, {\"name\": \"L-Shape Lounge\", \"price_modifier\": 2200000}], \"colors\": [{\"name\": \"Asli (Sesuai Foto)\", \"image\": \"https://images.unsplash.com/photo-1555041469-a586c61ea9bc?q=80&w=800\", \"value\": \"linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)\"}, {\"name\": \"Warm Beige\", \"image\": \"https://images.unsplash.com/photo-1555041469-a586c61ea9bc?q=80&w=800\", \"value\": \"#E8E1D5\"}, {\"name\": \"Sage Green\", \"image\": \"https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?q=80&w=800\", \"value\": \"#8C9A86\"}, {\"name\": \"Classic Navy\", \"image\": \"https://images.unsplash.com/photo-1540518614846-7eded433c457?q=80&w=800\", \"value\": \"#2B3E50\"}, {\"name\": \"Smoke Gray\", \"image\": \"https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=800\", \"value\": \"#8E9092\"}], \"materials\": [{\"name\": \"Kain Linen Berserat\", \"price_modifier\": 0}, {\"name\": \"Kain Beludru Premium\", \"price_modifier\": 500000}, {\"name\": \"Kulit Sintetis Premium\", \"price_modifier\": 1200000}], \"foam_colors\": [{\"name\": \"Putih Tulang\", \"value\": \"#F8F6F0\"}, {\"name\": \"Hitam Karbon\", \"value\": \"#1A1A1A\"}, {\"name\": \"Kelabu Asap\", \"value\": \"#8E9092\"}]}', '2026-05-22 07:07:17', '2026-05-25 05:08:10'),
(8, 4, 'Sofa Bed Lipat Aiko', 'sofa-bed-lipat-aiko', 'Solusi cerdas multifungsi untuk ruangan terbatas. Dapat digunakan sebagai tempat duduk nyaman di siang hari dan diubah menjadi tempat tidur berkualitas di malam hari hanya dengan satu klik sistem lipat.', '2800000.00', 'sofa_2.jpg', 10, 0, '{\"sizes\": [{\"name\": \"2-Seater (Lebar 160cm)\", \"price_modifier\": 0}, {\"name\": \"3-Seater (Lebar 210cm)\", \"price_modifier\": 800000}, {\"name\": \"L-Shape Lounge\", \"price_modifier\": 2200000}], \"colors\": [{\"name\": \"Asli (Sesuai Foto)\", \"image\": \"https://images.unsplash.com/photo-1540518614846-7eded433c457?q=80&w=800\", \"value\": \"linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)\"}, {\"name\": \"Warm Beige\", \"image\": \"https://images.unsplash.com/photo-1507473885765-e6ed057f782c?q=80&w=800\", \"value\": \"#E8E1D5\"}, {\"name\": \"Sage Green\", \"image\": \"https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?q=80&w=800\", \"value\": \"#8C9A86\"}, {\"name\": \"Classic Navy\", \"image\": \"https://images.unsplash.com/photo-1540518614846-7eded433c457?q=80&w=800\", \"value\": \"#2B3E50\"}, {\"name\": \"Smoke Gray\", \"image\": \"https://images.unsplash.com/photo-1555041469-a586c61ea9bc?q=80&w=800\", \"value\": \"#8E9092\"}], \"materials\": [{\"name\": \"Kain Linen Berserat\", \"price_modifier\": 0}, {\"name\": \"Kain Beludru Premium\", \"price_modifier\": 500000}, {\"name\": \"Kulit Sintetis Premium\", \"price_modifier\": 1200000}], \"foam_colors\": [{\"name\": \"Putih Tulang\", \"value\": \"#F8F6F0\"}, {\"name\": \"Hitam Karbon\", \"value\": \"#1A1A1A\"}, {\"name\": \"Kelabu Asap\", \"value\": \"#8E9092\"}]}', '2026-05-22 07:07:17', '2026-05-25 05:08:10'),
(9, 3, 'Lemari Pakaian Jati Klasik', 'lemari-pakaian-jati-klasik', 'Lemari pakaian 2 pintu geser dengan penyimpanan gantung luas, laci internal, dan cermin full-body. Konstruksi kuat dari kayu jati dengan pengerjaan detail ukiran rapi khas pengrajin Jepara.', '4500000.00', 'cabinet_1.jpg', 4, 0, '{\"sizes\": [{\"name\": \"2 Pintu Standard\", \"price_modifier\": 0}, {\"name\": \"3 Pintu Ekstra Rak\", \"price_modifier\": 600000}], \"colors\": [{\"name\": \"Asli (Sesuai Foto)\", \"image\": \"https://images.unsplash.com/photo-1595428774223-ef52624120d2?q=80&w=800\", \"value\": \"linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)\"}, {\"name\": \"Pure White\", \"image\": \"https://images.unsplash.com/photo-1595428774223-ef52624120d2?q=80&w=800\", \"value\": \"#FAFAFA\"}, {\"name\": \"Natural Oak\", \"image\": \"https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?q=80&w=800\", \"value\": \"#D8B48F\"}, {\"name\": \"Elegant Teak\", \"image\": \"https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=800\", \"value\": \"#8B5A2B\"}], \"materials\": [{\"name\": \"MDF Berkualitas\", \"price_modifier\": 0}, {\"name\": \"Kayu Lapis Mahoni\", \"price_modifier\": 400000}, {\"name\": \"Kayu Jati Kering\", \"price_modifier\": 1000000}]}', '2026-05-22 07:07:17', '2026-05-22 07:07:17'),
(10, 3, 'Rak Buku Sekat Freja', 'rak-buku-sekat-freja', 'Rak buku sekaligus penyekat ruangan minimalis dua sisi. Sangat fungsional untuk menaruh koleksi buku, tanaman hias kecil, pajangan foto, atau mainan dekoratif.', '1800000.00', 'cabinet_2.jpg', 9, 1, '{\"sizes\": [{\"name\": \"2 Pintu Standard\", \"price_modifier\": 0}, {\"name\": \"3 Pintu Ekstra Rak\", \"price_modifier\": 600000}], \"colors\": [{\"name\": \"Asli (Sesuai Foto)\", \"image\": \"https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?q=80&w=800\", \"value\": \"linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)\"}, {\"name\": \"Pure White\", \"image\": \"https://images.unsplash.com/photo-1594620302200-9a7b2241a111?q=80&w=800\", \"value\": \"#FAFAFA\"}, {\"name\": \"Natural Oak\", \"image\": \"https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?q=80&w=800\", \"value\": \"#D8B48F\"}, {\"name\": \"Elegant Teak\", \"image\": \"https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=800\", \"value\": \"#8B5A2B\"}], \"materials\": [{\"name\": \"MDF Berkualitas\", \"price_modifier\": 0}, {\"name\": \"Kayu Lapis Mahoni\", \"price_modifier\": 400000}, {\"name\": \"Kayu Jati Kering\", \"price_modifier\": 1000000}]}', '2026-05-22 07:07:17', '2026-05-22 07:07:17'),
(11, 5, 'Cermin Dinding Estetik Aura', 'cermin-dinding-estetik-aura', 'Cermin gantung berbentuk asimetris berbingkai kayu jati tipis. Memberikan ilusi ruangan lebih luas sekaligus mempercantik area foyer masuk rumah atau meja rias Anda.', '450000.00', 'decor_1.jpg', 20, 1, '{\"sizes\": [{\"name\": \"Kecil\", \"price_modifier\": 0}, {\"name\": \"Sedang\", \"price_modifier\": 50000}, {\"name\": \"Besar\", \"price_modifier\": 120000}], \"colors\": [{\"name\": \"Asli (Sesuai Foto)\", \"image\": \"https://images.unsplash.com/photo-1618220179428-22790b461013?q=80&w=800\", \"value\": \"linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)\"}, {\"name\": \"Gold Brass\", \"image\": \"https://images.unsplash.com/photo-1618220179428-22790b461013?q=80&w=800\", \"value\": \"#D4AF37\"}, {\"name\": \"Matte Black\", \"image\": \"https://images.unsplash.com/photo-1617806118233-18e1db207f62?q=80&w=800\", \"value\": \"#111111\"}, {\"name\": \"Silver Chrome\", \"image\": \"https://images.unsplash.com/photo-1618220179428-22790b461013?q=80&w=800\", \"value\": \"#C0C0C0\"}], \"materials\": [{\"name\": \"Plastik & Kaca\", \"price_modifier\": 0}, {\"name\": \"Besi Tempa & Kaca\", \"price_modifier\": 100000}]}', '2026-05-22 07:07:17', '2026-05-22 07:07:17'),
(12, 5, 'Lampu Meja Keramik Luna', 'lampu-meja-keramik-luna', 'Lampu meja tidur dengan dudukan keramik bertekstur kasar natural dan tudung kain linen krem hangat. Memberikan pencahayaan temaram tempaan yang rileks di kamar tidur.', '350000.00', 'decor_2.jpg', 18, 0, '{\"sizes\": [{\"name\": \"Kecil\", \"price_modifier\": 0}, {\"name\": \"Sedang\", \"price_modifier\": 50000}, {\"name\": \"Besar\", \"price_modifier\": 120000}], \"colors\": [{\"name\": \"Asli (Sesuai Foto)\", \"image\": \"https://images.unsplash.com/photo-1507473885765-e6ed057f782c?q=80&w=800\", \"value\": \"linear-gradient(135deg, #C5A880 0%, #FAF8F5 100%)\"}, {\"name\": \"Gold Brass\", \"image\": \"https://images.unsplash.com/photo-1507473885765-e6ed057f782c?q=80&w=800\", \"value\": \"#D4AF37\"}, {\"name\": \"Matte Black\", \"image\": \"https://images.unsplash.com/photo-1513506003901-1e6a229e2d15?q=80&w=800\", \"value\": \"#111111\"}, {\"name\": \"Silver Chrome\", \"image\": \"https://images.unsplash.com/photo-1507473885765-e6ed057f782c?q=80&w=800\", \"value\": \"#C0C0C0\"}], \"materials\": [{\"name\": \"Plastik & Kaca\", \"price_modifier\": 0}, {\"name\": \"Besi Tempa & Kaca\", \"price_modifier\": 100000}]}', '2026-05-22 07:07:17', '2026-05-22 07:07:17'),
(13, 6, 'kursi jelek', 'kursi-jelek', 'kualitas jelek', '20.00', 'products/HPjOWo8JubGTwxvVqrfRFrQGegm9yJYhqeRfsrPT.png', 9, 0, '{\"sizes\": [], \"colors\": [], \"materials\": [], \"foam_colors\": []}', '2026-05-25 05:20:58', '2026-05-25 05:21:57');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('oE1n3PgUgjDycdX5OW056xx14QpVdmU7mCQSGUi3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoialBjRzc2ZDVKc08zMmxjc05EdWVUMkVHN0Y4UG4xWTFRSjZIMU5QdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWsva3Vyc2ktbWFrYW4tb2FrLW1pbmltYWxpcyI7czo1OiJyb3V0ZSI7czoxMzoicHJvZHVjdHMuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1780301960),
('YgD0SMtPQmiEtiKVZeGUSnr8opSVVhH3h2BZ7Qwz', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMDlnell0OXhsZ2xCdnNKVjJoS0x4RGdOQmoyUEExZzhnY1gwN3BLTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXNhbmFuL0ZSTi0yMDI2MDUyOS1JVVZaVVYiO3M6NToicm91dGUiO3M6MTE6Im9yZGVycy5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1780022271);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Furnishare', 'admin@furnishare.com', NULL, NULL, NULL, '$2y$12$0OmBlDCIb6U84a7ce0fHHe7FoD2fLZaGlWRUROrT5Rr6s7rUEyYTq', 1, NULL, '2026-05-22 07:07:17', '2026-05-22 07:07:17'),
(2, 'Budi Santoso', 'budi@gmail.com', NULL, NULL, NULL, '$2y$12$7Q5NoIyMQ8ql8WMYWLAwq.RskJX4h/gAu8W34/VF7PwjxICZKs4qm', 0, NULL, '2026-05-22 07:07:17', '2026-05-22 07:07:17'),
(3, 'na', 'noval@gmail.com', NULL, NULL, NULL, '$2y$12$uuLJfEpbo4nuD6tSXwnPpu6Pd5p6J/g3shSEnemeLwQ8oSu60/xeS', 0, NULL, '2026-05-22 08:41:42', '2026-05-22 08:41:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_code_unique` (`order_code`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
