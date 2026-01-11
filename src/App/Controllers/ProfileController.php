<?php

namespace App\Controllers;
use Database;
use PDO;

class ProfileController {
    private function checkauth() {
        if(!isset($_SESSION['user'])){
            header('Location: /login');
            exit();
        };
    }

    private function beauthor() {
        $this->checkauth();
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header('Location: /profile');
            exit();
        }
        if($_SESSION['user']['role'] !== 'reader'){
            header('Location: /profile');
            exit();
        }
        $conn = Database::getconnection();
        $id = $_SESSION['user']['id'];
        $role = 'author';
        $sql = 'UPDATE users SET role = ? WHERE id = ?';
        $stmt = $conn->prepare($sql);
        if($stmt->execute([$role,$id])){
            header('Location: /profile');
            exit();
        };
    }

    public function showprofile() {
        $this->checkauth();
        if($_SESSION['user']['role'] === 'author'){
            require_once __DIR__ .'/../Views/Profile/profileauthor.php';
        };
         if($_SESSION['user']['role'] === 'reader'){
            require_once __DIR__ .'/../Views/Profile/profilereader.php';
        };
         if($_SESSION['user']['role'] === 'admin'){
            require_once __DIR__ .'/../Views/Profile/dashboard.php';
        };
    }
    


}