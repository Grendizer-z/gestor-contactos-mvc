<?php
require_once '../Models/Usuario.php';
require_once '../Views/UsuarioView.php';

class Usuario_Controller {
    private $usuarioModel;
    private $usuarioView;
    public function __construct() {
        $this->usuarioModel = new Usuario();
        $this->usuarioView = new UsuarioView();
    }

    public function login($email, $clave){
        $usuario = $this->usuarioModel->iniciarSesion($email, $clave);
        $this->usuarioView->mostrarUsuario($usuario);
    }

    
}