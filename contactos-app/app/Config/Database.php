<?php

namespace App\Config;
use PDO;
class Database{
    private $base;
    public function __construct(){
        try{
            $this->base=new PDO('mysql:host=localhost; dbname=contactos_app', 'root', '');
        }
        catch(Exception $e){
            die("Error: " . $e->getMessage());
        }   
    }

    public function conectar(){
        return $this->base;
    }
}
