<?php

namespace App\Controllers;

use App\Models\Commentaire;
use Database;
use PDO;


class CommentController {
    protected $table = "commentaires";

    private function checkauth() {
        if(!isset($_SESSION['user'])){
            header('Location: /login');
            exit();
        };
    }

    private function create($commentaire){
        $conn = Database::getconnection();
        $sql = "INSERT INTO {$this->table}
        (id_article,id_reader,content)
        VALUES (:id_article,:id_reader,:content)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_article',$commentaire->id_article);
        $stmt->bindParam(':id_reader',$commentaire->id_reader);
        $stmt->bindParam(':content',$commentaire->content);
        return $stmt->execute();
    }

private function getCommentsByArticleId($id){
    $conn = Database::getConnection();
    $sql = "
        SELECT c.*, u.first_name, u.last_name
        FROM commentaires c
        LEFT JOIN users u ON u.id = c.id_reader
        WHERE c.id_article = ?
        ORDER BY c.create_at DESC
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




    public function showcomments(){
        $id = $_GET["id"];
        $comments = $this->getCommentsByArticleId($id);
        require_once __DIR__ . '/../Views/Comments/allComments.php';
    }

public function addcommentaire() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /');
        exit();
    }

    $this->checkauth();

    $id_article = $_POST['id_article'] ?? null;
    $content    = $_POST['content'] ?? null;

    if (!$id_article || !$content) {
        die("cant add comment whit out value");
    }

    $commentaire = new Commentaire();
    $commentaire->id_article = $id_article;
    $commentaire->id_reader  = $_SESSION['user']['id'];
    $commentaire->content    = $content;

    if ($this->create($commentaire)) {
        header('Location: /articles?id=' . $id_article); 
        exit();
    }
}



    public function deletecommentaire(){
        $conn = Database::getconnection();
        if($_SERVER['REQUEST_METHOD']!== 'POST'){
            header('Location: /articles');
            exit();
        };
        $this->checkauth();
        if(!isset($_POST['id_commentaire'])){
            header('Location: /comment');
            exit();
        }
        $id = $_POST['id_commentaire'];
        $id_reader = $_SESSION['user']['id'];
        $sql = "DELETE FROM {$this->table}
        WHERE id = ? AND id_reader = ?";
        $stmt = $conn->prepare($sql);
        if($stmt->execute([$id,$id_reader])){
            header('Location: /articles');
            exit();
        }

    }
}