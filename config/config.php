<?php
// ===== Konfigurasi Database =====
define('DB_HOST', 'localhost');
define('DB_NAME', 'sneakclean');
define('DB_USER', 'root');
define('DB_PASS', '');

// ===== URL dasar aplikasi (sesuaikan dengan nama folder di htdocs) =====
define('BASE_URL', '/sneakclean/public');

// ===== Konstanta bisnis =====
define('PAKET_LIST', ['Deep Clean', 'Fast Clean', 'Unyellowing']);
define('STATUS_LIST', ['Antre', 'Dicuci', 'Pengeringan', 'Selesai']);
define('HARGA_PAKET', [
    'Deep Clean'  => 60000,
    'Fast Clean'  => 35000,
    'Unyellowing' => 85000,
]);
