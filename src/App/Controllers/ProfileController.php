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
        $this->checkreader();

    }

    public function showauthorprofile() {
        $this->checkauthor();
        $this->checkauth();
    }
    public function showadminprofile() {
        $this->checkauth();
        $this->checkadmin();
    }
}