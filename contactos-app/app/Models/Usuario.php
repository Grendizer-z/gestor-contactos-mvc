<?php

namespace App\Models;
use App\Config\Database;
use PDO;

class Usuario{
    private $db;
    private $connection;
    private $id;
    private $nombre;
    private $email;
    private $clave;
    private $fecha;

    public function __construct(){
        $this->db=new Database();
        $this->connection=$this->db->conectar();
    }

    public function iniciarSesion($email, $clave){
        $query="SELECT * FROM usuarios WHERE email = ?";
        $stmt=$this->connection->prepare($query);
        $stmt->execute([$email]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrar($nombre, $email, $clave, $fecha){
        $query="INSERT INTO usuarios (nombre, email, clave, fecha_creacion) VALUES (?, ?, ?, ?)";
        $stmt=$this->connection->prepare($query);
        return $stmt->execute([$nombre, $email, $clave, $fecha]);
    }

    public function getID($id){
        $query="SELECT * FROM usuarios WHERE id = ?";
        $stmt=$this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cerrarSesion(){
        $_SESSION=[];
        session_destroy();
        header('Location: /');
        exit;
    }
}