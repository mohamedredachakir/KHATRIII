<?php

/**
 * Dump and die.
 *
 * @param $var
 * @return void
 */
function dd(...$var) {
    foreach ($var as $elem) {
        echo '<pre class="codespan">';
        echo '<code>';
        !$elem || $elem == '' ? var_dump($elem) : print_r($elem);
        echo '</code>';
        echo '</pre>';
    }

    die();
}


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
$router->get('/profile' , 'ProfileController@showprofile');
$router->get('/editprofile' , 'ProfileController@showeditprofile');
$router->post('/editprofile' , 'ProfileController@editprofile');
$router->post('/beauthor' , 'ProfileController@beauthor');
$router->post('/addcategory' , 'CategoryController@addcategory');
$router->post('/deletecategory' , 'CategoryController@deletecategory');
$router->post('/likearticle' , 'LikeController@addlikearticle');
$router->dispatch();
