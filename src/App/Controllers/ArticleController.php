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
        
        if ($stmt->execute()) {
         return (int)$conn->lastInsertId();
        }
    }
    private function getAllCategories(){
        $conn = Database::getconnection();
        $sql = 'SELECT * FROM categories';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }
    private function getallarticles(){
        $conn = Database::getConnection();
        $sql = "
          SELECT 
    a.*, 
    u.first_name AS author_name, 
    u.last_name AS author_last,
    COUNT(DISTINCT l.id_reader) AS likes_count,
    COUNT(DISTINCT cm.id) AS comments_count,
    GROUP_CONCAT(DISTINCT c.name) AS categories
FROM articles a
LEFT JOIN users u ON u.id = a.id_user
LEFT JOIN like_article l ON l.id_article = a.id
LEFT JOIN commentaires cm ON cm.id_article = a.id
LEFT JOIN article_categorie ac ON ac.id_article = a.id
LEFT JOIN categories c ON c.id = ac.id_categorie
GROUP BY a.id
ORDER BY a.create_at DESC;

        ";

        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


     private function fetchArticleById($id){
        $conn = Database::getconnection();
        $sql = 'SELECT * FROM articles WHERE id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function showarticles() {
        $articles = $this->getallarticles();
        require_once __DIR__ . '/../Views/Articles/allArticle.php';
    }
    public function  showeditarticle(){
        $this->checkauth();
        $this->checkauthor();
        $id = $_GET['id'];
        $article = $this->fetchArticleById($id);
        $categories = $this->getAllCategories();
        require_once __DIR__ . '/../Views/Articles/editArticle.php';
    }
    public function showaddarticle(){
        $this->checkauth();
        $this->checkauthor();
        $categories = $this->getAllCategories();
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
        //dd($_POST);
        $articleId = $this->createArticle($article);
        if (!empty($_POST['categories']) && is_array($_POST['categories'])) {
        $conn = Database::getconnection();
        $sql = "INSERT INTO article_categorie (id_article, id_categorie)
            VALUES (:id_article, :id_categorie)";
        $stmt = $conn->prepare($sql);
        foreach ($_POST['categories'] as $categoryId) {
        $stmt->execute([
            ':id_article'   => $articleId,
            ':id_categorie' => $categoryId
        ]);
    }
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
        $id_user = $_SESSION['user']['id'];
        $sql = "UPDATE articles SET title = ?, content = ? WHERE id = ? AND id_user = ?";
        $stmt = $conn->prepare($sql);
        if($stmt->execute([$title,$content,$id,$id_user])){
            $conn = Database::getconnection();
            $sql = "DELETE FROM article_categorie WHERE id_article = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);

              if (!empty($categories) && is_array($categories)) {
                $sql = "INSERT INTO article_categorie (id_article, id_categorie)
                VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                foreach ($categories as $categoryId) {
                $stmt->execute([$id, (int)$categoryId]);
                }
            }
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
        $id_user = $_SESSION['user']['id'];
        $sql = "DELETE FROM articles WHERE id = ? AND id_user = ?";
        $stmt = $conn->prepare($sql);
        if($stmt->execute([$id,$id_user])){
            header('Location: /articles');
            exit();
        }
    }
}