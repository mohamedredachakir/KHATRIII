<?php

namespace App\Controllers;

class ErrorController {
    public function notFound(){
        require_once __DIR__ . '/../Views/Errors/404.php';

    }
}