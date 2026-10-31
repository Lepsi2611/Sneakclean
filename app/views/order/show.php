<?php
$steps   = STATUS_LIST;
$current = array_search($order['status_pengerjaan'], $steps, true);
?>
<div class="page-head">
    <h1>Detail Order <span class="resi"><?= e($order['no_resi']) ?></span></h1>
    <div>
        <a class="btn btn-ghost" href="<?= url('order') ?>">&larr; Kembali</a>
        <a class="btn" href="<?= url('order/edit/' . $order['no_resi']) ?>">Edit</a>
    </div>
</div>

<div class="card">
    <h3>Progres Pengerjaan</h3>
    <ol class="steps">
        <?php foreach ($steps as $i => $s): ?>
            <li class="<?= $i < $current ? 'done' : ($i === $current ? 'active' : '') ?>"><?= e($s) ?></li>
        <?php endforeach; ?>
    </ol>

    <form class="inline-form" method="post" action="<?= url('order/status/' . $order['no_resi']) ?>">
        <label>Ubah status:
            <select name="status_pengerjaan">
                <?php foreach ($steps as $s): ?>
                    <option value="<?= e($s) ?>" <?= $order['status_pengerjaan'] === $s ? 'selected' : '' ?>><?= e($s) ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <button class="btn" type="submit">Update</button>
    </form>
</div>

<div class="grid2">
    <div class="card">
        <h3>Data Sepatu &amp; Layanan</h3>
        <dl class="detail">
            <dt>Merk</dt><dd><?= e($order['merk_sepatu']) ?></dd>
            <dt>Warna</dt><dd><?= e($order['warna_sepatu']) ?></dd>
            <dt>Paket</dt><dd><?= e($order['paket_treatment']) ?></dd>
            <dt>Tanggal Masuk</dt><dd><?= tanggal($order['tanggal_masuk']) ?></dd>
            <dt>Estimasi Selesai</dt><dd><?= tanggal($order['estimasi_selesai']) ?></dd>
            <dt>Total Biaya</dt><dd><strong><?= rupiah($order['total_biaya']) ?></strong></dd>
            <dt>Status</dt><dd><span class="<?= statusClass($order['status_pengerjaan']) ?>"><?= e($order['status_pengerjaan']) ?></span></dd>
        </dl>
    </div>

    <div class="card">
        <h3>Data Pelanggan</h3>
        <dl class="detail">
            <dt>Nama</dt><dd><?= e($order['nama_lengkap']) ?></dd>
            <dt>WhatsApp/Telp</dt>
            <dd><?= e($order['no_telepon']) ?>
                <a class="btn btn-sm btn-wa" target="_blank" rel="noopener" href="<?= e(waLink($order['no_telepon'])) ?>">Chat WA</a></dd>
            <dt>Alamat</dt><dd><?= nl2br(e($order['alamat'])) ?></dd>
        </dl>
    </div>
</div>
