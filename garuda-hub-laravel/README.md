# Garuda-Hub (Laravel)

Refactoring Garuda-Hub dari PHP Native ke Laravel (MVC + Eloquent).

## Menjalankan
1. `composer install`
2. `copy .env.example .env` lalu atur database MySQL (`DB_DATABASE=garuda_hub_laravel`)
3. `php artisan key:generate`
4. `php artisan migrate:fresh --seed`
5. `php artisan serve`

## Akun dummy (password: `password`)
- Admin: admin@example.com
- Klien: budi@example.com, siti@example.com, agus@example.com
- Developer: dewi@example.com, eko@example.com, fitri@example.com, gilang@example.com

## Fitur
Daftar/login berperan, pasang proyek, cari proyek, penawaran (bid), pilih pemenang, dasbor, dan panel admin.
