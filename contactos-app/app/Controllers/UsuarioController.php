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
            if (!password_verify($clave, $usuario[0]['clave'])) {
                // La contraseña no es válida
                echo "Contraseña incorrecta";
                return;
            }
            
            if($usuario){
                $_SESSION['usuario_id']=$usuario[0]['id'];
                $_SESSION['usuario_nombre']=$usuario[0]['nombre'];
                $_SESSION['usuario_email']=$usuario[0]['email'];
                $_SESSION['LOGGED_IN']=true;
                //edirigir a la vista de usuarios
                header('Location: ../contactos/index');
                exit;
            }
        }
    }

    public function registrar(){
        $this->render('usuarios/registrar');
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $clave = $_POST['clave'];
            $hashClave=password_hash($clave, PASSWORD_DEFAULT);
            $fecha = date('Y-m-d H:i:s');
            $this->usuarioModel->registrar($nombre, $email, $hashClave, $fecha);
            //Redirigir a la vista de login
            header('Location: ../');
            exit;
        }
    }

    public function logout(){
        $this->usuarioModel->cerrarSesion();
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