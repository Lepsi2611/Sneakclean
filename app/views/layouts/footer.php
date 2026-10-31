</main>
<footer class="footer">
    <a class="footer-brand" href="<?= url('home') ?>">SneakClean</a>
    <p>Laundry &amp; restorasi sepatu. Pantau pengerjaan sepatumu dengan nomor resi.</p>
    <nav>
        <a href="<?= url('order') ?>">Order</a>
        <a href="<?= url('pelanggan') ?>">Pelanggan</a>
        <a href="<?= url('order/create') ?>">Order Baru</a>
    </nav>
</footer>

<script>
(function () {
    var m = document.getElementById('menu');
    var openBtn = document.getElementById('menuOpen');
    var closeBtn = document.getElementById('menuClose');
    function setMenu(v) {
        m.classList.toggle('open', v);
        document.body.classList.toggle('lock', v);
        m.setAttribute('aria-hidden', v ? 'false' : 'true');
    }
    openBtn.addEventListener('click', function () { setMenu(true); });
    closeBtn.addEventListener('click', function () { setMenu(false); });
    m.addEventListener('click', function (e) { if (e.target.tagName === 'A' || e.target.closest('a')) setMenu(false); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') setMenu(false); });

    var bar = document.getElementById('topbar');
    function onScroll() { bar.classList.toggle('scrolled', window.scrollY > 40); }
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });

    var items = document.querySelectorAll('.reveal');
    if (!('IntersectionObserver' in window)) {
        items.forEach(function (el) { el.classList.add('in'); });
        return;
    }
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (en) {
            if (en.isIntersecting) { en.target.classList.add('in'); io.unobserve(en.target); }
        });
    }, { threshold: 0.15 });
    items.forEach(function (el) { io.observe(el); });
})();
</script>
</body>
</html>
