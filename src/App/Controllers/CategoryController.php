<?php

namespace App\Controllers;

use App\Models\Categorie;
use Database;
use PDO;
class CategoryController{
    protected $table = "categories";

     private function checkauth() {
        if(!isset($_SESSION['user'])){
            header('Location: /login');
            exit();
        };
    }

    private function checkadmin() {
        if($_SESSION['user']['role'] !== 'admin'){
            header('Location: /');
            exit();
        }
    }

    private function create($caterory){

        $conn = Database::getconnection();
        $sql = "INSERT INTO {$this->table}
        (name) VALUES (:name)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name',$caterory->name);
        return $stmt->execute();
    }

    public function addcategory(){
        
        if($_SERVER['REQUEST_METHOD']!== 'POST'){
            header('Location: /');
            exit();
        };
        $this->checkauth();
        $this->checkadmin();
        $caterory = new Categorie();
        $caterory->name = $_POST['name'];

        if($this->create($caterory)){
             header('Location: /profile');
             exit();
        };
    }

    public function deletecategory(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){

        }
        $this->checkauth();
        $this->checkadmin();
        $id = $_POST['id'];
        $conn = Database::getconnection();
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if($stmt->execute([$id])){
            header('Location: /profile');
            exit();
        };

    }
}
