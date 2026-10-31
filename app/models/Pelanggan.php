<?php
class Pelanggan
{
    private $db;

    public function __construct() { $this->db = Database::conn(); }

    public function all()
    {
        return $this->db->query('SELECT * FROM pelanggan ORDER BY nama_lengkap ASC')->fetchAll();
    }

    public function find($id)
    {
        $st = $this->db->prepare('SELECT * FROM pelanggan WHERE id_pelanggan = ?');
        $st->execute([$id]);
        return $st->fetch();
    }

    public function create($d)
    {
        $st = $this->db->prepare(
            'INSERT INTO pelanggan (nama_lengkap, no_telepon, alamat) VALUES (?, ?, ?)'
        );
        return $st->execute([$d['nama_lengkap'], $d['no_telepon'], $d['alamat']]);
    }

    public function update($id, $d)
    {
        $st = $this->db->prepare(
            'UPDATE pelanggan SET nama_lengkap = ?, no_telepon = ?, alamat = ? WHERE id_pelanggan = ?'
        );
        return $st->execute([$d['nama_lengkap'], $d['no_telepon'], $d['alamat'], $id]);
    }

    public function delete($id)
    {
        $st = $this->db->prepare('DELETE FROM pelanggan WHERE id_pelanggan = ?');
        return $st->execute([$id]);
    }

    public function teleponExists($telp, $exceptId = 0)
    {
        $st = $this->db->prepare(
            'SELECT COUNT(*) FROM pelanggan WHERE no_telepon = ? AND id_pelanggan <> ?'
        );
        $st->execute([$telp, $exceptId]);
        return $st->fetchColumn() > 0;
    }
}
