<?php

namespace App\Models;

use PDO;
class Article {
    protected $conn;
    protected $table = "articles";

    public $id_user;
    public $title;
    public $content;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function createArticle() {
        $sql = "INSERT INTO {$this->table}
        (id_user,title,content)
        VALUES (:id_user,:title,:content)";
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':title' , $this->title);
        $stmt->bindParam(':content' , $this->content);

        return $stmt->execute();
    }
}