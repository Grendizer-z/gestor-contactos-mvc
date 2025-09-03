<?php
require_once '../Models/Usuario.php';
require_once '../Views/usuarios/form.php';

class Usuario_Controller {
    private $usuarioModel;
    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    public function login($email, $clave){
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_POST['email'];
            $clave = $_POST['clave'];
            $usuario=$this->usuarioModel->iniciarSesion($email, $clave);
            if($usuario){
                $_SESSION['usuario_id']=$usuario[0]['id'];
                // Redirigir a la vista de usuario

            }
        }
    }

    public function registrar($nombre, $email, $clave, $fecha){
        $this->usuarioModel->registrar($nombre, $email, $clave, $fecha);
    }
    
}