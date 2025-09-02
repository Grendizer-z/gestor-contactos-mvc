<?php

class Usuarios{
    private $db;
    private $id;
    private $nombre;
    private $email;
    private $clave;
    private $fecha;

    public function __construct($db){
        $this->db=$db;
    }

    public function iniciarSesion($email, $clave){
        $query="SELECT * FROM usuarios WHERE email = ? AND clave = ?";
        $stmt=$this->db->prepare($query);
        $stmt->execute([$email, $clave]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrar($nombre, $email, $clave, $fecha){
        $query="INSERT INTO usuarios (nombre, email, clave, fecha_creacion) VALUES (?, ?, ?, ?)";
        $stmt=$this->db->prepare($query);
        return $stmt->execute([$nombre, $email, $clave, $fecha]);
    }

    public function getID($id){
        $query="SELECT * FROM usuarios WHERE id = ?";
        $stmt=$this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cerrarSesion(){
        
    }
}