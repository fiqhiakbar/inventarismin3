# 🔐 Kredensial Login Default Website

## 📋 Informasi Login

Setelah menjalankan `php artisan migrate:fresh --seed`, database telah diisi dengan data default termasuk user untuk login.

## 👤 User Default yang Tersedia

### 1. Administrator
- **Email**: `admin@mail.com`
- **Password**: `secret`
- **Role**: Administrator
- **Akses**: Full access ke semua fitur

### 2. Staff TU (Tata Usaha)
- **Email**: `stafftu@mail.com`
- **Password**: `secret`
- **Role**: Staff
- **Akses**: Akses terbatas sesuai role

## 🚀 Cara Login

### Via Web Interface
1. Buka browser dan akses: `http://localhost:8000/login` (untuk development)
2. Masukkan email dan password salah satu user di atas
3. Klik tombol "Login"

### Via API (jika menggunakan API)
```bash
# Login via API
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@mail.com",
    "password": "secret"
  }'
```

## 🔧 Cara Menjalankan Seeder

### Jika Database Kosong
```bash
php artisan migrate:fresh --seed
```

### Jika Database Sudah Ada Data
```bash
# Hapus data lama dan jalankan seeder
php artisan migrate:fresh --seed

# Atau jalankan seeder tertentu
php artisan db:seed --class=UserSeeder
```

### Untuk Production (RumahWeb)
```bash
# Via SSH ke server
cd /home/username/public_html
php artisan migrate:fresh --seed --force
```

## 📊 Data yang Di-generate

### Users
- ✅ 2 user default (Admin + Staff TU)

### Roles & Permissions
- ✅ Role Administrator
- ✅ Role Staff
- ✅ Permissions untuk semua fitur

### Data Sample
- ✅ Lokasi barang (25 lokasi)
- ✅ Bantuan Operasional Sekolah (2 data)
- ✅ Barang inventaris (19 item sample)
- ✅ Peminjaman barang (sample data)

## 🔐 Keamanan

### ⚠️ PENTING: Ganti Password Default!
Setelah login pertama kali, **SEGERA GANTI PASSWORD** untuk keamanan:

1. Login sebagai admin
2. Buka menu Profile/Settings
3. Ganti password dengan password yang kuat
4. Lakukan hal yang sama untuk user staff

### Password yang Direkomendasikan
- Minimal 8 karakter
- Kombinasi huruf besar, kecil, angka, dan simbol
- Contoh: `Admin@2024!`, `StaffTU#2024`

## 🚨 Troubleshooting

### Error "User not found"
```bash
# Jalankan ulang seeder
php artisan db:seed --class=UserSeeder
```

### Error "Duplicate entry"
```bash
# Refresh database dan jalankan seeder
php artisan migrate:fresh --seed
```

### Lupa Password
```bash
# Reset password via tinker
php artisan tinker
>>> $user = App\User::where('email', 'admin@mail.com')->first();
>>> $user->password = bcrypt('password_baru');
>>> $user->save();
>>> exit
```

## 📞 Support

Jika mengalami masalah dengan login:
1. Cek koneksi database
2. Pastikan seeder sudah dijalankan
3. Cek error log di `storage/logs/laravel.log`
4. Hubungi administrator sistem

---

**Catatan**: Kredensial ini hanya untuk development/testing. Untuk production, pastikan untuk mengganti password default dengan password yang kuat!
