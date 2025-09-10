<?php
namespace App\Controllers;
use App\Models\Contactos;

class ContactoController{
    private $contactModel;
    public function __construct(){
        $this->contactModel=new Contactos();
    }
    public function index(){
        $contactos=$this->contactModel->getAll();
        $this->render('contactos/index', ['contacts'=>$contactos]);
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
