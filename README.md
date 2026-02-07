<div align="center">

# 📚 E-Perpus YARSI

### Sistem Manajemen Perpustakaan Digital

<p>Aplikasi perpustakaan lengkap dengan manajemen buku fisik, e-book, peminjaman, serta e-book reader yang aman — dibangun dengan Laravel 12 dan Metronic 8.</p>

<br/>

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Metronic](https://img.shields.io/badge/Metronic-8-2563EB?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

</div>

---

## 🎯 Tentang Proyek

**E-Perpus YARSI** adalah sistem manajemen perpustakaan berbasis web yang dirancang untuk mengelola koleksi buku fisik dan e-book secara terintegrasi. Aplikasi ini memiliki dua area utama:

| Area | Akses | Keterangan |
|------|-------|------------|
| 🌐 **Halaman Publik** | Tanpa login | Katalog buku, peminjaman mandiri, baca e-book |
| 🔒 **Panel Admin** | Login required | Dashboard, CRUD, laporan, import/export |

---

## ✨ Fitur Utama

### 📖 Manajemen Buku Fisik
- CRUD lengkap (tambah, edit, hapus, detail)
- Upload cover image
- Manajemen stok otomatis
- Pencarian & filter berdasarkan judul, penulis, ISBN, tahun

### 📱 Manajemen E-Book
- Upload file PDF (disimpan secara privat)
- Penghitungan halaman otomatis
- Ebook reader bawaan berbasis PDF.js
- Proteksi download (no right-click, no print, no Ctrl+S, streaming only)

### 🔄 Sistem Peminjaman
- Peminjaman **tanpa perlu akun** — cukup isi form
- Durasi pinjam fleksibel (3–30 hari)
- Pengurangan stok otomatis saat pinjam
- Pengembalian stok saat buku dikembalikan
- Deteksi keterlambatan otomatis
- Status: `Dipinjam` → `Dikembalikan` / `Terlambat`

### 📊 Dashboard & Analitik
- **4 grafik interaktif** menggunakan ApexCharts (bundled Metronic):
  - 📈 Tren peminjaman 12 bulan terakhir (area chart)
  - 📉 Trafik pembaca e-book 30 hari (area chart)
  - 🍩 Distribusi kategori buku (donut chart)
  - 📊 Aktivitas mingguan peminjaman vs baca e-book (bar chart)
- Kartu statistik: total buku, buku fisik, e-book, dipinjam, terlambat, pembaca
- Top 5 buku terpopuler (paling banyak dipinjam)
- Top 5 e-book terpopuler (paling banyak dibaca)
- Tabel peminjaman & user terbaru

### 📥 Import & Export Data
- **Export CSV** untuk semua tabel data (kategori, buku fisik, e-book, peminjaman)
- **Import CSV** dengan validasi & deteksi duplikat
- **Download template CSV** untuk format yang benar
- Mendukung header bahasa Indonesia & Inggris
- Transaksi database untuk mencegah data korup

### 🔐 Keamanan E-Book Reader
- PDF di-stream dari private storage (tidak bisa diakses langsung)
- Blokir: klik kanan, Ctrl+P, Ctrl+S, F12, drag
- Header keamanan: `no-store`, `no-cache`, `nosniff`
- CSS `@media print { display: none }` & `user-select: none`
- Rendering di `<canvas>` (bukan `<embed>` atau `<iframe>`)

### ⚙️ Fitur Lainnya
- Manajemen user (admin & user biasa)
- Manajemen kategori buku
- Pengaturan aplikasi dinamis (nama, logo, favicon)
- Sidebar navigasi terstruktur
- Custom Metronic pagination
- Responsive design (desktop & mobile)

---

## 🗂️ Struktur Database

```
┌─────────────┐     ┌─────────────┐     ┌──────────────┐
│  categories  │────<│    books     │────<│    loans     │
│             │     │             │     │              │
│ id          │     │ id          │     │ id           │
│ name        │     │ category_id │     │ book_id      │
│ slug        │     │ code (ISBN) │     │ borrower_name│
│ description │     │ title       │     │ borrower_phone│
└─────────────┘     │ author      │     │ loan_date    │
                    │ publisher   │     │ due_date     │
                    │ year        │     │ return_date  │
                    │ stock       │     │ status       │
                    │ cover_image │     └──────────────┘
                    └──────┬──────┘
                           │
                    ┌──────┴──────┐     ┌──────────────┐
                    │   ebooks    │     │ ebook_reads  │
                    │             │     │              │
                    │ id          │     │ id           │
                    │ book_id     │     │ book_id      │
                    │ file_path   │     │ ip_address   │
                    │ total_pages │     │ user_agent   │
                    └─────────────┘     └──────────────┘
```

---

## 🚀 Instalasi

### Prasyarat

- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js & NPM (opsional, untuk compile assets)
- Laragon / XAMPP / Valet / Herd

### Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/username/e-perpus-yarsi.git
cd e-perpus-yarsi

# 2. Install dependencies
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Konfigurasi database di .env
# DB_DATABASE=perpus-yarsi
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Jalankan migrasi & seeder
php artisan migrate --seed

# 7. Buat symbolic link storage
php artisan storage:link

# 8. Jalankan server
php artisan serve
```

Akses aplikasi di **http://127.0.0.1:8000**

---

## 🔑 Akun Default

| Role | Email | Password |
|------|-------|----------|
| **Admin** | `admin@admin.com` | `password` |
| **User** | `user@user.com` | `password` |

---

## 🛣️ Daftar Route

### Halaman Publik (Tanpa Login)

| Method | URI | Keterangan |
|--------|-----|------------|
| `GET` | `/` | Katalog buku (homepage) |
| `GET` | `/catalog/{book}` | Detail buku |
| `GET` | `/borrow/{book}` | Form peminjaman |
| `POST` | `/borrow/{book}` | Proses peminjaman |
| `GET` | `/borrow/{loan}/success` | Konfirmasi berhasil |
| `GET` | `/read/{book}` | E-Book reader |
| `GET` | `/read/{book}/stream` | Stream PDF (private) |

### Panel Admin (Login Required)

| Modul | URI Prefix | Operasi |
|-------|-----------|---------|
| **Dashboard** | `/admin/dashboard` | Statistik & grafik |
| **Kategori** | `/admin/categories` | CRUD + import/export |
| **Buku Fisik** | `/admin/books` | CRUD + import/export |
| **E-Book** | `/admin/ebooks` | CRUD + import/export |
| **Peminjaman** | `/admin/loans` | List, detail, return, hapus, import/export |
| **User** | `/admin/users` | CRUD |
| **Pengaturan** | `/admin/settings` | Nama app, logo, favicon |

### Import & Export

| Method | URI | Keterangan |
|--------|-----|------------|
| `GET` | `/admin/import-export/export/{table}` | Export data ke CSV |
| `POST` | `/admin/import-export/import/{table}` | Import data dari CSV |
| `GET` | `/admin/import-export/template/{type}` | Download template CSV |

> Total: **54 routes** terdaftar

---

## 📁 Struktur Proyek

```
app/
├── Helpers/
│   └── helpers.php              # Helper app_setting()
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── BookController.php
│   │   │   ├── CategoryController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── EbookController.php
│   │   │   ├── ImportExportController.php
│   │   │   ├── LoanController.php
│   │   │   ├── AppSettingController.php
│   │   │   └── UserController.php
│   │   ├── BorrowController.php
│   │   ├── CatalogController.php
│   │   └── EbookReaderController.php
│   └── Middleware/
│       └── AdminMiddleware.php
├── Models/
│   ├── AppSetting.php
│   ├── Book.php
│   ├── Category.php
│   ├── Ebook.php
│   ├── EbookRead.php
│   ├── Loan.php
│   └── User.php
└── Services/
    └── LoanService.php          # Logika bisnis peminjaman

resources/views/
├── admin/
│   ├── dashboard.blade.php      # Dashboard + 4 chart ApexCharts
│   ├── books/                   # index, create, edit, show
│   ├── categories/              # index, create, edit
│   ├── ebooks/                  # index, create, edit, show
│   ├── loans/                   # index, show
│   ├── users/                   # index, create, edit
│   └── settings/                # index
├── layouts/
│   ├── app.blade.php            # Layout admin (Metronic 8)
│   ├── public.blade.php         # Layout publik
│   └── partials/                # Sidebar, header, footer, dll
├── public/
│   ├── catalog/                 # index, show
│   ├── borrow/                  # form, success
│   └── ebook/
│       └── reader.blade.php     # PDF.js ebook reader
└── vendor/pagination/
    └── metronic.blade.php       # Custom pagination Metronic
```

---

## 🛠️ Tech Stack

| Layer | Teknologi |
|-------|-----------|
| **Backend** | Laravel 12, PHP 8.2+ |
| **Database** | MySQL 8.0 |
| **Frontend** | Metronic 8 (admin), Bootstrap 5, Blade Templates |
| **Charts** | ApexCharts v3.45.1 (bundled di Metronic) |
| **PDF Reader** | PDF.js v3.11.174 (CDN) |
| **Icons** | Keenthemes Icon Duotone |
| **Storage** | Cover → `public` disk, PDF → `local` disk (private) |

---

## 📝 Seeder Data

Aplikasi sudah dilengkapi dengan data awal:

| Seeder | Data |
|--------|------|
| `AppSettingSeeder` | Pengaturan aplikasi (nama, logo, favicon, dll) |
| `CategorySeeder` | 2 kategori: Buku Fisik & E-Book |
| `BookSeeder` | 53 buku fisik koleksi perpustakaan |

Jalankan semua seeder:
```bash
php artisan db:seed
```

Atau jalankan seeder individual:
```bash
php artisan db:seed --class=BookSeeder
```

---

## 📸 Screenshot

> _Tambahkan screenshot di folder `docs/screenshots/` dan update bagian ini_

| Halaman | Preview |
|---------|---------|
| Katalog Publik | _screenshot_ |
| Dashboard Admin | _screenshot_ |
| Manajemen Buku | _screenshot_ |
| E-Book Reader | _screenshot_ |
| Form Peminjaman | _screenshot_ |

---

## 🤝 Kontribusi

1. Fork repository ini
2. Buat branch fitur (`git checkout -b fitur/fitur-baru`)
3. Commit perubahan (`git commit -m 'Tambah fitur baru'`)
4. Push ke branch (`git push origin fitur/fitur-baru`)
5. Buat Pull Request

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

<div align="center">

**Dibuat dengan ❤️ untuk Perpustakaan YARSI**

</div>
