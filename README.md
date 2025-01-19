
# Sewa Mobil

Aplikasi berbasis website untuk penyewaan mobil
## Library yang di gunakan

 - [MySQL (Database)](https://www.apachefriends.org/)
 - [Laravel 10 (Framework)](https://laravel.com/)
 - [Laravel Breeze (Autentikasi)](https://github.com/laravel/breeze)
 - [Bootstrap](https://getbootstrap.com/)
 - [Font Awesome Icons](https://fontawesome.com/icons)
 - [Datatables](https://datatables.net/)
## Instalasi

Clone projek ini menggunakan SSH atau HTTPS

```bash
https://github.com/Ftaur/sewa_mobil.git
git@github.com:Ftaur/sewa_mobil.git
```
Lalu konfigurasi database di .env

```bash
DB_DATABASE=db_mobilsewa
```
Terakhir Instalasi Plugin yang dibutuhkan

```bash
  composer require laravel/breeze --dev
  php artisan breeze:install
  npm install
  php artisan migrate
```
Lalu jalankan website
```bash
php artisan serve
npm run dev
```

## Screenshots

![Database](/public/img/database/database_sewa_mobil.png)
