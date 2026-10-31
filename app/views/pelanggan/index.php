<div class="page-head">
    <h1>Data Pelanggan</h1>
    <a class="btn" href="<?= url('pelanggan/create') ?>">+ Tambah Pelanggan</a>
</div>

<div class="card table-wrap">
<table>
    <thead><tr><th>ID</th><th>Nama</th><th>WhatsApp/Telp</th><th>Alamat</th><th>Aksi</th></tr></thead>
    <tbody>
    <?php if (!$list): ?><tr><td colspan="5" class="empty">Belum ada pelanggan.</td></tr><?php endif; ?>
    <?php foreach ($list as $p): ?>
        <tr>
            <td><?= $p['id_pelanggan'] ?></td>
            <td><?= e($p['nama_lengkap']) ?></td>
            <td><?= e($p['no_telepon']) ?></td>
            <td><?= e($p['alamat']) ?></td>
            <td class="actions">
                <a class="btn btn-sm" href="<?= url('order/create?pelanggan=' . $p['id_pelanggan']) ?>">+ Order</a>
                <a class="btn btn-sm btn-ghost" href="<?= url('pelanggan/edit/' . $p['id_pelanggan']) ?>">Edit</a>
                <form method="post" action="<?= url('pelanggan/destroy/' . $p['id_pelanggan']) ?>"
                      onsubmit="return confirm('Hapus pelanggan <?= e($p['nama_lengkap']) ?>?')">
                    <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
