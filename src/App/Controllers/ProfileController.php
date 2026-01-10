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

    private function checkauthor() {
        if($_SESSION['user']['role'] !== 'author'){
            header('Location: /');
            exit();
        };
    }

    private function checkreader() {
        if($_SESSION['user']['role'] !== 'reader'){
            header('Location: /');
            exit();
        };
    }


    private function checkadmin() {
        if($_SESSION['user']['role'] !== 'admin'){
            header('Location: /');
            exit(); 
        };
    }

    public function showreaderprofile() {
        $this->checkauth();
        
        require_once __DIR__ .'/../Views/Profile/profilereader.php';

    }

    // public function showauthorprofile() {
    //     $this->checkauthor();
        
    //     require_once __DIR__ .'/../Views/Profile/profile.php';
    // }
    // public function showadminprofile() {
    //     $this->checkauth();
        
    //     require_once __DIR__ .'/../Views/Profile/profile.php';
    // }
}