<?php

class Users{
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
}

require '../../config/database.php';
$cx=new Conexion();
$persona=new Users($cx->conectar());
print_r($persona->iniciarSesion('juan@example.com', '1234'));