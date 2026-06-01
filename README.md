# Furnishare E-Commerce

Proyek aplikasi E-Commerce Penjualan Furniture (Furnishare) berbasis Laravel. Repositori ini dibuat untuk keperluan tugas.

##  Persyaratan Sistem
Sebelum menjalankan aplikasi, pastikan komputer Anda telah terinstal:
- PHP (minimal versi 8.1 / menyesuaikan versi Laravel)
- [Composer](https://getcomposer.org/)
- [Node.js & NPM](https://nodejs.org/)
- Web Server & Database (XAMPP / Laragon / MySQL)

---

##  Cara Menjalankan Proyek (Panduan Instalasi)

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi secara lokal:

### 1. Clone Repository
Buka terminal/Command Prompt, lalu jalankan perintah berikut:
```bash
git clone https://github.com/rezadwimahendra/furnishare.git
cd furnishare
```

### 2. Install Dependensi (Library)
Install semua library standar yang dibutuhkan oleh Laravel dan Frontend:
```bash
composer install
npm install
npm run build
```

### 3. Konfigurasi Environment (`.env`)
Gandakan (Copy) file `.env.example` dan ubah namanya menjadi `.env`:
```bash
cp .env.example .env
```
*(Catatan: Jika error, copy-paste file `.env.example` secara manual melalui File Explorer, lalu *rename* menjadi `.env`)*

Lalu, hasilkan Application Key dengan perintah:
```bash
php artisan key:generate
```

### 4. Setup & Import Database 
Agar data produk dan user langsung terisi sama seperti aslinya, kita akan melakukan *import* dari file `.sql` yang telah disediakan, jadi Anda **tidak perlu menjalankan migration/seeder**.

1. Nyalakan **Apache** & **MySQL** di XAMPP/Laragon.
2. Buka phpMyAdmin (misal: `http://localhost/phpmyadmin`).
3. Buat database baru dengan nama: **`furnishare`**.
4. Klik database tersebut, pindah ke menu/tab **Import**.
5. Klik **Choose File** (Pilih File) lalu masukkan file **`furnishare.sql`** yang ada di folder proyek ini.
6. Klik tombol **Go** atau **Kirim** di bawah untuk mengeksekusi import. 

### 5. Atur Koneksi Database di `.env`
Buka file `.env` dan pastikan konfigurasi databasenya seperti ini:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=furnishare
DB_USERNAME=root
DB_PASSWORD=
```
*(Ubah DB_PASSWORD jika MySQL Anda memakai password khusus)*

### 6. Jalankan Server Aplikasi
Setelah semuanya selesai, jalankan perintah ini di terminal:
```bash
php artisan serve
```
Dan aplikasi web akan berjalan, Anda dapat mengaksesnya di browser melalui alamat:
**`http://localhost:8000`**

---
 Selamat mencoba!
