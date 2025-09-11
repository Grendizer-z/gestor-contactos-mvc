<?php
namespace App\Controllers;

use App\Models\Usuario;
session_start();
class UsuarioController {
    private $usuarioModel;
    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    public function login(){
        $this->render('usuarios/login');
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_POST['email'];
            $clave = $_POST['clave'];
            $usuario=$this->usuarioModel->iniciarSesion($email, $clave);
            if($usuario){
                $_SESSION['usuario_id']=$usuario[0]['id'];
                //Redirigir a la vista de usuarios
                header('Location: ../contactos/index');
                exit;
            }
        }
    }

    public function registrar($nombre, $email, $clave, $fecha){
        $this->usuarioModel->registrar($nombre, $email, $clave, $fecha);
    }
    
    private function render($view, $data = [])
    {
        extract($data);
        $viewPath = __DIR__ . '/../Views/' . $view . '.php';

        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            echo "Vista no encontrada: " . $view;
        }
    }
}