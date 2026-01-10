<?php

require_once __DIR__ . '/../bootstrap/autoload.php';
require __DIR__ . '/../App/Core/db.php';

use App\Core\Router;

session_start();





$router = new Router();
$router->get('/','HomeController@index');
$router->get('/login' , 'AuthController@showlogin');
$router->post('/login' , 'AuthController@login');
$router->get('/register' , 'AuthController@showregister');
$router->post('/register' , 'AuthController@register');
$router->get('/logout' , 'AuthController@logout');
$router->get('/articles' , 'ArticleController@showarticles');
$router->get('/createarticle' , 'ArticleController@showaddarticle');
$router->post('/createarticle' , 'ArticleController@addarticle');
$router->get('/editarticle' , 'ArticleController@showeditarticle');
$router->post('/editarticle' , 'ArticleController@editarticle');
$router->post('/deletearticle' , 'ArticleController@deletearticle');
$router->get('/profile' , 'ProfileController@showreaderprofile');
// $router->get('/profile' , 'ProfileController@showauthorprofile');
// $router->get('/profile' , 'ProfileController@showadminprofile');
// $router->post('/profile' , 'ProfileController@showreaderprofile');
// // $router->post('/profile' , 'ProfileController@showauthorprofile');
// // $router->post('/profile' , 'ProfileController@showadminprofile');
$router->dispatch();
