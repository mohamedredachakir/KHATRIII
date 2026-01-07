<?php

namespace App\Controllers;
use App\Models\Article;
use Database;
use PDO;
class ArticleController {
    
    protected $table = "articles";

    private function checkauth() {
        if(!isset($_SESSION['user'])){
            header('Location: /login');
            exit();
        };
    }

    private function checkauthor() {
        if($_SESSION['user']['role'] !== 'author'){
            header('Location: /');
            exit();
        }
    }

     private function createArticle($article) {
        $conn = Database::getconnection();
        $sql = "INSERT INTO {$this->table}
        (id_user,title,content,create_at)
        VALUES (:id_user,:title,:content,:create_at)";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':id_user', $article->id_user);
        $stmt->bindParam(':title' , $article->title);
        $stmt->bindParam(':content' , $article->content);
        $stmt->bindParam(':create_at', $article->create_at);

        return $stmt->execute();
    }

    private function getallarticles(){
        $conn = Database::getconnection();
        $sql = "SELECT * FROM {$this->table}
        ORDER BY create_at DESC";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function showarticles() {
        $articles = $this->getallarticles();
        require_once __DIR__ . '/../Views/Articles/allArticle.php';
    }
    public function  showeditarticle(){
        $this->checkauth();
        $this->checkauthor();
        require_once __DIR__ . '/../Views/Articles/editArticle.php';
    }
    public function showaddarticle(){
        $this->checkauth();
        $this->checkauthor();
        require_once __DIR__ . '/../Views/Articles/addArticle.php';
    }
    public function addarticle() {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header('Location: /addarticle');
            exit();
        }
        $this->checkauth();
        $this->checkauthor();
        $article = new Article();

        $article->id_user = $_SESSION['user']['id'];
        $article->title = $_POST['title'];
        $article->content = $_POST['content'];
        $article->create_at = date('Y-m-d H:i:s');

        if($this->createArticle($article)){
            header('Location: /articles');
            exit();
        }
    }
    public function editarticle() {
        $conn = Database::getconnection();
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header('Location: /editarticle');
            exit();
        }
        $this->checkauth();
        $this->checkauthor();
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        $sql = "UPDATE articles SET title = ?, content = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if($stmt->execute([$title,$content,$id])){
            header('Location: /articles');
            exit();
        }
        
    }
    public function deletearticle() {
        $conn = Database::getconnection();
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header('Location: /articles');
            exit();
        }
        $this->checkauth();
        $this->checkauthor();
        $id = $_POST['id'];
        $sql = "DELETE FROM articles WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if($stmt->execute([$id])){
            header('Location: /articles');
            exit();
        }
    }
}