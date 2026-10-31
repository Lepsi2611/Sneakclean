<h1><?= $mode === 'edit' ? 'Edit Order ' . e($resi) : 'Tambah Order Baru' ?></h1>

<?php if ($errors): ?>
    <div class="alert alert-error"><ul>
        <?php foreach ($errors as $er): ?><li><?= e($er) ?></li><?php endforeach; ?>
    </ul></div>
<?php endif; ?>

<?php if (!$pelangganList): ?>
    <div class="alert alert-error">Belum ada pelanggan. <a href="<?= url('pelanggan/create') ?>">Tambah pelanggan dulu</a>.</div>
<?php endif; ?>

<form class="card form" method="post"
      action="<?= $mode === 'edit' ? url('order/update/' . $resi) : url('order/store') ?>">

    <label>Pelanggan
        <select name="id_pelanggan" required>
            <option value="">-- pilih pelanggan --</option>
            <?php foreach ($pelangganList as $p): ?>
                <option value="<?= $p['id_pelanggan'] ?>" <?= (int)$data['id_pelanggan'] === (int)$p['id_pelanggan'] ? 'selected' : '' ?>>
                    <?= e($p['nama_lengkap']) ?> (<?= e($p['no_telepon']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <div class="grid2">
        <label>Merk Sepatu
            <input type="text" name="merk_sepatu" value="<?= e($data['merk_sepatu']) ?>" required>
        </label>
        <label>Warna Sepatu
            <input type="text" name="warna_sepatu" value="<?= e($data['warna_sepatu']) ?>" required>
        </label>
    </div>

    <div class="grid2">
        <label>Paket Treatment
            <select name="paket_treatment" id="paket" required>
                <?php foreach (PAKET_LIST as $p): ?>
                    <option value="<?= e($p) ?>" data-harga="<?= HARGA_PAKET[$p] ?>"
                        <?= $data['paket_treatment'] === $p ? 'selected' : '' ?>><?= e($p) ?> - <?= rupiah(HARGA_PAKET[$p]) ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Total Biaya (Rp)
            <input type="number" name="total_biaya" id="biaya" min="0" step="1000" value="<?= e($data['total_biaya']) ?>" required>
        </label>
    </div>

    <div class="grid2">
        <label>Tanggal Masuk
            <input type="date" name="tanggal_masuk" value="<?= e($data['tanggal_masuk']) ?>" required>
        </label>
        <label>Estimasi Selesai
            <input type="date" name="estimasi_selesai" value="<?= e($data['estimasi_selesai']) ?>" required>
        </label>
    </div>

    <label>Status Pengerjaan
        <select name="status_pengerjaan">
            <?php foreach (STATUS_LIST as $s): ?>
                <option value="<?= e($s) ?>" <?= $data['status_pengerjaan'] === $s ? 'selected' : '' ?>><?= e($s) ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <div class="form-actions">
        <button class="btn" type="submit">Simpan</button>
        <a class="btn btn-ghost" href="<?= url('order') ?>">Batal</a>
    </div>
</form>

<script>
// Isi otomatis total biaya saat paket diganti
document.getElementById('paket').addEventListener('change', function () {
    document.getElementById('biaya').value = this.options[this.selectedIndex].dataset.harga;
});
</script>
