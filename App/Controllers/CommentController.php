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
    }

    public function addcommentaire(){
        if($_SERVER['REQUEST_METHOD']!== 'POST'){
            header('Location: /');
        };
        $this->checkauth();
        $commentaire = new Commentaire();
        $commentaire->id_article = $_POST['id_article'];
        $commentaire->id_reader = $_POST['id_reader'];
        $commentaire->content = $_POST['content'];

        if($this->create($commentaire)){

        };

    }

    public function deletecommentaire(){
        $conn = Database::getconnection();
        if($_SERVER['REQUEST_METHOD']!== 'POST'){
            header('Location: /');
        };
        $this->checkauth();
        $id = $_POST['id'];
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