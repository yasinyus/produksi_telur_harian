# 🐔 Sistem Pencatatan Produksi Telur Harian

Aplikasi berbasis Laravel + Filament untuk mencatat dan memonitor produksi telur harian di peternakan layer (ayam petelur).  
Dibuat dengan Filament Admin Panel versi 3.3.x.

## ✨ Fitur Utama

- ✅ Manajemen data Kandang
- ✅ Pencatatan Produksi Telur Harian:
  - Jumlah telur butir
  - Berat telur (kg)
  - Telur retak & telur kotor
  - Kematian dan afkir
- ✅ Perhitungan otomatis:
  - HD% (Hen Day)
  - HH% (Hen House)
  - FCR (Feed Conversion Ratio)
- ✅ Umur ayam otomatis berdasarkan tanggal mulai kandang
- ✅ Grafik produksi harian (butir & kg)
- ✅ Statistik produksi total
- ✅ Filter data berdasarkan tanggal & kandang
- ✅ Export data ke Excel dan PDF *(optional)*
- ✅ Dashboard rekap produksi total

---

## 🔧 Teknologi

- PHP 8.2
- Laravel 12.x
- Filament v3.3.x
- MySQL / MariaDB

---

## 🚀 Instalasi & Setup

### 1️⃣ Clone project

git clone https://github.com/yasinyus/produksi_telur_harian.git
cd produksi_telur_harian

### 2️⃣ Install dependencies
composer install

### 3️⃣ Copy environment
cp .env.example .env
Edit file .env sesuai konfigurasi database lokal kamu:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=

### 4️⃣ Generate key
php artisan key:generate

### 5️⃣ Jalankan migrasi
php artisan migrate

### 6️⃣ (Optional) Generate dummy data
Jika tersedia seeder, jalankan:
php artisan db:seed

### 7️⃣ Jalankan aplikasi
php artisan serve

Aplikasi dapat diakses melalui:
http://127.0.0.1:8000

### 🛡️ Login Admin Filament
Setelah install, kamu bisa akses panel admin:
/admin

### Kamu bisa buat user admin dengan perintah:
php artisan make:filament-user


📊 Catatan Tambahan
Project menggunakan Filament v3.3.x.
Beberapa custom widget dibuat secara manual di dalam folder app/Filament/Widgets/.
Export ke Excel menggunakan Laravel Excel (jika diaktifkan).
Export ke PDF menggunakan DomPDF (sudah include).


