<?php
function e($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

function rupiah($n) { return 'Rp ' . number_format((float)$n, 0, ',', '.'); }

function tanggal($d) {
    if (!$d) return '-';
    return date('d M Y', strtotime($d));
}

function url($path = '') { return BASE_URL . '/' . ltrim($path, '/'); }

// Ubah 0812xxx menjadi link WhatsApp 62812xxx
function waLink($no) {
    $n = preg_replace('/\D/', '', $no);
    if (strpos($n, '0') === 0) $n = '62' . substr($n, 1);
    return 'https://wa.me/' . $n;
}

function statusClass($s) {
    return 'badge badge-' . strtolower($s);
}
