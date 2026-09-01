<div align="center">

<img src="https://raw.githubusercontent.com/Zxzidan/food-order/main/public/assets/img/LOGO.png" alt="SIPEMMA Logo" width="180"/>

# SIPEMMA

### *Sistem Pemesanan Makanan & Manajemen Restoran Modern*

**Aplikasi web Point of Sale (POS) dan operasional restoran terpadu — dari manajemen katalog menu, pemrosesan transaksi kasir, analitik laporan penjualan, hingga asisten pintar AI bertenaga Google Gemini.**

<br>

[![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Flowbite](https://img.shields.io/badge/Flowbite-1C64F2?style=for-the-badge&logo=flowbite&logoColor=white)](https://flowbite.com)
[![Google Gemini](https://img.shields.io/badge/Google_Gemini-AI-8E75B2?style=for-the-badge&logo=google&logoColor=white)](https://ai.google.dev/)
[![SQLite](https://img.shields.io/badge/SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white)](https://sqlite.org)
[![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)
[![License](https://img.shields.io/badge/License-MIT-22C55E?style=for-the-badge)](LICENSE)

</div>

---

## 📖 Sekilas Tentang SIPEMMA

**SIPEMMA** dirancang untuk memudahkan para pelaku usaha kuliner, restoran, cafe, dan kasir dalam mengelola pesanan harian secara cepat, rapi, dan efisien. Dibangun menggunakan arsitektur **Laravel 13** dan antarmuka **Tailwind CSS v4 + Flowbite**, SIPEMMA menghadirkan alur kerja kasir yang responsif, visual modern bertema bento-grid, kalkulasi akurat, dan asisten AI virtual untuk membantu pemilik resto mengambil keputusan bisnis yang lebih cerdas.

---

## ✨ Fitur Unggulan

<table>
  <tr>
    <td width="30%">🌐 <strong>Modern Bento Landing Page</strong></td>
    <td>Halaman depan berkonsep Bento-Grid interaktif dengan tipografi modern untuk memperkenalkan fitur aplikasi dan gerbang masuk pengguna.</td>
  </tr>
  <tr>
    <td>🔐 <strong>Autentikasi & Manajemen Akun</strong></td>
    <td>Sistem autentikasi aman (Login, Register, Logout) dengan proteksi middleware session dan pembagian peran (Admin & Kasir).</td>
  </tr>
  <tr>
    <td>📊 <strong>Dashboard Operasional</strong></td>
    <td>Monitoring performa restoran secara langsung: ringkasan total pesanan, total pelanggan, jumlah menu tersedia, serta daftar 4 menu terlaris.</td>
  </tr>
  <tr>
    <td>🛒 <strong>Point of Sale (POS) Interaktif</strong></td>
    <td>Alur kasir cepat dengan katalog menu berbasis tab kategori, pencarian instan, keranjang belanja real-time, catatan khusus per item, serta kalkulator tunai & kembalian.</td>
  </tr>
  <tr>
    <td>🪑 <strong>Fleksibilitas Pesanan</strong></td>
    <td>Mendukung tipe pesanan <code>Dine In</code> (lengkap dengan pilihan nomor meja) maupun <code>Take Away</code> (bungkus) serta nama pelanggan.</td>
  </tr>
  <tr>
    <td>🧾 <strong>Kalkulasi PB1 & Struk Pembayaran</strong></td>
    <td>Kalkulasi otomatis subtotal, pajak restoran PB1 (10%), total pembayaran, dan modal struk digital yang siap dicetak langsung (Print Receipt).</td>
  </tr>
  <tr>
    <td>🍜 <strong>Manajemen Menu Lengkap</strong></td>
    <td>Kelola menu restoran (Tambah, Edit, Hapus) dengan modal interaktif, pengaturan kategori, harga, kontrol sisa stok otomatis, dan preview gambar (file lokal maupun tautan URL).</td>
  </tr>
  <tr>
    <td>🤖 <strong>SIPEMMA AI Smart Assistant</strong></td>
    <td>Floating chatbot asisten virtual bertenaga <strong>Google Gemini AI (gemini-3.6-flash)</strong> yang dapat diajak berdiskusi tentang analisis penjualan, ide promo menu, prediksi jam ramai, hingga strategi manajemen restoran.</td>
  </tr>
  <tr>
    <td>📋 <strong>Riwayat Transaksi</strong></td>
    <td>Log seluruh transaksi pesanan pelanggan, ringkasan persentase penyelesaian, total pendapatan, dan rata-rata nominal pesanan (Average Order).</td>
  </tr>
  <tr>
    <td>📈 <strong>Laporan & Analitik Penjualan</strong></td>
    <td>Analisis bisnis mendalam yang memuat KPI utama (Total Pendapatan, Transaksi, Item Terjual, Average Order Value/AOV), visualisasi performa, dan ranking menu terlaris.</td>
  </tr>
  <tr>
    <td>👤 <strong>Manajemen Profil & Avatar</strong></td>
    <td>Halaman profil staf/admin untuk memperbarui informasi personal, kata sandi, dan foto profil yang tersimpan di storage sistem.</td>
  </tr>
  <tr>
    <td>🌓 <strong>Dukungan Tema Dark Mode</strong></td>
    <td>Desain ramah mata yang adaptif dan nyaman digunakan dalam kondisi pencahayaan restoran siang maupun malam hari.</td>
  </tr>
</table>

---

## 🛠️ Tech Stack

| Lapisan | Teknologi | Deskripsi |
|---|---|---|
| **Backend** | ![PHP](https://img.shields.io/badge/-PHP_8.3+-777BB4?logo=php&logoColor=white) ![Laravel](https://img.shields.io/badge/-Laravel_13-FF2D20?logo=laravel&logoColor=white) | Framework PHP modern dengan arsitektur MVC, Eloquent ORM, Session Middleware, dan REST controller. |
| **Frontend** | ![Blade](https://img.shields.io/badge/-Blade_Components-FF2D20?logo=laravel&logoColor=white) ![TailwindCSS](https://img.shields.io/badge/-Tailwind_CSS_v4-06B6D4?logo=tailwindcss&logoColor=white) ![Flowbite](https://img.shields.io/badge/-Flowbite_UI-1C64F2?logo=flowbite&logoColor=white) | Template engine modular, styling utility-first terbaru, komponen interaktif, dan Vanilla JavaScript. |
| **Kecerdasan Buatan (AI)** | ![Google Gemini](https://img.shields.io/badge/-Google_Gemini_API-8E75B2?logo=google&logoColor=white) | Model Generative Language `gemini-3.6-flash` sebagai otak SIPEMMA AI Restaurant Assistant. |
| **Database** | ![SQLite](https://img.shields.io/badge/-SQLite-003B57?logo=sqlite&logoColor=white) *(Default)* / MySQL Ready | Penyimpanan data relasional terstruktur dengan migration, seeder, dan factory. |
| **Build & Tooling** | ![Vite](https://img.shields.io/badge/-Vite-646CFF?logo=vite&logoColor=white) ![Composer](https://img.shields.io/badge/-Composer-885630?logo=composer&logoColor=white) ![Pest](https://img.shields.io/badge/-Pest_PHP-BE185D) ![Pint](https://img.shields.io/badge/-Laravel_Pint-F59E0B) | Asset bundling kilat, dependency manager, test runner, dan code styling fixer otomatis. |

---

## 🔑 Kredensial Akun Bawaan (Seeder)

Setelah menjalankan database seeder, akun default berikut dapat langsung digunakan untuk masuk ke sistem:

| Peran (Role) | Email | Password | Hak Akses |
|---|---|---|---|
| 👑 **Administrator** | `admin@sipemma.com` | `password` | Akses penuh seluruh sistem, manajemen menu, laporan, dan profil |
| 🧑‍💼 **Kasir** | `kasir@sipemma.com` | `password` | Operasional kasir (POS), riwayat transaksi, dan konsultasi AI |

> 💡 *Catatan: Anda juga dapat mendaftarkan akun kasir baru secara langsung melalui halaman registrasi (`/register`).*

---

## 📋 Persyaratan Sistem

Sebelum memulai instalasi, pastikan lingkungan komputer atau server Anda memenuhi spesifikasi berikut:

- ✅ **PHP** `>= 8.3` (Disarankan PHP 8.3 / 8.4 / 8.5)
- ✅ Ekstensi PHP: `pdo_sqlite` (atau `pdo_mysql`), `mbstring`, `openssl`, `curl`
- ✅ **Composer** (v2.x atau lebih baru)
- ✅ **Node.js** `>= 18.x` & **npm**
- ✅ **Google Gemini API Key** *(Diperlukan untuk mengaktifkan fitur SIPEMMA AI Assistant)*

---

## 🚀 Panduan Instalasi & Menjalankan Aplikasi

### 1. Clone Repository

```bash
git clone https://github.com/Zxzidan/food-order.git
cd food-order
```

### 2. Pasang Dependensi (PHP & Node.js)

```bash
composer install
npm install
```

### 3. Konfigurasi Environment (`.env`)

Salin file template konfigurasi dan buat application key:

```bash
cp .env.example .env
php artisan key:generate
```

Buka file `.env` menggunakan teks editor pilihan Anda, kemudian pastikan konfigurasi database dan API Key Gemini telah terisi:

```env
APP_NAME=SIPEMMA
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite

# Masukkan Google Gemini API Key Anda untuk mengaktifkan AI Assistant
GEMINI_API_KEY=your_gemini_api_key_here
```

### 4. Buat Symlink Penyimpanan Media (Avatar)

Agar foto avatar profil dapat diakses dari browser:

```bash
php artisan storage:link
```

### 5. Jalankan Migrasi & Seeder Database

Jalankan migrasi tabel beserta data awal (pengguna, kategori, katalog menu, meja resto, dan sampel riwayat transaksi):

```bash
php artisan migrate --seed
```

### 6. Jalankan Server Pengembangan (Development)

Anda dapat menjalankan seluruh service (Web Server Laravel, Vite HMR, dan Queue Listener) sekaligus dengan perintah:

```bash
composer run dev
```

*Atau jalankan secara terpisah melalui terminal yang berbeda:*

```bash
# Terminal 1: Web server Laravel
php artisan serve

# Terminal 2: Vite development server
npm run dev
```

Buka peramban browser Anda dan akses:
👉 **[http://localhost:8000](http://localhost:8000)** (atau **[http://127.0.0.1:8000](http://127.0.0.1:8000)**)

---

## 🖥️ Peta Rute & Halaman Aplikasi

| Ikon & Halaman | Path URL | Metode HTTP | Proteksi | Keterangan |
|---|---|---|---|---|
| 🌐 **Landing Page** | `/` | `GET` | Publik | Halaman presentasi modern bento-grid, preview sistem & tombol aksi. |
| 🔑 **Login** | `/login` | `GET` / `POST` | Guest | Autentikasi masuk pengguna dengan validasi session & remember me. |
| 📝 **Register** | `/register` | `GET` / `POST` | Guest | Pendaftaran akun kasir baru. |
| 🚪 **Logout** | `/logout` | `POST` | Auth | Keluar dari sesi akun dan invalidasi token session. |
| 📊 **Dashboard** | `/dashboard` | `GET` | Auth | Ringkasan metrik statistik toko, total order, menu, dan best sellers. |
| 🍜 **Manajemen Menu** | `/menu` | `GET` / `POST` / `PUT` / `DELETE` | Auth | Manajemen menu (tambah, edit, hapus) dengan filter kategori dan stok. |
| 🛒 **POS / Pemesanan** | `/order` | `GET` / `POST` | Auth | Point of Sale: pilih menu, kalkulasi PB1, uang tunai, dan cetak struk. |
| 📋 **Riwayat Pesanan** | `/history` | `GET` | Auth | Daftar riwayat transaksi, filter status pesanan, dan rekap omset. |
| 📈 **Laporan Penjualan** | `/reports` | `GET` | Auth | Laporan analitik KPI, Average Order Value (AOV), dan peringkat produk. |
| 👤 **Profil Akun** | `/profile` | `GET` / `POST` | Auth | Pengaturan akun pengguna, ganti kata sandi, dan upload foto avatar. |
| 🤖 **AI Chat Assistant** | `/ai/chat` | `POST` | Auth | API endpoint penghubung chatbot ke Google Gemini API. |

---

## 📁 Struktur Direktori Proyek

```
food-order/
│
├── 📂 app/                                  # Logika inti aplikasi Laravel
│   ├── 📂 Http/
│   │   └── 📂 Controllers/
│   │       ├── AiChatController.php         # Integrasi chatbot dengan Google Gemini API
│   │       ├── AuthController.php           # Autentikasi login, register, dan logout
│   │       ├── DashboardController.php      # Pengolahan metrik & statistik dashboard
│   │       ├── HistoryController.php        # Pengolahan log riwayat transaksi
│   │       ├── MenuController.php           # Pengelolaan katalog menu & kategori
│   │       ├── OrderController.php          # Logika kasir (POS) & proses checkout pesanan
│   │       ├── ProfileController.php        # Pengaturan profil & upload avatar
│   │       └── ReportController.php         # Analitik performa bisnis & KPI penjualan
│   ├── 📂 Models/
│   │   ├── Category.php                     # Model kategori menu
│   │   ├── Menu.php                         # Model item menu makanan/minuman
│   │   ├── Order.php                        # Model transaksi pesanan
│   │   ├── OrderItem.php                    # Model rincian item pesanan
│   │   ├── RestaurantTable.php              # Model meja restoran
│   │   └── User.php                         # Model pengguna (Admin/Kasir)
│   └── 📂 Providers/                        # Service providers aplikasi
│
├── 📂 database/                             # Basis data & relasi
│   ├── 📂 migrations/                       # Skema tabel (users, categories, menus, tables, orders, dll)
│   ├── 📂 seeders/                          # Data inisialisasi awal (User, Category, Menu, Table, Order)
│   └── database.sqlite                      # File basis data default SQLite
│
├── 📂 resources/                            # Aset tampilan & Blade templates
│   ├── 📂 css/
│   │   └── app.css                          # Stylesheet utama Tailwind CSS v4
│   ├── 📂 js/
│   │   └── app.js                           # Script JavaScript frontend & Flowbite
│   └── 📂 views/
│       ├── 📂 auth/                         # Template autentikasi
│       │   ├── login.blade.php              # Halaman formulir login
│       │   └── register.blade.php           # Halaman formulir pendaftaran
│       ├── 📂 components/                   # Komponen Blade modular & reusable
│       │   ├── 📂 history/                  # Komponen tabel, kartu, filter, & struk riwayat
│       │   ├── 📂 menu/                     # Komponen modal tambah, edit, & hapus menu
│       │   ├── 📂 order/                    # Komponen kartu produk & modal struk kasir
│       │   ├── 📂 reports/                  # Komponen kartu KPI, grafik, & tabel transaksi
│       │   ├── ai-chatbot.blade.php         # Komponen floating chatbot SIPEMMA Assistant
│       │   ├── header.blade.php             # Navigasi atas (profil, notifikasi, theme)
│       │   ├── layout.blade.php             # Master layout aplikasi
│       │   ├── sidebar.blade.php            # Navigasi samping dashboard
│       │   └── toast.blade.php              # Komponen alert toast interaktif
│       ├── checkout.blade.php               # Halaman penyelesaian pembayaran
│       ├── dashboard.blade.php              # Tampilan dashboard utama
│       ├── history.blade.php                # Tampilan riwayat seluruh transaksi
│       ├── landing.blade.php                # Tampilan beranda modern bento landing page
│       ├── menu.blade.php                   # Tampilan manajemen katalog menu
│       ├── order.blade.php                  # Tampilan sistem kasir POS & keranjang
│       ├── profile.blade.php                # Tampilan pengaturan profil akun
│       └── reports.blade.php                # Tampilan laporan analitik penjualan
│
├── 📂 routes/
│   ├── web.php                              # Definisi seluruh rute web & middleware
│   └── console.php                          # Definisi perintah artisan kustom
│
├── 📂 public/                               # File publik yang dapat diakses browser
│   ├── 📂 assets/img/                       # Logo & ilustrasi aplikasi
│   ├── 📂 storage/                          # Symlink ke storage public (avatar & upload media)
│   ├── index.php                            # Entry point Laravel
│   └── .htaccess                            # Konfigurasi Apache web server
│
├── 📂 storage/                              # Berkas log aplikasi, sesi, cache, dan unggahan
├── 📂 tests/                                # Pengujian otomatis aplikasi (Pest PHP)
├── .env.example                             # Panduan variabel lingkungan
├── composer.json                            # Dependensi paket PHP
├── package.json                             # Dependensi paket JavaScript & Tailwind v4
└── vite.config.js                           # Konfigurasi bundler Vite
```

---

## ⚙️ Perintah Artisan & Pengujian

```bash
# Menjalankan unit & feature testing (Pest PHP)
composer run test
# atau
php artisan test

# Melakukan linting dan formatting kode PHP sesuai standar Laravel
vendor/bin/pint --format agent

# Melakukan kompilasi aset frontend untuk keperluan production
npm run build

# Menghapus cache aplikasi jika terdapat perubahan konfigurasi
php artisan optimize:clear
```

---

## 🤝 Kontribusi

Kontribusi, saran perbaikan, dan ide pengembangan selalu disambut dengan baik:

1. **Fork** repositori ini.
2. Buat branch fitur baru (`git checkout -b feature/FiturKeren`).
3. Lakukan commit perubahan (`git commit -m 'Menambahkan fitur keren'`).
4. Push ke branch Anda (`git push origin feature/FiturKeren`).
5. Buat **Pull Request** baru.

---

## 📄 Lisensi

Proyek ini dirilis di bawah lisensi [MIT License](LICENSE). Silakan gunakan dan kembangkan sesuai dengan kebutuhan Anda.

---

<div align="center">

Dibuat dengan ❤️ untuk kemajuan manajemen kuliner & restoran modern.

**SIPEMMA &copy; 2026**

</div>
