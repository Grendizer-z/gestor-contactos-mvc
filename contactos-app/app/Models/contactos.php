<?php
namespace App\Models;
use App\Config\Database;
use PDO;
//session_start();

class Contactos{
    private $db;
    private $connection;
    private $id;
    private $usuario_id;
    private $nombre;
    private $telefono;
    private $email;
    private $fecha;
    private $contactos=[];

    public function __construct(){
        $this->db=new Database();
        $this->connection=$this->db->conectar();
    }

    public function getAll($id=null){
        $query="SELECT * FROM contactos WHERE usuario_id = ?";
        $stmt=$this->connection->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertar($usuario_id, $nombre, $telefono, $email, $fecha){
        $query="INSERT INTO contactos (usuario_id, nombre, telefono, email, fecha_creacion) VALUES (?, ?, ?, ?, ?)";
        $stmt=$this->connection->prepare($query);
        return $stmt->execute([$usuario_id, $nombre, $telefono, $email, $fecha]);
    }

    public function getID($id){
        $query="SELECT * FROM contactos WHERE id = ?";
        $stmt=$this->connection->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar($id){
        $query="DELETE FROM contactos WHERE id =?";
        $stmt=$this->connection->prepare($query);
        $stmt->execute([$id]);
    }

    public function actualizar($usuario_id, $nombre, $telefono, $email, $fecha, $id){
        $query="UPDATE contactos SET usuario_id=?, nombre=?, telefono=?, email=?, fecha_creacion=? WHERE id=?";
        $stmt=$this->connection->prepare($query);
        $stmt->execute([$usuario_id, $nombre, $telefono, $email, $fecha, $id]);
    }
}