# Sistem Informasi Sekolah

Sistem Informasi Sekolah adalah aplikasi web berbasis Laravel yang dirancang untuk mengelola data siswa, staf, wali, dan pengguna dalam lingkungan sekolah. Aplikasi ini menggunakan Livewire untuk interaksi frontend yang dinamis dan Volt untuk komponen UI yang cepat.

## Fitur Utama

- **Manajemen Pengguna**: Sistem autentikasi dan otorisasi dengan role-based permissions menggunakan Spatie Laravel Permission.
- **Manajemen Siswa**: Kelola data siswa termasuk NIS, NISN, tahun masuk, dan informasi pribadi.
- **Manajemen Staf**: Kelola data staf sekolah.
- **Manajemen Wali**: Kelola data wali siswa.
- **Dashboard Interaktif**: Interface yang responsif menggunakan Tailwind CSS dan Alpine.js.
- **Charts dan Visualisasi**: Menggunakan ApexCharts untuk visualisasi data.
- **File Upload**: Mendukung upload file dengan FilePond.
- **Real-time Updates**: Dengan Livewire untuk pengalaman pengguna yang mulus.

## Persyaratan Sistem

- PHP ^8.2
- Composer
- Node.js & NPM
- Database (MySQL, PostgreSQL, atau SQLite)
- Laravel Framework ^12.0

## Instalasi

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan aplikasi ini di lingkungan lokal Anda.

### 1. Clone Repository

```bash
git clone https://github.com/indraydxn/school.git
cd school
```

### 2. Install Dependencies PHP

```bash
composer install
```

### 3. Install Dependencies JavaScript

```bash
npm install
```

### 4. Konfigurasi Environment

Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database serta pengaturan lainnya.

```bash
cp .env.example .env
```

Edit file `.env` untuk mengatur koneksi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=school_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Jalankan Migrasi Database

```bash
php artisan migrate
```

### 7. Seed Database (Opsional)

Untuk mengisi database dengan data contoh:

```bash
php artisan db:seed
```

Atau jalankan seeder tertentu:

```bash
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=PermissionSeeder
```

### 8. Build Assets Frontend

```bash
npm run build
```

Atau untuk development dengan hot reload:

```bash
npm run dev
```

### 9. Jalankan Aplikasi

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`.

## Penggunaan

### Akses Aplikasi

Buka browser dan akses `http://localhost:8000` untuk masuk ke aplikasi.

### Akun Default

Setelah seeding, Anda dapat login dengan akun berikut (sesuaikan dengan data seeder):

- **Admin**     : email: admin@sekolah.com, password: admin123
- **Guru**      : email: guru@sekolah.com,  password: guru123
- **Siswa**     : email: siswa@sekolah.com, password: siswa123
- **Wali Siswa**: email: wali@sekolah.com,  password: wali123

## Testing

Jalankan test menggunakan Pest:

```bash
./vendor/bin/pest
```

## Struktur Proyek Saat Ini (Dapat Berupah)

```
app/
├── Http/Controllers/          # Controller aplikasi
├── Livewire/                  # Komponen Livewire
│   ├── Auth/                  # Komponen autentikasi
│   ├── Backend/               # Komponen admin/backend
│   └── Frontend/              # Komponen frontend
├── Models/                    # Model Eloquent
│   ├── User.php              # Model User
│   ├── Siswa.php             # Model Siswa
│   ├── Staf.php              # Model Staf
│   └── Wali.php              # Model Wali
└── Providers/                 # Service Providers

database/
├── migrations/                # File migrasi database
└── seeders/                   # Data seeder

resources/
├── css/                       # Stylesheet
├── js/                        # JavaScript
└── views/                     # Template Blade

routes/
├── web.php                    # Route web
└── console.php                # Route console
```

## Teknologi yang Digunakan

- **Backend**    : Laravel 12, PHP 8.2+
- **Frontend**   : Livewire,   Volt, Alpine.js, Tailwind CSS
- **Database**   : MySQL/PostgreSQL/SQLite
- **Build Tool** : Vite
- **Testing**    : Pest
- **Permissions**: Spatie Laravel Permission

## Kontribusi

1. Fork repository ini
2. Buat branch fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## Lisensi

Proyek ini menggunakan lisensi MIT. Lihat file `LICENSE` untuk detail lebih lanjut.

## Dukungan

Jika Anda mengalami masalah atau memiliki pertanyaan, silakan buat issue di repository GitHub ini.
