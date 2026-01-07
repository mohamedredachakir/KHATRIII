<?php

class Database {
    private static $host = "localhost";
    private static $db_name = "el_cuaderno";
    private static $user_name = "root";
    private static $password = "197170";
    private static $conn = null;
    
    public static function getconnection(){
        if(static::$conn === null){
            try{
                static::$conn = new PDO(
                    "mysql:host=".static::$host.";dbname=".static::$db_name.";charset=utf8mb4",
                    static::$user_name,static::$password
                );
            }catch(PDOException $e){
                echo "connection failed" . $e->getMessage();
            }
        }
        return static::$conn;

    }
}