# 🚀 Panduan Hosting Website Laravel ke RumahWeb

## 📋 Persiapan Sebelum Upload

### 1. Persyaratan Hosting RumahWeb
- **PHP Version**: 8.1 atau lebih tinggi (sesuai composer.json)
- **Database**: MySQL/MariaDB
- **Web Server**: Apache/Nginx
- **SSL Certificate**: Untuk keamanan

### 2. File yang Sudah Disiapkan
- ✅ `inventarismin3-for-rumahweb.zip` (54MB) - File utama website
- ✅ `inventarissekolahku.sql` (367KB) - Database structure dan data

## 🔧 Langkah-langkah Upload ke RumahWeb

### Langkah 1: Login ke cPanel RumahWeb
1. Buka browser dan akses: `https://yourdomain.com/cpanel`
2. Login dengan username dan password yang diberikan RumahWeb
3. Pastikan Anda memiliki akses ke File Manager dan phpMyAdmin

### Langkah 2: Upload File Website
1. **Buka File Manager** di cPanel
2. **Pilih folder public_html** (atau folder yang ditentukan untuk website)
3. **Upload file `inventarismin3-for-rumahweb.zip`**
4. **Extract file ZIP** di server
5. **Pindahkan semua file** dari folder hasil extract ke root folder website

### Langkah 3: Import Database
1. **Buka phpMyAdmin** di cPanel
2. **Buat database baru** dengan nama: `inventarissekolahku`
3. **Import file `inventarissekolahku.sql`** ke database tersebut
4. **Catat informasi database**:
   - Database Name: `inventarissekolahku`
   - Username: (sesuai yang dibuat)
   - Password: (sesuai yang dibuat)
   - Host: `localhost`

### Langkah 4: Konfigurasi Environment
1. **Buat file `.env`** di root folder website
2. **Copy isi berikut** ke file `.env`:

```env
APP_NAME="Sistem Inventaris Sekolah"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://yourdomain.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=inventarissekolahku
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_APP_HOST}"
VITE_PUSHER_PORT="${PUSHER_APP_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_APP_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

### Langkah 5: Generate Application Key
1. **Buka Terminal/SSH** di cPanel (jika tersedia)
2. **Jalankan perintah**:
```bash
cd /home/username/public_html
php artisan key:generate
```

### Langkah 6: Set Permission Folder
1. **Set permission folder storage**:
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

2. **Atau melalui File Manager**:
   - Klik kanan folder `storage` → Change Permissions → 755
   - Klik kanan folder `bootstrap/cache` → Change Permissions → 755

### Langkah 7: Konfigurasi Web Server

#### Untuk Apache (.htaccess sudah ada):
File `.htaccess` sudah tersedia di folder `public/`

#### Untuk Nginx (jika menggunakan):
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /home/username/public_html/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## 🔐 Keamanan Website

### 1. SSL Certificate
- Aktifkan SSL di cPanel untuk domain Anda
- Pastikan semua URL menggunakan HTTPS

### 2. File .env
- Pastikan file `.env` tidak bisa diakses publik
- Set permission file `.env` ke 644

### 3. Backup Regular
- Backup database secara berkala
- Backup file website secara berkala

## 🚀 Akses Website

### URL Website:
- **Frontend**: `https://yourdomain.com`
- **Admin Panel**: `https://yourdomain.com/login`

### Default Login (jika ada):
- **Username**: admin
- **Password**: password
- **Atau cek file seeder untuk kredensial default**

## 📞 Troubleshooting

### Error 500 Internal Server Error:
1. Cek file `.env` sudah benar
2. Cek permission folder `storage` dan `bootstrap/cache`
3. Cek error log di cPanel

### Database Connection Error:
1. Cek konfigurasi database di `.env`
2. Pastikan database sudah dibuat dan diimport
3. Cek username dan password database

### File Not Found Error:
1. Pastikan semua file sudah diupload dengan benar
2. Cek struktur folder di server
3. Pastikan `.htaccess` ada di folder `public`

## 📧 Support

Jika mengalami masalah, hubungi:
- **RumahWeb Support**: support@rumahweb.com
- **Technical Support**: 021-XXXXXXXX

---

**Catatan**: Pastikan untuk mengganti `yourdomain.com`, `your_database_username`, dan `your_database_password` dengan informasi yang sesuai dengan hosting Anda.
