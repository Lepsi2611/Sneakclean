<?php
// Front controller: semua request masuk lewat file ini
session_start();

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/helpers.php';

spl_autoload_register(function ($class) {
    foreach (['core', 'controllers', 'models'] as $dir) {
        $file = __DIR__ . "/../app/$dir/$class.php";
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

(new Router())->dispatch();
