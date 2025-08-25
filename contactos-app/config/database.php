<?php
class Conexion{
    public static function conectar(){
        try{
            $base=new PDO('mysql:host=localhost; dbname=contactos-app', 'root', '');
        }
        catch(Exception $e){
            die("Error: " . $e->getMessage());
        }
        
    }
}