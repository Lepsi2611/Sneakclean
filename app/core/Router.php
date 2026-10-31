<?php
// Pola URL: /controller/method/param1/param2
// Contoh   : /order/show/SC-20261104-001  -> OrderController::show('SC-20261104-001')
class Router
{
    public function dispatch()
    {
        $url   = trim($_GET['url'] ?? '', '/');
        $parts = $url === '' ? [] : explode('/', $url);

        $name   = $parts[0] ?? 'home';
        $method = $parts[1] ?? 'index';
        $params = array_slice($parts, 2);

        if (!preg_match('/^[a-z]+$/i', $name) || !preg_match('/^[a-z]+$/i', $method)) {
            return $this->notFound();
        }

        $class = ucfirst(strtolower($name)) . 'Controller';
        if (!class_exists($class) || !method_exists($class, $method)) {
            return $this->notFound();
        }
        if (!(new ReflectionMethod($class, $method))->isPublic()) {
            return $this->notFound();
        }

        call_user_func_array([new $class(), $method], $params);
    }

    private function notFound()
    {
        http_response_code(404);
        require __DIR__ . '/../views/layouts/header.php';
        echo '<div class="card"><h2>404 - Halaman tidak ditemukan</h2>'
           . '<p><a class="btn" href="' . url('order') . '">Kembali ke daftar order</a></p></div>';
        require __DIR__ . '/../views/layouts/footer.php';
    }
}
