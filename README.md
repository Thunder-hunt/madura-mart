# 🛒 Madura Mart - School Project

![Madura Mart Banner](./madura_mart_banner_1776825629263.png)

> **Madura Mart** adalah sebuah platform manajemen inventaris dan penjualan retail yang modern, dibangun khusus untuk memenuhi kebutuhan digitalisasi UMKM. Project ini dikembangkan sebagai tugas sekolah dengan fokus pada kemudahan penggunaan dan efisiensi manajemen data.

---

## ✨ Fitur Utama

- 🔐 **Multi-Role Authentication**: Sistem login aman dengan peran berbeda (Admin, User, Courier, Client).
- 📊 **Dynamic Dashboard**: Ringkasan data transaksi dan inventaris secara real-time.
- 📦 **Product Management**: Kelola produk dengan fitur upload gambar dan tampilan modal yang interaktif.
- 💰 **Sales & Orders**: Proses transaksi penjualan dan pemesanan yang terintegrasi.
- 🏗️ **Supply Chain Management**: Fitur manajemen distributor dan pembelian stok (purchase).
- 👥 **User & Client Management**: Kelola data pengguna, pelanggan, dan kurir dalam satu tempat.

---

## 🛠️ Tech Stack

Project ini dibangun menggunakan teknologi terbaru untuk memastikan performa yang maksimal:

- **Framework**: [Laravel 12](https://laravel.com)
- **Styling**: [Tailwind CSS 4](https://tailwindcss.com)
- **Frontend Tooling**: [Vite](https://vitejs.dev)
- **Database**: MySQL
- **Language**: PHP 8.2+ & JavaScript

---

## 🚀 Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan project ini di komputer lokal Anda:

1. **Clone Repository**
   ```bash
   git clone https://github.com/Thunder-hunt/madura-mart.git
   cd madura-mart
   ```

2. **Install Dependensi**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env` dan sesuaikan pengaturan database Anda.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Migrasi Database**
   ```bash
   php artisan migrate
   ```

5. **Jalankan Aplikasi**
   ```bash
   npm run dev
   # Buka terminal baru
   php artisan serve
   ```

Aplikasi dapat diakses di `http://localhost:8000`.

---

## 📸 Tampilan
*(Anda dapat menambahkan screenshot aplikasi di sini)*

---

## 👨‍💻 Kontributor
- **Rainar Rizky Pangestu** - [GitHub Profile](https://github.com/Thunder-hunt)

---

## 📄 Lisensi
Project ini dibuat untuk tujuan edukasi (Tugas Sekolah).

---

<p align="center">
  Dibuat dengan ❤️ untuk kemajuan UMKM Indonesia
</p>
