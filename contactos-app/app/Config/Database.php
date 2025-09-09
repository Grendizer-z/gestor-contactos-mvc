<?php

namespace App\Config;
use PDO;
class Database{
    public static function conectar(){
        try{
            $base=new PDO('mysql:host=localhost; dbname=contactos_app', 'root', '');
            return $base;
        }
        catch(Exception $e){
            die("Error: " . $e->getMessage());
        }
        
    }
}