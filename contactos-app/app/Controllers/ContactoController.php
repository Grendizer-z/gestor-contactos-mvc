<?php
namespace App\Controllers;
use App\Models\Contactos;

class ContactoController{
    private $contactModel;
    public function __construct(){
        $this->contactModel=new Contactos();
    }
    public function index(){
        $contactos=$this->contactModel->getAll($_SESSION['usuario_id']);
        $this->render('contactos/index', ['contacts'=>$contactos]);
    }

    public function create(){
        $this->render('contactos/create');
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $usuario_id=$_SESSION['usuario_id'];
            $nombre=$_POST['nombre'];
            $telefono=$_POST['telefono'];
            $email=$_POST['email'];
            $fecha=date('Y-m-d H:i:s');
            $this->contactModel->insertar($usuario_id, $nombre, $telefono, $email, $fecha);
            header('Location: ../contactos/index');
            exit;
        }
    }

    public function delete($id){
        $this->contactModel->eliminar($id);
        header('Location: /contactos/index');
        exit;
    }

    public function edit($id){
        $contacto=$this->contactModel->getID($id);
        $this->render('contactos/edit', ['contacto'=>$contacto]);
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $usuario_id=$_SESSION['usuario_id'];
            $nombre=$_POST['nombre'];
            $telefono=$_POST['telefono'];
            $email=$_POST['email'];
            $fecha=date('Y-m-d H:i:s');
            $this->contactModel->actualizar($usuario_id, $nombre, $telefono, $email, $fecha, $id);
            header('Location: /contactos/edit/'.$id);
            exit;
        }
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
