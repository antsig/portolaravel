# GlobalTech - Premium Company Profile & Portfolio Hub

**GlobalTech** adalah platform profil perusahaan (*Company Profile*) dan pusat portofolio (*Portfolio Hub*) yang premium, modern, dan sepenuhnya dinamis. Aplikasi ini dirancang menggunakan ekosistem modern **Laravel** sebagai backend, **Tailwind CSS & Vite** untuk keindahan visual frontend, serta **Filament Admin Panel v3** untuk manajemen konten yang fleksibel dan aman.

Platform ini ideal untuk korporasi, startup, agensi, maupun profesional independen yang menginginkan representasi digital kelas dunia dengan performa tinggi dan pengelolaan konten yang intuitif.

---

## ✨ Fitur-Fitur Utama

### 🖥️ Frontend Premium & Adaptif
*   **Desain Harmonis & Modern**: Visualisasi modern menggunakan tipografi **Outfit Font**, aksen warna harmonis (Indigo & Emerald), serta mikro-animasi halus untuk meningkatkan *user engagement*.
*   **Pencegahan FOUC & Sinkronisasi Tema**: Saklar mode gelap/terang (*Dark/Light Mode*) yang responsif dengan sinkronisasi LocalStorage yang mencegah kedipan visual saat halaman dimuat.
*   **Equal Height Cards**: Grid kartu portofolio dan proyek dengan tinggi otomatis yang sejajar rapi (*equal height rows*) untuk estetika visual yang konsisten.
*   **Efek Mengetik Dinamis (Typist Effect)**: Headline interaktif pada Hero Section yang men-render teks kustom secara dinamis dengan efek ketikan berkelas.

### 🔒 Manajemen Konten & Keamanan Tingkat Tinggi (Filament Admin)
*   **Kontrol Konfigurasi Situs**: Kelola logo situs, teks fallback, logo perusahaan, foto avatar developer, biografi singkat, alamat, hingga tautan media sosial secara instan dari panel admin.
*   **Area Fokus & Statistik Mandiri (CRUD)**:
    *   **Area Fokus (Focus Areas)**: Kelola kartu fokus layanan bisnis (Tambah, Edit, Hapus, Susun Urutan) dilengkapi ikon preset visual (Code, Lightbulb, Rocket, CPU, Globe, Users).
    *   **Statistik Perusahaan (Stats Overview)**: Kelola metrik pencapaian (e.g. 50+ Proyek, 99.9% Uptime) secara dinamis dengan penanda badge warna zamrud yang premium.
*   **Pemisahan Kredensial & Profil**: Keamanan terjamin dengan pemisahan total antara **Email Kredensial Login Admin** (privat) dengan **Email Kontak Publik** (publik di frontend).
*   **Proteksi Akun Ekstra**: 
    *   **Verifikasi Password Lama**: Wajib memasukkan kata sandi aktif saat ini untuk dapat memverifikasi kepemilikan akun sebelum mengubah kata sandi baru.
    *   **Standar Sandi Kuat**: Menerapkan aturan enkripsi sandi tangguh (minimal 8 karakter, wajib kombinasi huruf, angka, dan simbol khusus).

### 📊 Real-Time Analytics Dashboard
*   **Pelacakan Analitik Mandiri**: Merekam log aktivitas pengunjung secara aman di database lokal (Kunjungan Halaman Utama dan Unduhan CV PDF) tanpa membebani browser dengan script eksternal.
*   **Unduh CV Terpantau (Tracked CV Downloads)**: Klik tombol CV di frontend dialihkan melalui rute backend khusus untuk menghitung jumlah unduhan secara presisi sebelum berkas dikirim ke browser.
*   **Widget Dashboard Statistik**: Dashboard utama panel admin menyajikan widget ringkasan data visual yang premium (Total Kunjungan & Unduhan vs Kunjungan & Unduhan Hari Ini).

### 🌐 Kemudahan Deployment (Shared Hosting Ready)
*   **Root .htaccess Berkeamanan Tinggi**: Berkas `.htaccess` bawaan dirancang khusus untuk shared hosting (cPanel, Plesk, dll) guna mengalihkan traffic secara transparan ke folder `/public` tanpa memunculkan kata `/public/` di URL.
*   **Sistem Blokir Proaktif**: Melindungi kode program internal dengan memblokir langsung (`403 Forbidden`) akses ke berkas sensitif (`.env`, `.git`, `composer.json`, dll) dan direktori inti Laravel.

---

## 🛠️ Stack Teknologi

*   **Backend Framework**: [Laravel](https://laravel.com)
*   **Administration Panel**: [Filament v3](https://filamentphp.com)
*   **Database ORM**: Eloquent (MySQL / SQLite / PostgreSQL)
*   **Frontend Engine**: [Livewire v3](https://livewire.laravel.com) & [Alpine.js](https://alpinejs.dev)
*   **Asset Bundler & Compiler**: [Vite](https://vitejs.dev)
*   **Styling**: [Tailwind CSS](https://tailwindcss.com)

---

## 🚀 Panduan Instalasi Lokal

### 1. Prasyarat
Pastikan komputer Anda sudah terinstal:
*   PHP >= 8.3
*   Composer
*   Node.js & NPM
*   Database Server (MySQL / MariaDB)

### 2. Kloning & Pengaturan Berkas
```bash
# Masuk ke direktori web server Anda
cd /path/to/webserver

# Salin berkas env
cp .env.example .env
```

### 3. Instalasi Dependensi & Setup
Jalankan perintah berikut untuk menginstal seluruh dependensi PHP & JavaScript, membuat kunci aplikasi, menjalankan migrasi database, dan melakukan kompilasi aset frontend:
```bash
# Jalankan composer install untuk mengunduh package backend
composer install

# Buat App Key
php artisan key:generate

# Jalankan migrasi database beserta seeder data awal dinamis
php artisan migrate:refresh --seed

# Hubungkan tautan direktori penyimpanan berkas publik (Storage Link)
php artisan storage:link

# Instalasi dependensi JavaScript & kompilasi aset frontend
npm install
npm run build
```

### 4. Menjalankan Server Lokal
```bash
php artisan serve
```
Akses website melalui browser pada alamat `http://127.0.0.1:8000`.

---

## 🔐 Kredensial Login Administrator Default

Setelah database di-seed, gunakan akun berikut untuk masuk ke panel admin:
*   **URL Admin**: `http://127.0.0.1:8000/admin`
*   **Email**: `admin@example.com`
*   **Password**: `password`

*(Sangat disarankan untuk segera mengubah email login dan kata sandi Anda melalui halaman **Kelola Profil** di sudut kanan atas panel admin setelah login pertama).*

---

## 📦 Deployment ke Shared Hosting (cPanel)

1.  Unggah seluruh isi direktori proyek Anda langsung ke folder root hosting Anda (di luar atau sejajar dengan `public_html`, atau langsung di dalam subfolder domain Anda).
2.  Pastikan berkas `.htaccess` di root proyek tetap berada di tempatnya agar traffic diarahkan secara aman ke folder `/public`.
3.  Konfigurasikan database pada berkas `.env` Anda di server.
4.  Lakukan penyesuaian berkas `.env` untuk mode produksi:
    ```env
    APP_ENV=production
    APP_DEBUG=false
    ```
5.  Selesai! Domain Anda akan langsung menampilkan platform secara premium dan aman.
