# 🔄 Panduan Integrasi GitHub dengan RumahWeb

## 📋 Overview
Panduan ini akan membantu Anda mengintegrasikan repository GitHub dengan hosting RumahWeb untuk deployment otomatis menggunakan GitHub Actions.

## 🎯 Manfaat Integrasi GitHub-RumahWeb
- ✅ **Deployment Otomatis**: Setiap push ke branch main akan otomatis deploy ke server
- ✅ **Version Control**: Tracking perubahan kode dengan Git
- ✅ **Rollback Mudah**: Bisa kembali ke versi sebelumnya jika ada masalah
- ✅ **Collaboration**: Tim bisa bekerja bersama di repository yang sama
- ✅ **Backup Otomatis**: Kode tersimpan aman di GitHub

## 🔧 Langkah-langkah Setup

### 1. Persiapan Repository GitHub

#### A. Push Code ke GitHub
```bash
# Jika belum ada repository
git init
git add .
git commit -m "Initial commit"
git branch -M main
git remote add origin https://github.com/username/inventarismin3.git
git push -u origin main
```

#### B. Pastikan File Workflow Sudah Ada
- ✅ `.github/workflows/deploy-rumahweb.yml` (Workflow lengkap)
- ✅ `.github/workflows/deploy-simple.yml` (Workflow sederhana)

### 2. Setup SSH Key untuk RumahWeb

#### A. Generate SSH Key Pair
```bash
# Generate SSH key baru
ssh-keygen -t rsa -b 4096 -C "your-email@example.com" -f ~/.ssh/rumahweb_key

# Tampilkan public key
cat ~/.ssh/rumahweb_key.pub

# Tampilkan private key
cat ~/.ssh/rumahweb_key
```

#### B. Setup SSH Key di RumahWeb
1. **Login ke cPanel RumahWeb**
2. **Buka SSH Access** di cPanel
3. **Upload public key** (`rumahweb_key.pub`) ke server
4. **Test koneksi SSH**:
   ```bash
   ssh -i ~/.ssh/rumahweb_key username@your-domain.com
   ```

### 3. Setup GitHub Secrets

#### A. Buka Repository Settings
1. Buka repository GitHub Anda
2. Klik **Settings** → **Secrets and variables** → **Actions**
3. Klik **New repository secret**

#### B. Tambahkan Secrets Berikut

**Untuk Workflow Sederhana:**
```
SSH_PRIVATE_KEY = [isi private key dari ~/.ssh/rumahweb_key]
REMOTE_HOST = [domain atau IP server RumahWeb]
REMOTE_USER = [username hosting RumahWeb]
REMOTE_TARGET = [/home/username/public_html]
```

**Untuk Workflow Lengkap:**
```
FTP_SERVER = [ftp server RumahWeb]
FTP_USERNAME = [username FTP]
FTP_PASSWORD = [password FTP]
SSH_HOST = [domain atau IP server]
SSH_USERNAME = [username hosting]
SSH_PRIVATE_KEY = [isi private key]
```

### 4. Konfigurasi Environment File

#### A. Buat File .env di Server
1. **Login ke cPanel RumahWeb**
2. **Buka File Manager**
3. **Buat file `.env`** di root folder website
4. **Copy isi dari `config-hosting.env`**

#### B. Update Konfigurasi
```env
APP_NAME="Sistem Inventaris Sekolah"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=inventarissekolahku
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### 5. Setup Database

#### A. Import Database
1. **Buka phpMyAdmin** di cPanel
2. **Buat database** `inventarissekolahku`
3. **Import file** `inventarissekolahku.sql`

#### B. Generate Application Key
```bash
# Via SSH atau Terminal di cPanel
cd /home/username/public_html
php artisan key:generate
```

### 6. Test Deployment

#### A. Push Perubahan
```bash
git add .
git commit -m "Setup GitHub Actions deployment"
git push origin main
```

#### B. Monitor Deployment
1. **Buka repository GitHub**
2. **Klik tab Actions**
3. **Monitor progress deployment**

## 🔄 Workflow Deployment

### Trigger Otomatis
- **Push ke branch main/master** → Deploy otomatis
- **Pull Request** → Deploy untuk testing (opsional)

### Proses Deployment
1. **Checkout code** dari GitHub
2. **Setup PHP 8.1** environment
3. **Install dependencies** (Composer)
4. **Build assets** (NPM)
5. **Upload ke server** via SSH/SFTP
6. **Set permissions** folder storage dan cache
7. **Clear Laravel caches**

## 🚨 Troubleshooting

### Error SSH Connection
```bash
# Test koneksi SSH
ssh -i ~/.ssh/rumahweb_key username@your-domain.com

# Cek permission file key
chmod 600 ~/.ssh/rumahweb_key
```

### Error Permission Denied
```bash
# Set permission di server
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env
```

### Error Database Connection
1. **Cek konfigurasi database** di `.env`
2. **Pastikan database sudah dibuat**
3. **Test koneksi database**

### Error Build Assets
```bash
# Install Node.js dependencies
npm install

# Build untuk production
npm run production
```

## 📊 Monitoring Deployment

### GitHub Actions Log
- **View logs** di tab Actions
- **Check step-by-step** progress
- **Debug errors** jika ada

### Server Logs
```bash
# Cek error log Laravel
tail -f storage/logs/laravel.log

# Cek error log server
tail -f /var/log/apache2/error.log
```

## 🔐 Keamanan

### Best Practices
- ✅ **Gunakan SSH key** bukan password
- ✅ **Restrict SSH access** ke IP tertentu
- ✅ **Regular backup** database dan files
- ✅ **Monitor logs** untuk suspicious activity
- ✅ **Update dependencies** secara berkala

### Environment Variables
- ✅ **Jangan commit** file `.env` ke GitHub
- ✅ **Gunakan secrets** untuk sensitive data
- ✅ **Rotate keys** secara berkala

## 📞 Support

### GitHub Issues
- **Repository issues** untuk bug reports
- **GitHub Discussions** untuk questions
- **GitHub Wiki** untuk dokumentasi

### RumahWeb Support
- **Email**: support@rumahweb.com
- **Live Chat**: Tersedia di website RumahWeb
- **Phone**: 021-XXXXXXXX

---

## 🎯 Checklist Setup

- [ ] Repository GitHub sudah dibuat
- [ ] Code sudah di-push ke GitHub
- [ ] SSH key sudah di-generate dan di-setup
- [ ] GitHub Secrets sudah dikonfigurasi
- [ ] Database sudah diimport
- [ ] File .env sudah dikonfigurasi
- [ ] Test deployment berhasil
- [ ] Monitoring setup

**Status**: ✅ Siap untuk deployment otomatis!
