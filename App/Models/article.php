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

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function createArticle() {
        $sql = "INSERT INTO {$this->table}
        (id_user,title,content,create_at)
        VALUES (:id_user,:title,:content,:create_at)";
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':title' , $this->title);
        $stmt->bindParam(':content' , $this->content);
        $stmt->bindParam(':create_at', $this->create_at);

        return $stmt->execute();
    }
    public function getallarticles(){
        $sql = "SELECT * FROM {$this->table}
        ORDER BY create_at DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}