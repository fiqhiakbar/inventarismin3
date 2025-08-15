# 🚀 Panduan Deployment Tanpa SSH Access

## 📋 Overview
Panduan ini khusus untuk deployment website Laravel ke RumahWeb yang **tidak menyediakan SSH Access**. Kita akan menggunakan FTP deployment sebagai alternatif.

## 🎯 Solusi yang Tersedia

### 1. GitHub Actions + FTP (Recommended)
- ✅ **Deployment otomatis** setiap push ke GitHub
- ✅ **Tidak perlu SSH access**
- ✅ **Menggunakan FTP** yang tersedia di semua hosting

### 2. Manual Upload via File Manager
- ✅ **Upload manual** via cPanel File Manager
- ✅ **Setup database** via phpMyAdmin
- ✅ **Konfigurasi manual** di server

## 🔧 Setup GitHub Actions + FTP

### Langkah 1: Cari Informasi FTP

#### A. Buka cPanel dan cari FTP
1. **Login ke cPanel** RumahWeb
2. **Ketik "FTP"** di search bar
3. **Buka "FTP Accounts"**
4. **Catat informasi**:
   - FTP Server
   - Username
   - Password

#### B. Informasi FTP yang Diperlukan
```
FTP_SERVER = [ftp server, contoh: ftp.inventaris-min3.my.id]
FTP_USERNAME = [username hosting: invy5647]
FTP_PASSWORD = [password hosting Anda]
```

### Langkah 2: Setup GitHub Secrets

#### A. Buka Repository GitHub
1. **Buka repository** `https://github.com/fiqhiakbar/inventarismin3`
2. **Klik Settings** → **Secrets and variables** → **Actions**
3. **Klik "New repository secret"**

#### B. Tambahkan Secrets
```
FTP_SERVER = [ftp server dari cPanel]
FTP_USERNAME = invy5647
FTP_PASSWORD = [password hosting Anda]
```

### Langkah 3: Aktifkan Workflow FTP

#### A. Rename Workflow
1. **Rename file** `.github/workflows/deploy-ftp-only.yml` menjadi `.github/workflows/deploy.yml`
2. **Atau copy isi** dari `deploy-ftp-only.yml` ke `deploy-rumahweb.yml`

#### B. Push ke GitHub
```bash
git add .
git commit -m "Setup FTP deployment workflow"
git push origin main
```

## 📁 Manual Upload (Alternatif)

### Langkah 1: Upload File Website

#### A. Via File Manager
1. **Buka File Manager** di cPanel
2. **Upload file** `inventarismin3-for-rumahweb.zip`
3. **Extract file** di server
4. **Pindahkan semua file** ke folder `public_html`

#### B. Via FTP Client
1. **Download FTP client** (FileZilla, WinSCP)
2. **Connect ke server** dengan informasi FTP
3. **Upload file** ke folder `public_html`

### Langkah 2: Setup Database

#### A. Buat Database
1. **Buka phpMyAdmin** di cPanel
2. **Buat database baru**: `inventarissekolahku`
3. **Import file** `inventarissekolahku.sql`

### Langkah 3: Konfigurasi Environment

#### A. Buat File .env
1. **Buka File Manager**
2. **Buat file `.env`** di root folder website
3. **Copy isi** dari `config-hosting.env`

#### B. Update Konfigurasi
```env
APP_NAME="Sistem Inventaris Sekolah"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://inventaris-min3.my.id

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=inventarissekolahku
DB_USERNAME=invy5647_username
DB_PASSWORD=your_database_password
```

### Langkah 4: Set Permissions

#### A. Via File Manager
1. **Klik kanan folder `storage`** → **Change Permissions** → **755**
2. **Klik kanan folder `bootstrap/cache`** → **Change Permissions** → **755**
3. **Klik kanan file `.env`** → **Change Permissions** → **644**

### Langkah 5: Generate Application Key

#### A. Via cPanel Terminal (Jika Tersedia)
1. **Buka Terminal** di cPanel
2. **Jalankan perintah**:
```bash
cd /home/invy5647/public_html
php artisan key:generate
```

#### B. Manual Generate Key
Jika terminal tidak tersedia, generate key di local dan copy ke `.env`:
```bash
# Di komputer lokal
php artisan key:generate
# Copy APP_KEY yang dihasilkan ke file .env di server
```

### Langkah 6: Run Migrations & Seeders

#### A. Via cPanel Terminal
```bash
cd /home/invy5647/public_html
php artisan migrate:fresh --seed --force
```

#### B. Manual Setup Database
Jika terminal tidak tersedia, import database manual:
1. **Buka phpMyAdmin**
2. **Import file** `inventarissekolahku.sql`
3. **Pastikan semua tabel terisi**

## 🚀 Test Website

### URL Website
- **Website**: `https://inventaris-min3.my.id`
- **Admin Panel**: `https://inventaris-min3.my.id/login`

### Kredensial Login
- **Email**: `admin@mail.com`
- **Password**: `secret`

## 🔄 Workflow Deployment Otomatis

### Trigger Otomatis
- **Push ke branch main** → Deploy otomatis via FTP
- **Waktu deployment**: 2-5 menit

### Proses Otomatis
1. **Checkout code** dari GitHub
2. **Setup PHP 8.1** environment
3. **Install dependencies** (Composer)
4. **Build assets** (NPM)
5. **Upload ke server** via FTP
6. **Exclude file** yang tidak diperlukan

### Manual Steps Setelah Deployment
1. **Set permissions** folder storage dan cache
2. **Create/update file `.env`**
3. **Generate application key**
4. **Run migrations dan seeders**
5. **Clear caches**

## 🚨 Troubleshooting

### Error FTP Connection
1. **Cek informasi FTP** di cPanel
2. **Pastikan FTP aktif** di hosting
3. **Cek username dan password**

### Error 500 Internal Server Error
1. **Cek file `.env`** sudah benar
2. **Set permissions** folder storage dan cache
3. **Generate application key**

### Error Database Connection
1. **Cek konfigurasi database** di `.env`
2. **Pastikan database sudah dibuat**
3. **Test koneksi database**

### File Not Found Error
1. **Pastikan semua file terupload**
2. **Cek struktur folder** di server
3. **Pastikan `.htaccess` ada** di folder `public`

## 📞 Support

### RumahWeb Support
- **Email**: support@rumahweb.com
- **Live Chat**: Tersedia di website RumahWeb

### GitHub Issues
- **Repository issues** untuk bug reports
- **GitHub Discussions** untuk questions

---

## 🎯 Checklist Deployment

- [ ] Informasi FTP sudah didapat
- [ ] GitHub Secrets sudah dikonfigurasi
- [ ] Workflow FTP sudah diaktifkan
- [ ] Database sudah dibuat dan diimport
- [ ] File .env sudah dikonfigurasi
- [ ] Permissions folder sudah diset
- [ ] Application key sudah di-generate
- [ ] Website bisa diakses
- [ ] Login admin berfungsi

**Status**: ✅ Siap untuk deployment tanpa SSH!
