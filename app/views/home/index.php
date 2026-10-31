<?php
$paket = [
    ['no' => '01', 'nama' => 'Deep Clean', 'tone' => 1,
     'desc' => 'Pembersihan menyeluruh untuk bagian luar, midsole, insole, dan tali. Noda membandel diangkat dengan sikat halus dan cairan khusus.',
     'icon' => '<path d="M12 2.5c3.5 4.2 6 7.1 6 10.5a6 6 0 0 1-12 0c0-3.4 2.5-6.3 6-10.5z"/>'],
    ['no' => '02', 'nama' => 'Fast Clean', 'tone' => 2,
     'desc' => 'Cuci cepat untuk sepatu yang perlu tampil rapi lebih cepat. Bagian luar dan sol dibersihkan secara efisien.',
     'icon' => '<path d="M13 2 4 14h7l-1 8 9-12h-7z"/>'],
    ['no' => '03', 'nama' => 'Unyellowing', 'tone' => 3,
     'desc' => 'Mengembalikan warna putih midsole yang menguning karena oksidasi, supaya sepatu terlihat segar kembali.',
     'icon' => '<path d="M12 2l2.2 7.8L22 12l-7.8 2.2L12 22l-2.2-7.8L2 12l7.8-2.2z"/>'],
];
$langkah = [
    ['Antre',       'Sepatu diterima, dicatat, dan menunggu giliran.'],
    ['Dicuci',      'Sepatu sedang dibersihkan oleh tim kami.'],
    ['Pengeringan', 'Sepatu dikeringkan dengan benar sebelum diserahkan.'],
    ['Selesai',     'Sepatu siap diambil. Tunjukkan nomor resimu.'],
];
?>

<!-- ============ HERO ============ -->
<section class="hero" id="top">
    <div class="hero-bg"></div>

    <div class="hero-copy">
        <span class="eyebrow rise" style="--d:.1s">Laundry &amp; Restorasi Sepatu</span>
        <h1 class="hero-title">
            <span class="rise" style="--d:.25s">Sepatu bersih,</span>
            <span class="rise outline" style="--d:.45s">seperti baru lagi.</span>
        </h1>
        <p class="hero-sub rise" style="--d:.65s">Pantau status pengerjaan sepatumu kapan saja. Masukkan nomor resi dari nota, dan lihat sudah sampai tahap mana.</p>

        <form class="hero-form rise" style="--d:.85s" method="get" action="<?= url('order') ?>">
            <input type="text" name="q" placeholder="Nomor resi, mis. SC-20261104-001" autocomplete="off" required>
            <button class="btn" type="submit">Cek status</button>
        </form>
    </div>

    <div class="hero-shoe rise" style="--d:.5s" id="shoeWrap">
        <div class="shoe-tilt" id="shoeTilt">
            <svg viewBox="0 0 620 340" role="img" aria-label="Ilustrasi sepatu sneaker">
                <defs>
                    <linearGradient id="gUpper" x1="0" y1="0" x2="1" y2="1">
                        <stop offset="0" stop-color="#1c7c70"/><stop offset="1" stop-color="#0b3a35"/>
                    </linearGradient>
                    <linearGradient id="gCap" x1="0" y1="0" x2="1" y2="1">
                        <stop offset="0" stop-color="#e2b184"/><stop offset="1" stop-color="#b9774a"/>
                    </linearGradient>
                    <linearGradient id="gSole" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0" stop-color="#ffffff"/><stop offset="1" stop-color="#d9d4cc"/>
                    </linearGradient>
                </defs>
                <ellipse cx="320" cy="300" rx="260" ry="20" fill="rgba(0,0,0,.45)"/>
                <!-- sol -->
                <path d="M38 252 Q36 224 70 222 L548 222 Q598 224 596 256 Q594 280 556 282 L76 282 Q40 280 38 252Z" fill="url(#gSole)"/>
                <path d="M46 268 L588 268" stroke="#bdb6aa" stroke-width="3" fill="none"/>
                <!-- bagian atas -->
                <path d="M72 222 C70 150 112 102 176 90 L246 74 C298 62 338 94 390 116 C444 138 548 144 572 206 Q578 222 548 222Z" fill="url(#gUpper)"/>
                <!-- tumit -->
                <path d="M72 222 C70 160 92 118 134 100 L154 136 C122 158 118 190 122 222Z" fill="#082b27"/>
                <!-- ujung sepatu -->
                <path d="M430 146 C486 152 546 170 568 206 Q574 222 548 222 L440 222Z" fill="url(#gCap)"/>
                <!-- garis samping -->
                <path d="M158 204 C240 160 330 168 410 204" stroke="#e2b184" stroke-width="7" fill="none" stroke-linecap="round"/>
                <!-- lubang kaki -->
                <path d="M176 90 C196 118 238 120 258 84 C240 70 200 76 176 90Z" fill="#04100e"/>
                <!-- tali -->
                <g stroke="#f4e3d0" stroke-width="6" stroke-linecap="round">
                    <path d="M262 92 L300 126"/><path d="M290 82 L334 118"/><path d="M318 80 L368 114"/><path d="M350 88 L398 122"/>
                </g>
                <!-- kilau bersih -->
                <g fill="#fff">
                    <g transform="translate(470 120)"><path class="sp" style="animation-delay:.2s" d="M0-14L3-3 14 0 3 3 0 14-3 3-14 0-3-3Z"/></g>
                    <g transform="translate(250 150)"><path class="sp" style="animation-delay:1.1s" d="M0-10L2-2 10 0 2 2 0 10-2 2-10 0-2-2Z"/></g>
                    <g transform="translate(120 190)"><path class="sp" style="animation-delay:1.8s" d="M0-9L2-2 9 0 2 2 0 9-2 2-9 0-2-2Z"/></g>
                    <g transform="translate(520 200)"><path class="sp" style="animation-delay:.7s" d="M0-12L2.5-2.5 12 0 2.5 2.5 0 12-2.5 2.5-12 0-2.5-2.5Z"/></g>
                </g>
            </svg>
        </div>
    </div>

    <a class="scroll-hint" href="#paket"><span>Scroll</span><i></i></a>
</section>

<!-- ============ STATUS LIVE ============ -->
<section class="live reveal">
    <?php foreach ($summary as $s => $jml): ?>
        <a class="live-item" href="<?= url('order?status=' . urlencode($s)) ?>">
            <strong><?= $jml ?></strong>
            <span><?= e($s) ?></span>
        </a>
    <?php endforeach; ?>
</section>

<!-- ============ PAKET (split screen) ============ -->
<section class="split" id="paket">
    <div class="split-left">
        <div class="tone t1 on"></div><div class="tone t2"></div><div class="tone t3"></div>
        <div class="sl-content">
            <span class="sl-label">Paket Treatment</span>
            <div class="sl-num" id="slNum">01</div>
            <div class="sl-name" id="slName">Deep Clean</div>
        </div>
    </div>

    <div class="split-right">
        <?php foreach ($paket as $p): ?>
        <article class="svc reveal" data-no="<?= $p['no'] ?>" data-nama="<?= e($p['nama']) ?>" data-tone="<?= $p['tone'] ?>">
            <div class="svc-media m<?= $p['tone'] ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.2" stroke-linejoin="round"><?= $p['icon'] ?></svg>
            </div>
            <span class="svc-eyebrow">Paket <?= $p['no'] ?></span>
            <h2><?= e($p['nama']) ?></h2>
            <p><?= e($p['desc']) ?></p>
            <div class="svc-price">Mulai <?= rupiah(HARGA_PAKET[$p['nama']]) ?></div>
            <div class="svc-glyph">&middot; &middot; &middot;</div>
        </article>
        <?php endforeach; ?>
        <div class="svc-cta reveal">
            <a class="btn btn-dark" href="<?= url('order/create') ?>">Buat order baru</a>
        </div>
    </div>
</section>

<!-- ============ LACAK ============ -->
<section class="track">
    <div class="track-head reveal">
        <span class="eyebrow">Transparan &amp; mudah dilacak</span>
        <h2>Empat tahap<br>sampai sepatu siap diambil</h2>
    </div>
    <div class="track-grid">
        <?php foreach ($langkah as $i => $l): ?>
        <div class="track-step reveal" style="--i:<?= $i ?>">
            <span class="ts-no">0<?= $i + 1 ?></span>
            <h3><?= e($l[0]) ?></h3>
            <p><?= e($l[1]) ?></p>
            <span class="<?= statusClass($l[0]) ?>"><?= (int)$summary[$l[0]] ?> sepatu</span>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="track-cta reveal">
        <a class="btn" href="#top">Cek nomor resi</a>
        <a class="btn btn-ghost" href="<?= url('order') ?>">Lihat semua order</a>
    </div>
</section>

<script>
(function () {
    /* Efek miring sepatu mengikuti kursor */
    var wrap = document.getElementById('shoeWrap');
    var tilt = document.getElementById('shoeTilt');
    if (wrap && window.matchMedia('(pointer:fine)').matches) {
        wrap.addEventListener('mousemove', function (e) {
            var r = wrap.getBoundingClientRect();
            var x = (e.clientX - r.left) / r.width - 0.5;
            var y = (e.clientY - r.top) / r.height - 0.5;
            tilt.style.setProperty('--ry', (x * 14) + 'deg');
            tilt.style.setProperty('--rx', (-y * 10) + 'deg');
        });
        wrap.addEventListener('mouseleave', function () {
            tilt.style.setProperty('--ry', '0deg');
            tilt.style.setProperty('--rx', '0deg');
        });
    }

    /* Panel kiri berganti mengikuti paket yang sedang terlihat */
    var num = document.getElementById('slNum');
    var name = document.getElementById('slName');
    var tones = document.querySelectorAll('.tone');
    var cards = document.querySelectorAll('.svc');
    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (en) {
                if (!en.isIntersecting) return;
                var d = en.target.dataset;
                num.textContent = d.no;
                name.textContent = d.nama;
                tones.forEach(function (t, i) { t.classList.toggle('on', (i + 1) === Number(d.tone)); });
            });
        }, { rootMargin: '-42% 0px -42% 0px' });
        cards.forEach(function (c) { io.observe(c); });
    }
})();
</script>
