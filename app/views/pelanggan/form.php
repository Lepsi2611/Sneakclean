<h1><?= $mode === 'edit' ? 'Edit Pelanggan' : 'Tambah Pelanggan' ?></h1>

<?php if ($errors): ?>
    <div class="alert alert-error"><ul>
        <?php foreach ($errors as $er): ?><li><?= e($er) ?></li><?php endforeach; ?>
    </ul></div>
<?php endif; ?>

<form class="card form" method="post"
      action="<?= $mode === 'edit' ? url('pelanggan/update/' . $id) : url('pelanggan/store') ?>">
    <label>Nama Lengkap
        <input type="text" name="nama_lengkap" value="<?= e($data['nama_lengkap']) ?>" required>
    </label>
    <label>Nomor WhatsApp/Telepon
        <input type="text" name="no_telepon" value="<?= e($data['no_telepon']) ?>" placeholder="08xxxxxxxxxx" required>
    </label>
    <label>Alamat
        <textarea name="alamat" rows="3" required><?= e($data['alamat']) ?></textarea>
    </label>
    <div class="form-actions">
        <button class="btn" type="submit">Simpan</button>
        <a class="btn btn-ghost" href="<?= url('pelanggan') ?>">Batal</a>
    </div>
</form>
