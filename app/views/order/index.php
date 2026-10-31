<h1>Daftar Order Laundry</h1>

<div class="stats">
    <?php foreach ($summary as $s => $jml): ?>
        <a class="stat" href="<?= url('order?status=' . urlencode($s)) ?>">
            <span class="stat-num"><?= $jml ?></span>
            <span class="<?= statusClass($s) ?>"><?= e($s) ?></span>
        </a>
    <?php endforeach; ?>
</div>

<form class="search" method="get" action="<?= url('order') ?>">
    <input type="text" name="q" value="<?= e($q) ?>" placeholder="Cari nomor resi, mis. SC-20261104-001">
    <select name="status">
        <option value="">Semua status</option>
        <?php foreach (STATUS_LIST as $s): ?>
            <option value="<?= e($s) ?>" <?= $status === $s ? 'selected' : '' ?>><?= e($s) ?></option>
        <?php endforeach; ?>
    </select>
    <button class="btn" type="submit">Cari</button>
    <?php if ($q !== '' || $status !== ''): ?><a class="btn btn-ghost" href="<?= url('order') ?>">Reset</a><?php endif; ?>
</form>

<div class="card table-wrap">
<table>
    <thead>
        <tr>
            <th>No. Resi</th><th>Pelanggan</th><th>Sepatu</th><th>Paket</th>
            <th>Estimasi</th><th>Biaya</th><th>Status</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!$orders): ?>
        <tr><td colspan="8" class="empty">Belum ada data order.</td></tr>
    <?php endif; ?>
    <?php foreach ($orders as $o): ?>
        <tr>
            <td><a href="<?= url('order/show/' . $o['no_resi']) ?>"><strong><?= e($o['no_resi']) ?></strong></a></td>
            <td><?= e($o['nama_lengkap']) ?></td>
            <td><?= e($o['merk_sepatu']) ?><br><small><?= e($o['warna_sepatu']) ?></small></td>
            <td><?= e($o['paket_treatment']) ?></td>
            <td><?= tanggal($o['estimasi_selesai']) ?></td>
            <td><?= rupiah($o['total_biaya']) ?></td>
            <td><span class="<?= statusClass($o['status_pengerjaan']) ?>"><?= e($o['status_pengerjaan']) ?></span></td>
            <td class="actions">
                <a class="btn btn-sm btn-ghost" href="<?= url('order/show/' . $o['no_resi']) ?>">Detail</a>
                <a class="btn btn-sm btn-ghost" href="<?= url('order/edit/' . $o['no_resi']) ?>">Edit</a>
                <form method="post" action="<?= url('order/destroy/' . $o['no_resi']) ?>"
                      onsubmit="return confirm('Hapus order <?= e($o['no_resi']) ?>?')">
                    <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
