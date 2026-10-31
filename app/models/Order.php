<?php
class Order
{
    private $db;

    public function __construct() { $this->db = Database::conn(); }

    private function baseSelect()
    {
        return 'SELECT o.*, p.nama_lengkap, p.no_telepon, p.alamat
                FROM order_laundry o
                JOIN pelanggan p ON p.id_pelanggan = o.id_pelanggan';
    }

    // Daftar order; $q = pencarian no resi (sebagian atau penuh), $status = filter status
    public function all($q = '', $status = '')
    {
        $sql    = $this->baseSelect() . ' WHERE 1=1';
        $params = [];

        if ($q !== '') {
            $sql .= ' AND o.no_resi LIKE ?';
            $params[] = '%' . $q . '%';
        }
        if ($status !== '' && in_array($status, STATUS_LIST, true)) {
            $sql .= ' AND o.status_pengerjaan = ?';
            $params[] = $status;
        }
        $sql .= ' ORDER BY o.created_at DESC, o.no_resi DESC';

        $st = $this->db->prepare($sql);
        $st->execute($params);
        return $st->fetchAll();
    }

    public function find($resi)
    {
        $st = $this->db->prepare($this->baseSelect() . ' WHERE o.no_resi = ?');
        $st->execute([$resi]);
        return $st->fetch();
    }

    // Format: SC-YYYYMMDD-001, nomor urut naik per hari
    public function generateResi()
    {
        $prefix = 'SC-' . date('Ymd') . '-';
        $st = $this->db->prepare('SELECT MAX(no_resi) FROM order_laundry WHERE no_resi LIKE ?');
        $st->execute([$prefix . '%']);
        $last = $st->fetchColumn();
        $next = $last ? ((int)substr($last, -3)) + 1 : 1;
        return $prefix . str_pad($next, 3, '0', STR_PAD_LEFT);
    }

    public function create($d)
    {
        $resi = $this->generateResi();
        $st = $this->db->prepare(
            'INSERT INTO order_laundry
             (no_resi, id_pelanggan, merk_sepatu, warna_sepatu, paket_treatment,
              tanggal_masuk, estimasi_selesai, total_biaya, status_pengerjaan)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)'
        );
        $st->execute([
            $resi, $d['id_pelanggan'], $d['merk_sepatu'], $d['warna_sepatu'],
            $d['paket_treatment'], $d['tanggal_masuk'], $d['estimasi_selesai'],
            $d['total_biaya'], $d['status_pengerjaan'],
        ]);
        return $resi;
    }

    public function update($resi, $d)
    {
        $st = $this->db->prepare(
            'UPDATE order_laundry SET id_pelanggan = ?, merk_sepatu = ?, warna_sepatu = ?,
             paket_treatment = ?, tanggal_masuk = ?, estimasi_selesai = ?,
             total_biaya = ?, status_pengerjaan = ?
             WHERE no_resi = ?'
        );
        return $st->execute([
            $d['id_pelanggan'], $d['merk_sepatu'], $d['warna_sepatu'],
            $d['paket_treatment'], $d['tanggal_masuk'], $d['estimasi_selesai'],
            $d['total_biaya'], $d['status_pengerjaan'], $resi,
        ]);
    }

    public function updateStatus($resi, $status)
    {
        $st = $this->db->prepare('UPDATE order_laundry SET status_pengerjaan = ? WHERE no_resi = ?');
        return $st->execute([$status, $resi]);
    }

    public function delete($resi)
    {
        $st = $this->db->prepare('DELETE FROM order_laundry WHERE no_resi = ?');
        return $st->execute([$resi]);
    }

    // Order terbaru untuk kartu di beranda
    public function recent($limit = 24)
    {
        $limit = (int)$limit;
        return $this->db->query(
            $this->baseSelect() . ' ORDER BY o.created_at DESC, o.no_resi DESC LIMIT ' . $limit
        )->fetchAll();
    }

    public function countByStatus()
    {
        $rows = $this->db->query(
            'SELECT status_pengerjaan, COUNT(*) AS jml FROM order_laundry GROUP BY status_pengerjaan'
        )->fetchAll();
        $out = array_fill_keys(STATUS_LIST, 0);
        foreach ($rows as $r) $out[$r['status_pengerjaan']] = (int)$r['jml'];
        return $out;
    }
}
