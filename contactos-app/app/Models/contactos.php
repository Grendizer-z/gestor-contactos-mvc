<?php

class Contactos{
    private $db;
    private $id;
    private $usuario_id;
    private $nombre;
    private $telefono;
    private $email;
    private $fecha;
    private $contactos=[];

    public function __construct($db){
        $this->db=$db;
    }

    public function getAll(){
        $query="SELECT * FROM contactos";
        $stmt=$this->db->prepare($query);
        $stmt->execute();
        return $contactos=$stmt->fetchAll(PDO::FETH_ASSOC);
    }

    public function insertar($usuario_id, $nombre, $telefono, $email, $fecha){
        $query="INSERT INTO usuarios (usuario_id, nombre, telefono, email, fecha_creacion) VALUES (?, ?, ?, ?, ?)";
        $stmt=$this->db->prepare($query);
        return $stmt->execute([$usuario_id, $nombre, $telefono, $email, $fecha]);
    }

    public function getID($id){
        $query="SELECT * FROM usuarios WHERE id = ?";
        $stmt=$this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar($id){
        $query="DELETE FROM contactos WHERE id =?";
        $stmt=$this->db->prepare($query);
        $stmt->execute([$id]);
    }
}