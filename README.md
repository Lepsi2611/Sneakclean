# SneakClean - Sistem Antrean & Layanan Laundry Sepatu
PHP Native MVC + MySQL.

## Instalasi (XAMPP / Laragon)
1. Taruh folder `sneakclean` di `htdocs` (XAMPP) atau `www` (Laragon).
2. Aktifkan Apache + MySQL, lalu import `database.sql` lewat phpMyAdmin.
3. Cek `config/config.php` (user/password DB dan BASE_URL).
4. Aktifkan `mod_rewrite` Apache (XAMPP: sudah aktif; AllowOverride harus All).
5. Buka: http://localhost/sneakclean/public

## Route
| URL | Fungsi |
|---|---|
| /order | daftar + cari resi + filter status |
| /order/create, /order/store | tambah order |
| /order/show/{resi} | detail + ubah status |
| /order/edit/{resi}, /order/update/{resi} | edit order |
| /order/status/{resi} | update status pengerjaan |
| /order/destroy/{resi} | hapus order |
| /pelanggan, /create, /edit/{id}, /destroy/{id} | CRUD pelanggan |
