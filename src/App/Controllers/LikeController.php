<?php

namespace App\Controllers;
use App\Models\LikeArticle;
use App\Models\LikeCommentaire;
use Database;
use PDO;

class LikeController {
      
    private function checkauth() {
        if(!isset($_SESSION['user'])){
            header('Location: /login');
            exit();
        };
    }
    private function createlikearticle($like) {
        $conn = Database::getConnection();
        $sql = "INSERT INTO like_article (id_article,id_reader)
        VALUES (:id_article,:id_reader)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id_article",$like->id_article);
        $stmt->bindParam(":id_reader",$like->id_reader);       
        return $stmt->execute();
        
    }

    private function checklike($id_article, $id_reader){
        $conn = Database::getConnection();
        $sql = "SELECT * FROM like_article WHERE id_article = ? AND id_reader = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_article, $id_reader]);
        $count = $stmt->fetchColumn();
        return $count > 0; 

    }

    public function addlikearticle() {
        $like = new LikeArticle();
        $like->id_reader = $_SESSION['user']['id'];
        $like->id_article = $_POST['id'];
        if (!$this->checklike($like->id_article, $like->id_reader)) {
        if($this->createlikearticle($like)) {
            header('Location: /articles');
            exit();    
            };
        }else{
            header('Location: /articles');
            exit();  
        };
    }
    public function deletelikearticle() {  
        $conn = Database::getConnection();
        $id_reader = $_POST["id_reader"];
        $id_article = $_POST["id"];
        $sql = "DELETE FROM like_article where id_article = ? and id_reader = ?"; 
        $stmt = $conn->prepare($sql);
        if($stmt->execute([$id_article,$id_reader])) {
            header("Location: /articles");
            exit();
        }
    }

    public function createlikecomment($like) {if(!isset($_SESSION['user'])){
            header('Location: /login');
            exit();
        };
        $conn = Database::getConnection();
        $sql = "INSERT INTO like_commentaire (id_article,id_reader,id_commentaire)
        VALUES (:id_reader,:id_article,:id_commentaire)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id_reader",$like->id_reader);
        $stmt->bindParam(":id_article",$like->id_article);
        $stmt->bindParam(":id_commentaire",$like->id_commentaire);
        
        return $stmt->execute();
        
    }

    public function addlikecomment() {
        $like = new LikeCommentaire();
        $like->id_reader = $_SESSION['user']['id'];
        $like->id_article =$_SESSION['']['id'];
        if($this->createlikecomment($like)) {
            header('Location: /articles');
            exit();    
        };

    }
}