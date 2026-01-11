<?php

namespace App\Controllers;
use App\Models\Reader;
use Database;
use PDO;
class AuthController {
    protected $table = "users";
    
    

    public function showregister(){
        require_once __DIR__ . '/../Views/Auth/register.php';
    }
    public function showlogin(){
        require_once __DIR__ . '/../Views/Auth/login.php';
    }

    private function findByEmail($email){
        $conn = Database::getconnection();
        $sql = "SELECT * FROM {$this->table} WHERE email = :email LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email' , $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($user){
        $conn = Database::getconnection();
        $sql = "INSERT INTO {$this->table}
        (first_name,last_name,email,passowrd)
        VALUES (:first_name,:last_name,:email,:password)";
        $stmt = $conn->prepare($sql);
        $user->password = password_hash($user->password, PASSWORD_DEFAULT);

        $stmt->bindParam(':first_name', $user->first_name);
        $stmt->bindParam(':last_name', $user->last_name);
        $stmt->bindParam(':email', $user->email);
        $stmt->bindParam(':password', $user->password);
        

        return $stmt->execute();
    }

    public function register(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header('Location: /register');
            exit();
        }
        $user = new Reader();

        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        

        if($this->create($user)){
            header('Location: /login');
            exit();
        }
    }
    public function login(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header('Location: /login');
            exit();
        } 

   

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->findByEmail($email);

        if($user && password_verify($password,$user['passowrd'])){
            $_SESSION['user'] = $user;
            header('Location: /');
            exit();
        }

    }
    public function logout(){
        session_destroy();
        header ('Location: /');
        exit();
    }
}