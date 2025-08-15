# ✅ Checklist Hosting Website ke RumahWeb

## 📁 File yang Perlu Disiapkan
- [ ] `inventarismin3-for-rumahweb.zip` (54MB)
- [ ] `inventarissekolahku.sql` (367KB)
- [ ] `PANDUAN_HOSTING_RUMAHWEB.md`
- [ ] `config-hosting.env`
- [ ] `CHECKLIST_HOSTING_RUMAHWEB.md`

## 🔧 Langkah-langkah Upload

### 1. Persiapan Hosting
- [ ] Login ke cPanel RumahWeb
- [ ] Pastikan PHP version 8.1+ tersedia
- [ ] Pastikan MySQL/MariaDB tersedia
- [ ] Aktifkan SSL certificate untuk domain

### 2. Upload File Website
- [ ] Buka File Manager di cPanel
- [ ] Upload `inventarismin3-for-rumahweb.zip` ke public_html
- [ ] Extract file ZIP di server
- [ ] Pindahkan semua file ke root folder website
- [ ] Hapus file ZIP yang sudah diextract

### 3. Setup Database
- [ ] Buka phpMyAdmin
- [ ] Buat database baru: `inventarissekolahku`
- [ ] Import file `inventarissekolahku.sql`
- [ ] Catat username dan password database

### 4. Konfigurasi Environment
- [ ] Buat file `.env` di root folder website
- [ ] Copy isi dari `config-hosting.env`
- [ ] Ganti `yourdomain.com` dengan domain Anda
- [ ] Ganti `your_database_username` dengan username database
- [ ] Ganti `your_database_password` dengan password database

### 5. Generate Application Key
- [ ] Buka Terminal/SSH di cPanel
- [ ] Jalankan: `php artisan key:generate`
- [ ] Copy APP_KEY yang dihasilkan ke file `.env`

### 6. Set Permission
- [ ] Set permission folder `storage/` ke 755
- [ ] Set permission folder `bootstrap/cache/` ke 755
- [ ] Set permission file `.env` ke 644

### 7. Test Website
- [ ] Akses website: `https://yourdomain.com`
- [ ] Test login admin
- [ ] Test fitur-fitur utama
- [ ] Cek error log jika ada masalah

## 🚨 Troubleshooting Checklist

### Jika Error 500:
- [ ] Cek file `.env` sudah benar
- [ ] Cek permission folder storage dan bootstrap/cache
- [ ] Cek error log di cPanel
- [ ] Pastikan APP_KEY sudah di-generate

### Jika Database Error:
- [ ] Cek konfigurasi database di `.env`
- [ ] Pastikan database sudah dibuat dan diimport
- [ ] Cek username dan password database
- [ ] Test koneksi database

### Jika File Not Found:
- [ ] Pastikan semua file sudah diupload
- [ ] Cek struktur folder di server
- [ ] Pastikan `.htaccess` ada di folder `public`
- [ ] Cek permission file dan folder

## 📞 Support Contact
- **RumahWeb Support**: support@rumahweb.com
- **Technical Support**: 021-XXXXXXXX

## 🎯 Target Selesai
- [ ] Website bisa diakses: `https://yourdomain.com`
- [ ] Admin panel bisa diakses: `https://yourdomain.com/login`
- [ ] Semua fitur berfungsi normal
- [ ] SSL certificate aktif
- [ ] Backup database dan file website

---

**Catatan**: Checklist ini harus diisi satu per satu untuk memastikan tidak ada langkah yang terlewat.
