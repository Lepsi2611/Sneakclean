<?php
class OrderController extends Controller
{
    private $order;
    private $pelanggan;

    public function __construct()
    {
        $this->order     = new Order();
        $this->pelanggan = new Pelanggan();
    }

    // GET /order?q=...&status=...
    public function index()
    {
        $q      = trim($_GET['q'] ?? '');
        $status = trim($_GET['status'] ?? '');

        // Cari dari beranda: kalau nomor resi cocok persis, langsung buka detailnya
        if ($q !== '' && $status === '' && $this->order->find($q)) {
            $this->redirect('order/show/' . rawurlencode($q));
        }

        $this->view('order/index', [
            'title'   => 'Daftar Order',
            'orders'  => $this->order->all($q, $status),
            'q'       => $q,
            'status'  => $status,
            'summary' => $this->order->countByStatus(),
        ]);
    }

    // GET /order/create
    public function create()
    {
        $this->view('order/form', [
            'title'     => 'Tambah Order',
            'mode'      => 'create',
            'errors'    => [],
            'pelangganList' => $this->pelanggan->all(),
            'data'      => [
                'id_pelanggan' => $_GET['pelanggan'] ?? '',
                'merk_sepatu' => '', 'warna_sepatu' => '',
                'paket_treatment' => 'Deep Clean',
                'tanggal_masuk' => date('Y-m-d'),
                'estimasi_selesai' => date('Y-m-d', strtotime('+3 days')),
                'total_biaya' => HARGA_PAKET['Deep Clean'],
                'status_pengerjaan' => 'Antre',
            ],
        ]);
    }

    // POST /order/store
    public function store()
    {
        $this->requirePost();
        $data   = $this->input();
        $errors = $this->validate($data);

        if ($errors) {
            return $this->view('order/form', [
                'title' => 'Tambah Order', 'mode' => 'create', 'errors' => $errors,
                'pelangganList' => $this->pelanggan->all(), 'data' => $data,
            ]);
        }
        $resi = $this->order->create($data);
        $this->flash('success', "Order berhasil dibuat. No. resi: $resi");
        $this->redirect('order/show/' . $resi);
    }

    // GET /order/show/{resi}
    public function show($resi = '')
    {
        $order = $this->order->find($resi);
        if (!$order) return $this->notFound();
        $this->view('order/show', ['title' => 'Detail ' . $resi, 'order' => $order]);
    }

    // GET /order/edit/{resi}
    public function edit($resi = '')
    {
        $order = $this->order->find($resi);
        if (!$order) return $this->notFound();
        $this->view('order/form', [
            'title' => 'Edit Order', 'mode' => 'edit', 'errors' => [],
            'resi' => $resi, 'pelangganList' => $this->pelanggan->all(), 'data' => $order,
        ]);
    }

    // POST /order/update/{resi}
    public function update($resi = '')
    {
        $this->requirePost();
        if (!$this->order->find($resi)) return $this->notFound();

        $data   = $this->input();
        $errors = $this->validate($data);
        if ($errors) {
            return $this->view('order/form', [
                'title' => 'Edit Order', 'mode' => 'edit', 'errors' => $errors,
                'resi' => $resi, 'pelangganList' => $this->pelanggan->all(), 'data' => $data,
            ]);
        }
        $this->order->update($resi, $data);
        $this->flash('success', 'Order berhasil diperbarui.');
        $this->redirect('order/show/' . $resi);
    }

    // POST /order/status/{resi}  -> ubah status pengerjaan saja
    public function status($resi = '')
    {
        $this->requirePost();
        $status = $_POST['status_pengerjaan'] ?? '';
        if (!$this->order->find($resi)) return $this->notFound();

        if (!in_array($status, STATUS_LIST, true)) {
            $this->flash('error', 'Status tidak valid.');
        } else {
            $this->order->updateStatus($resi, $status);
            $this->flash('success', "Status diubah menjadi $status.");
        }
        $this->redirect('order/show/' . $resi);
    }

    // POST /order/destroy/{resi}
    public function destroy($resi = '')
    {
        $this->requirePost();
        $this->order->delete($resi);
        $this->flash('success', 'Order berhasil dihapus.');
        $this->redirect('order');
    }

    // ---------- helper privat ----------
    private function input()
    {
        $paket = $_POST['paket_treatment'] ?? '';
        return [
            'id_pelanggan'      => (int)($_POST['id_pelanggan'] ?? 0),
            'merk_sepatu'       => trim($_POST['merk_sepatu'] ?? ''),
            'warna_sepatu'      => trim($_POST['warna_sepatu'] ?? ''),
            'paket_treatment'   => $paket,
            'tanggal_masuk'     => trim($_POST['tanggal_masuk'] ?? ''),
            'estimasi_selesai'  => trim($_POST['estimasi_selesai'] ?? ''),
            'total_biaya'       => trim($_POST['total_biaya'] ?? '') !== ''
                                    ? $_POST['total_biaya']
                                    : (HARGA_PAKET[$paket] ?? 0),
            'status_pengerjaan' => $_POST['status_pengerjaan'] ?? 'Antre',
        ];
    }

    private function validate($d)
    {
        $err = [];
        if (!$d['id_pelanggan'] || !$this->pelanggan->find($d['id_pelanggan'])) $err[] = 'Pelanggan wajib dipilih.';
        if ($d['merk_sepatu'] === '')  $err[] = 'Merk sepatu wajib diisi.';
        if ($d['warna_sepatu'] === '') $err[] = 'Warna sepatu wajib diisi.';
        if (!in_array($d['paket_treatment'], PAKET_LIST, true)) $err[] = 'Paket treatment tidak valid.';
        if (!in_array($d['status_pengerjaan'], STATUS_LIST, true)) $err[] = 'Status tidak valid.';

        $masuk   = DateTime::createFromFormat('Y-m-d', $d['tanggal_masuk']);
        $selesai = DateTime::createFromFormat('Y-m-d', $d['estimasi_selesai']);
        if (!$masuk)   $err[] = 'Tanggal masuk tidak valid.';
        if (!$selesai) $err[] = 'Estimasi selesai tidak valid.';
        if ($masuk && $selesai && $selesai < $masuk) $err[] = 'Estimasi selesai tidak boleh sebelum tanggal masuk.';

        if (!is_numeric($d['total_biaya']) || $d['total_biaya'] < 0) $err[] = 'Total biaya harus angka >= 0.';
        return $err;
    }

    private function notFound()
    {
        http_response_code(404);
        $this->view('order/notfound', ['title' => 'Tidak ditemukan']);
    }
}
