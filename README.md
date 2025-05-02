# Laravel API Blueray Cargo Project

Proyek ini adalah API berbasis Laravel yang menggunakan **Laravel Sanctum** untuk autentikasi dan terintegrasi dengan **Bitership API**.

## 🔧 Persyaratan Sistem

- PHP >= 8.1  
- Composer  
- PostgreSQL
- Laravel 10+

## 🚀 Instalasi

Ikuti langkah-langkah berikut untuk mengatur proyek setelah di-*clone*:

### 1. Clone Repository

```bash
git clone https://github.com/username/nama-project.git
cd nama-project

composer install

cp .env.example .env

# Pengaturan .env
# Atur koneksi db dengan postegresql

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

# Atur pengaturan Bitership API dengan credential kamu

BITESHIP_BASE_URL=
BITESHIP_API_KEY=

# Jalankan

php artisan key:generate

# Jalankan migration

php artisan migrate --seed

# Jalankan localhost

php artisan serve --host=localhost --port=8000 
# Usahakan menjalankan localhost seperti ini untuk menghindari CORS

#account default
#admin
#email: admin@email.com
#password: admin12345 

#user
#email: user@email.com
#password: user12345 
