# 🔐 Panduan Menambahkan GitHub Secrets

## 📋 Langkah-langkah Menambahkan Secrets

### 1. **Buka Repository Settings**
- Buka: `https://github.com/fiqhiakbar/inventarismin3`
- Klik tab **"Settings"** (di bagian atas)

### 2. **Buka Secrets and Variables**
- Di sidebar kiri, klik **"Secrets and variables"**
- Pilih **"Actions"**

### 3. **Tambahkan 3 Secrets Berikut**

#### A. FTP_SERVER
- Klik **"New repository secret"**
- **Name**: `FTP_SERVER`
- **Value**: `ftp.inventaris-min3.my.id`
- Klik **"Add secret"**

#### B. FTP_USERNAME  
- Klik **"New repository secret"**
- **Name**: `FTP_USERNAME`
- **Value**: `invy5647` (atau username FTP Anda)
- Klik **"Add secret"**

#### C. FTP_PASSWORD
- Klik **"New repository secret"**
- **Name**: `FTP_PASSWORD`
- **Value**: `[password FTP Anda]`
- Klik **"Add secret"**

## 🔍 Cara Mendapatkan Kredensial FTP

### Dari cPanel RumahWeb:
1. **Login ke cPanel**
2. **Buka "FTP Accounts"**
3. **Klik "Configure FTP Client"** untuk account `invy5647`
4. **Copy kredensial** yang muncul

### Contoh Kredensial:
```
FTP_SERVER = ftp.inventaris-min3.my.id
FTP_USERNAME = invy5647
FTP_PASSWORD = [password dari cPanel]
```

## ✅ Verifikasi Secrets

Setelah menambahkan, Anda akan melihat:
- ✅ `FTP_SERVER` (nilai tersembunyi)
- ✅ `FTP_USERNAME` (nilai tersembunyi)  
- ✅ `FTP_PASSWORD` (nilai tersembunyi)

## 🚀 Test Deployment

Setelah secrets ditambahkan:
1. **Push perubahan** ke GitHub
2. **Monitor GitHub Actions**
3. **Lihat apakah workflow berhasil** (✅ hijau)

## ❌ Jika Masih Error

Jika masih error setelah menambahkan secrets:
1. **Klik workflow yang gagal**
2. **Lihat detail error** di log
3. **Periksa apakah kredensial benar**
