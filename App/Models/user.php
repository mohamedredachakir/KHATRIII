<?php

namespace App\Models;

use PDO;
 class User {
    protected $conn;
    protected $table = "users";

    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $role;
    public $active;
    
}