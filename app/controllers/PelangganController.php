<?php
class PelangganController extends Controller
{
    private $model;

    public function __construct() { $this->model = new Pelanggan(); }

    public function index()
    {
        $this->view('pelanggan/index', [
            'title' => 'Data Pelanggan',
            'list'  => $this->model->all(),
        ]);
    }

    public function create()
    {
        $this->view('pelanggan/form', [
            'title' => 'Tambah Pelanggan', 'mode' => 'create', 'errors' => [],
            'data'  => ['nama_lengkap' => '', 'no_telepon' => '', 'alamat' => ''],
        ]);
    }

    public function store()
    {
        $this->requirePost();
        $data   = $this->input();
        $errors = $this->validate($data);
        if ($errors) {
            return $this->view('pelanggan/form', [
                'title' => 'Tambah Pelanggan', 'mode' => 'create', 'errors' => $errors, 'data' => $data,
            ]);
        }
        $this->model->create($data);
        $this->flash('success', 'Pelanggan berhasil ditambahkan.');
        $this->redirect('pelanggan');
    }

    public function edit($id = 0)
    {
        $row = $this->model->find((int)$id);
        if (!$row) { $this->flash('error', 'Pelanggan tidak ditemukan.'); $this->redirect('pelanggan'); }
        $this->view('pelanggan/form', [
            'title' => 'Edit Pelanggan', 'mode' => 'edit', 'errors' => [], 'id' => (int)$id, 'data' => $row,
        ]);
    }

    public function update($id = 0)
    {
        $this->requirePost();
        $id = (int)$id;
        if (!$this->model->find($id)) { $this->flash('error', 'Pelanggan tidak ditemukan.'); $this->redirect('pelanggan'); }

        $data   = $this->input();
        $errors = $this->validate($data, $id);
        if ($errors) {
            return $this->view('pelanggan/form', [
                'title' => 'Edit Pelanggan', 'mode' => 'edit', 'errors' => $errors, 'id' => $id, 'data' => $data,
            ]);
        }
        $this->model->update($id, $data);
        $this->flash('success', 'Data pelanggan diperbarui.');
        $this->redirect('pelanggan');
    }

    public function destroy($id = 0)
    {
        $this->requirePost();
        try {
            $this->model->delete((int)$id);
            $this->flash('success', 'Pelanggan dihapus.');
        } catch (PDOException $e) {
            // Gagal karena masih punya order (foreign key RESTRICT)
            $this->flash('error', 'Pelanggan tidak bisa dihapus karena masih memiliki order.');
        }
        $this->redirect('pelanggan');
    }

    private function input()
    {
        return [
            'nama_lengkap' => trim($_POST['nama_lengkap'] ?? ''),
            'no_telepon'   => trim($_POST['no_telepon'] ?? ''),
            'alamat'       => trim($_POST['alamat'] ?? ''),
        ];
    }

    private function validate($d, $exceptId = 0)
    {
        $err = [];
        if ($d['nama_lengkap'] === '') $err[] = 'Nama lengkap wajib diisi.';
        if (!preg_match('/^[0-9+\-\s]{8,20}$/', $d['no_telepon'])) $err[] = 'Nomor telepon tidak valid (8-20 digit).';
        elseif ($this->model->teleponExists($d['no_telepon'], $exceptId)) $err[] = 'Nomor telepon sudah terdaftar.';
        if ($d['alamat'] === '') $err[] = 'Alamat wajib diisi.';
        return $err;
    }
}
