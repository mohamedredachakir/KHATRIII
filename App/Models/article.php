<?php

namespace App\Models;

use PDO;
class Article {
    protected $conn;
    protected $table = "articles";

    public $id_user;
    public $title;
    public $content;
    public $create_at;
}