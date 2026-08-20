<div align="center">

<img src="public/assets/img/LOGO.png" alt="SIPEMMA Logo" width="180"/>

# SIPEMMA

### *Sistem Pemesanan Makanan*

**Aplikasi web POS modern untuk operasional restoran — dari manajemen menu hingga pemrosesan pesanan pelanggan.**

<br>

[![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)
[![License](https://img.shields.io/badge/License-MIT-22C55E?style=for-the-badge)](LICENSE)

</div>

---

## ✨ Fitur Unggulan

<table>
  <tr>
    <td>📊 <strong>Dashboard</strong></td>
    <td>Ringkasan pelanggan, pesanan, menu, dan statistik penjualan secara real-time.</td>
  </tr>
  <tr>
    <td>🍜 <strong>Manajemen Menu</strong></td>
    <td>Tambah, edit, dan hapus menu makanan & minuman via modal yang intuitif.</td>
  </tr>
  <tr>
    <td>🔍 <strong>Pencarian & Filter</strong></td>
    <td>Cari menu dan filter berdasarkan kategori dengan cepat.</td>
  </tr>
  <tr>
    <td>🖼️ <strong>Preview Gambar</strong></td>
    <td>Preview gambar menu langsung dari perangkat atau URL eksternal.</td>
  </tr>
  <tr>
    <td>🛒 <strong>Point of Sale (POS)</strong></td>
    <td>Pilih menu, kelola keranjang, dan proses pesanan dengan mudah.</td>
  </tr>
  <tr>
    <td>🪑 <strong>Tipe Pesanan</strong></td>
    <td>Dukungan <code>Dine In</code> dan <code>Take Away</code> dengan pengaturan meja & nama pelanggan.</td>
  </tr>
  <tr>
    <td>🧾 <strong>Kalkulasi Otomatis</strong></td>
    <td>Perhitungan subtotal, pajak PB1 (10%), dan total pembayaran secara otomatis.</td>
  </tr>
  <tr>
    <td>📋 <strong>Riwayat & Laporan</strong></td>
    <td>Halaman riwayat pesanan dan laporan penjualan lengkap.</td>
  </tr>
</table>

---

## 🛠️ Tech Stack

| Teknologi | Versi | Keterangan |
|-----------|-------|------------|
| ![PHP](https://img.shields.io/badge/-PHP-777BB4?logo=php&logoColor=white) | 8.3+ | Backend utama |
| ![Laravel](https://img.shields.io/badge/-Laravel-FF2D20?logo=laravel&logoColor=white) | 13 | Framework PHP |
| ![Blade](https://img.shields.io/badge/-Blade-FF2D20?logo=laravel&logoColor=white) | — | Template engine & components |
| ![TailwindCSS](https://img.shields.io/badge/-Tailwind_CSS-06B6D4?logo=tailwindcss&logoColor=white) | 4 | Utility-first CSS framework |
| ![Flowbite](https://img.shields.io/badge/-Flowbite-1C64F2?logo=flowbite&logoColor=white) | — | UI component library |
| ![Vite](https://img.shields.io/badge/-Vite-646CFF?logo=vite&logoColor=white) | — | Frontend build tool |

---

## 📋 Persyaratan

Sebelum instalasi, pastikan sistem Anda memiliki:

- ✅ **PHP** `8.3` atau lebih baru
- ✅ **Composer** (dependency manager PHP)
- ✅ **Node.js** & **npm**
- ✅ **Database** yang sudah dikonfigurasi di `.env`

---

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone <url-repository>
cd food-order
```

### 2. Jalankan Setup Otomatis

```bash
composer run setup
```

> Script ini secara otomatis akan:
> - 📦 Memasang dependency PHP & JavaScript
> - 🔑 Membuat file `.env` dan application key
> - 🗄️ Menjalankan database migration
> - ⚡ Melakukan build aset frontend

### 3. Jalankan Mode Development

```bash
composer run dev
```

Buka browser di **[http://localhost:8000](http://localhost:8000)** dan aplikasi siap digunakan! 🎉

---

## 🖥️ Halaman Aplikasi

| Halaman | URL | Deskripsi |
|---------|-----|-----------|
| 🏠 Dashboard | `/` | Ringkasan operasional & statistik penjualan |
| 🍜 Menu | `/menu` | Lihat, cari, filter, dan kelola daftar menu |
| 🛒 Pemesanan | `/order` | Pilih menu, atur detail pelanggan, proses pesanan |
| 📋 Riwayat | `/history` | Riwayat seluruh pesanan |
| 📊 Laporan | `/reports` | Laporan penjualan lengkap |

---

## ⚙️ Perintah Berguna

```bash
# Menjalankan server Laravel dan Vite secara terpisah
php artisan serve
npm run dev

# Build frontend untuk production
npm run build

# Menjalankan test suite
composer run test
```

---

## 📁 Struktur Proyek

```
food-order/
│
├── 📂 app/                                  # Komponen inti aplikasi Laravel
│   ├── 📂 Http/
│   │   └── 📂 Controllers/
│   │       └── Controller.php               # Base controller
│   ├── 📂 Models/
│   │   └── User.php                         # Model user
│   ├── 📂 Providers/                        # Service providers
│   └── 📂 View/                             # View composers & classes
│
├── 📂 database/                             # Database layer
│   ├── 📂 migrations/                       # Skema tabel database
│   │   ├── ..._create_users_table.php
│   │   ├── ..._create_cache_table.php
│   │   └── ..._create_jobs_table.php
│   ├── 📂 factories/                        # Factory untuk data dummy
│   ├── 📂 seeders/                          # Seeder database
│   └── database.sqlite                      # File database SQLite
│
├── 📂 resources/                            # Aset & tampilan aplikasi
│   ├── 📂 css/
│   │   └── app.css                          # Stylesheet utama (Tailwind)
│   ├── 📂 js/
│   │   └── app.js                           # Entry point JavaScript
│   └── 📂 views/                            # Halaman Blade
│       ├── dashboard.blade.php              # Halaman dashboard
│       ├── menu.blade.php                   # Halaman manajemen menu
│       ├── order.blade.php                  # Halaman POS / pemesanan
│       ├── history.blade.php                # Halaman riwayat pesanan
│       ├── reports.blade.php                # Halaman laporan penjualan
│       └── 📂 components/                   # Komponen Blade reusable
│           ├── layout.blade.php             # Layout utama aplikasi
│           ├── sidebar.blade.php            # Komponen navigasi sidebar
│           ├── header.blade.php             # Komponen header halaman
│           ├── toast.blade.php              # Notifikasi toast
│           ├── 📂 menu/                     # Komponen halaman menu
│           │   ├── card.blade.php           # Kartu tampilan menu
│           │   ├── add-modal.blade.php      # Modal tambah menu
│           │   ├── edit-modal.blade.php     # Modal edit menu
│           │   └── delete-modal.blade.php   # Modal hapus menu
│           └── 📂 order/                    # Komponen halaman pemesanan
│               ├── card.blade.php           # Kartu item menu di POS
│               └── receipt-modal.blade.php  # Modal struk pembayaran
│
├── 📂 routes/
│   ├── web.php                              # Route halaman aplikasi
│   └── console.php                          # Route CLI / artisan
│
├── 📂 public/                               # Folder publik web server
│   ├── 📂 assets/
│   │   └── 📂 img/                          # Gambar aset (LOGO, menu, dll)
│   ├── 📂 build/                            # Hasil compile Vite (css, js)
│   ├── index.php                            # Entry point aplikasi
│   └── .htaccess                            # Konfigurasi Apache
│
├── 📂 tests/                                # Pengujian aplikasi
│   ├── 📂 Feature/                          # Feature tests
│   ├── 📂 Unit/                             # Unit tests
│   └── Pest.php                             # Konfigurasi Pest PHP
│
├── 📂 config/                               # File konfigurasi Laravel
├── 📂 bootstrap/                            # Bootstrap framework
├── 📂 storage/                              # Log, cache, file upload
│
├── .env                                     # Konfigurasi environment
├── .env.example                             # Template konfigurasi
├── artisan                                  # CLI Laravel
├── composer.json                            # Dependency PHP
├── package.json                             # Dependency JavaScript
└── vite.config.js                           # Konfigurasi Vite
```

---

## 📌 Status Pengembangan

> [!NOTE]
> SIPEMMA saat ini berfokus pada **antarmuka operasional restoran**. Data contoh menu, statistik, riwayat, dan laporan masih disediakan pada sisi tampilan (frontend-driven). Integrasi database penuh serta penyimpanan transaksi dapat dikembangkan pada tahap berikutnya.

---

## 📄 Lisensi

Proyek ini dikembangkan untuk kebutuhan internal **SIPEMMA**.

---

<div align="center">

Made with ❤️ using **Laravel** + **Tailwind CSS**

</div>