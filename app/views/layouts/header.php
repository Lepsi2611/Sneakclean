<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title ?? 'SneakClean') ?> - SneakClean</title>
    <script>document.documentElement.classList.add('js');</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Oswald:wght@400;500;600&family=Yellowtail&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= url('css/style.css') ?>">
</head>
<body class="<?= e($bodyClass ?? '') ?>">

<header class="topbar" id="topbar">
    <div class="topbar-inner">
        <button class="icon-btn" id="menuOpen" type="button" aria-label="Buka menu">
            <span></span><span></span>
        </button>
        <a class="brand" href="<?= url('home') ?>">SneakClean</a>
        <div class="topbar-right">
            <a class="btn btn-sm" href="<?= url('order/create') ?>">+ Order</a>
        </div>
    </div>
</header>

<div class="menu" id="menu" aria-hidden="true">
    <button class="menu-close" id="menuClose" type="button">Tutup &times;</button>
    <nav class="menu-nav">
        <a href="<?= url('home') ?>"><small>01</small>Beranda</a>
        <a href="<?= url('order') ?>"><small>02</small>Daftar Order</a>
        <a href="<?= url('pelanggan') ?>"><small>03</small>Pelanggan</a>
        <a href="<?= url('order/create') ?>"><small>04</small>Order Baru</a>
    </nav>
    <p class="menu-foot">SneakClean &middot; Laundry &amp; Restorasi Sepatu</p>
</div>

<main class="container">
<?php if (!empty($_SESSION['flash'])): $f = $_SESSION['flash']; unset($_SESSION['flash']); ?>
    <div class="alert alert-<?= e($f['type']) ?>"><?= e($f['msg']) ?></div>
<?php endif; ?>
