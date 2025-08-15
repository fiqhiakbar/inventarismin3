# 🏫 Sistem Inventaris Sekolah - MIN 3 Klaten

Aplikasi web untuk manajemen inventaris barang sekolah menggunakan **Laravel 10** dan **PHP 8.1+**. Sistem ini dirancang khusus untuk kebutuhan administrasi inventaris sekolah dengan fitur lengkap dan antarmuka yang user-friendly.

## 🚀 Fitur Utama

### 📦 Manajemen Inventaris
- ✅ **CRUD Data Barang** - Kelola data inventaris dengan modal AJAX
- ✅ **Import/Export Excel** - Import dan export data barang via Excel
- ✅ **Generate PDF** - Laporan barang (semua data/individual)
- ✅ **Dashboard Statistik** - Chart dan grafik kondisi barang
- ✅ **Sistem Peminjaman** - Peminjaman barang masuk/keluar

### 🏢 Manajemen Sekolah
- ✅ **Data BOS** - Bantuan Operasional Sekolah
- ✅ **Data Ruangan** - Lokasi penyimpanan barang
- ✅ **Data Pengguna** - Manajemen user dan role
- ✅ **Role-Based Access Control** - Sistem hak akses

### 🎨 Interface
- ✅ **Responsive Design** - Kompatibel desktop & mobile
- ✅ **Modern UI** - Bootstrap dengan custom styling
- ✅ **Real-time Charts** - Statistik visual dengan Chart.js
- ✅ **Modal AJAX** - Navigasi tanpa reload halaman

## 📋 Prasyarat Sistem

- **PHP** ^8.1
- **Composer** (https://getcomposer.org/)
- **MySQL** Database
- **Web Server** (Apache/Nginx) atau **XAMPP**

## 🛠️ Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/fiqhiakbar/inventarismin3.git
cd inventarismin3
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventarissekolahku
DB_USERNAME=root
DB_PASSWORD=

# Nama sekolah untuk laporan
NAMA_SEKOLAH="MIN 3 Klaten"
```

### 5. Migrasi & Seeding
```bash
php artisan migrate --seed
```

### 6. Jalankan Aplikasi
```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

## 👤 Akun Default

### Administrator
- **Email:** `admin@mail.com`
- **Password:** `secret`

### Staff TU (Tata Usaha)
- **Email:** `stafftu@mail.com`
- **Password:** `secret`

⚠️ **Peringatan:** Segera ubah password default setelah login pertama!

## 📊 Struktur Database

### Tabel Utama
- `users` - Data pengguna sistem
- `commodities` - Data barang inventaris
- `commodity_locations` - Lokasi/ruangan
- `school_operational_assistances` - Data BOS
- `item_loans` - Peminjaman barang
- `roles` & `permissions` - Sistem RBAC

### Relasi Database
```
users (1) ←→ (n) item_loans
commodities (n) ←→ (1) commodity_locations
commodities (n) ←→ (1) school_operational_assistances
```

## 🎯 Alur Program

1. **Login** → Autentikasi user
2. **Dashboard** → Statistik inventaris
3. **Manajemen Data** → CRUD barang, ruangan, BOS
4. **Import/Export** → Excel operations
5. **Laporan** → Generate PDF
6. **Peminjaman** → Sistem peminjaman barang

## 🛡️ Keamanan

- **Authentication** - Laravel built-in auth
- **Authorization** - Spatie Laravel Permission
- **CSRF Protection** - Laravel CSRF tokens
- **Input Validation** - Form request validation
- **SQL Injection Protection** - Eloquent ORM

## 📱 Screenshots

### Login Page
![Login](https://i.imgur.com/kD6P7BF.png)

### Dashboard
![Dashboard](https://i.imgur.com/VJ0gCEv.png)

### Data Barang
![Data Barang](https://i.imgur.com/3AaIzxz.png)

### Laporan PDF
![Laporan](https://i.imgur.com/a7yj6Or.png)

## 🔧 Teknologi yang Digunakan

- **Backend:** Laravel 10, PHP 8.1+
- **Frontend:** Bootstrap 4, jQuery, Chart.js
- **Database:** MySQL
- **PDF:** DomPDF
- **Excel:** Maatwebsite Excel
- **Permissions:** Spatie Laravel Permission

## 📝 Lisensi

Proyek ini dikembangkan untuk MIN 3 Klaten, Jawa Tengah, Indonesia.

## 👨‍💻 Developer

- **Nama:** Fiqhi Akbar
- **Email:** fiqhiakbar@example.com
- **Institusi:** MIN 3 Klaten

---

**© 2024 MIN 3 Klaten - Sistem Inventaris Sekolah**
