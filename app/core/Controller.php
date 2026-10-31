<?php
class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . "/../views/$view.php";
        require __DIR__ . '/../views/layouts/footer.php';
    }

    protected function redirect($path)
    {
        header('Location: ' . url($path));
        exit;
    }

    protected function flash($type, $msg)
    {
        $_SESSION['flash'] = ['type' => $type, 'msg' => $msg];
    }

    protected function requirePost()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            die('Metode tidak diizinkan.');
        }
    }
}
