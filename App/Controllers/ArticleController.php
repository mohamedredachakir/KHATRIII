<?php

namespace App\Controllers;
use App\Models\Article;

class ArticleController {
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function showarticles() {
        $articlemodel = new Article($this->conn);
        $articles = $articlemodel->getallarticles();
        require_once __DIR__ . '/../Views/Articles/allArticle.php';
    }
    public function  showeditarticle(){
        require_once __DIR__ . '/../Views/Articles/editArticle.php';
    }
    public function showaddarticle(){
        require_once __DIR__ . '/../Views/Articles/addArticle.php';
    }
    public function addarticle() {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header('Location: /addarticle');
            exit();
        }
        $article = new Article($this->conn);

        $article->id_user = $_SESSION['user']['id'];
        $article->title = $_POST['title'];
        $article->content = $_POST['content'];
        $article->create_at = date('Y-m-d H:i:s');

        if($article->createArticle()){
            header('Location: /articles');
            exit();
        }
    }
    public function editarticle() {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header('Location: /editarticle');
            exit();
        }

        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        $sql = "UPDATE articles SET title = ?, content = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute([$title,$content,$id])){
            header('Location: /articles');
            exit();
        }
        
    }
    public function deletearticle() {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header('Location: /articles');
            exit();
        }
        $id = $_POST['id'];
        $sql = "DELETE FROM articles WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute([$id])){
            header('Location: /articles');
            exit();
        }
    }
}