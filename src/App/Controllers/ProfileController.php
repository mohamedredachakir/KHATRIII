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

    public function beauthor() {
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
            $_SESSION['user']['role'] = $role;
            header('Location: /profile');
            exit();
        };
    }

     private function fetchAuthorArticles() {
        $conn = Database::getconnection();
        $id = $_SESSION['user']['id'];
        $sql = 'SELECT * FROM articles WHERE id_user = ?';
        $stmt = $conn->prepare($sql);
        if($stmt->execute([$id])){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        };
        

    }
    
    private function countReaders(){
        $conn = Database::getconnection();
        $role = 'reader';
        $sql = 'SELECT COUNT(*) AS total FROM users WHERE role = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$role]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    private function countAuthors(){
        $conn = Database::getconnection();
        $role = 'author';
        $sql = 'SELECT COUNT(*) AS total FROM users WHERE role = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$role]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    private function countArticles(){
        $conn = Database::getconnection();
        $sql = 'SELECT COUNT(*) AS total FROM articles';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    

    public function showprofile() {
        $user = $_SESSION['user'];
        $this->checkauth();
        if($_SESSION['user']['role'] === 'author'){
            $author_articles = $this->fetchAuthorArticles();
            require_once __DIR__ .'/../Views/Profile/profileauthor.php';
        };
         if($_SESSION['user']['role'] === 'reader'){
            require_once __DIR__ .'/../Views/Profile/profilereader.php';
        };
         if($_SESSION['user']['role'] === 'admin'){
            $total_readers = $this->countReaders();
            $total_authors = $this->countAuthors();
            $total_articles = $this->countArticles();
            require_once __DIR__ .'/../Views/Profile/dashboard.php';
        };
    }
    
    public function showeditprofile() {
        $user = $_SESSION['user'];
        require_once __DIR__ .'/../Views/Profile/editProfile.php';
    }
    public function editprofile() {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header('Location: /profile');
            exit();
        };

        $this->checkauth();
        $conn = Database::getconnection();
        $id = $_SESSION['user']['id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = 'UPDATE users SET first_name = ? , last_name = ?,
        email = ? , passowrd = ? WHERE id = ?';
        $stmt = $conn->prepare($sql);
        if($stmt->execute([$first_name,$last_name,$email,$password, $id])){
             $_SESSION['user']['first_name'] = $first_name;
             $_SESSION['user']['last_name']  = $last_name;
             $_SESSION['user']['email']      = $email;
            header('Location: /profile');
            exit();
        }
    }

}