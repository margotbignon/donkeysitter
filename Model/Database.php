<?php
require_once 'config.php';

class Database {

    public static function getPdo(){
        return new PDO(DB_DSN, DB_USER, DB_PASS); 
    }

}

?>