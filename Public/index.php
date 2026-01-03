<?php

require_once __DIR__ . '/../bootstrap/autoload.php';
require __DIR__ . '/../App/Core/db.php';

use App\Core\Router;


session_start();


$router = new Router();
$router->get('/','HomeController@index');
$router->dispatch();