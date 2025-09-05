<?php

namespace Mvc\ContactosApp;

use Mvc\ContactosApp\Controllers\Usuario_Controller;
use Mvc\ContactosApp\Controllers\Contacto_Controller;

class Router
{
    private $routes = [];
    private $userController;

    public function __construct()
    {
        $this->userController = new Usuario_Controller();
        $this->defineRoutes();
    }

    private function defineRoutes()
    {
        // Rutas para usuarios
        $this->routes = [
            'POST' => [
                '/usuarios/login' => [$this->userController, 'login'],
                '/usuarios/registrar' => [$this->userController, 'registrar'],
            ]
        ];
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Limpiar la URI
        $uri = rtrim($uri, '/');
        if (empty($uri)) {
            $uri = '/';
        }

        // Buscar ruta exacta
        if (isset($this->routes[$method][$uri])) {
            $this->executeRoute($this->routes[$method][$uri]);
            return;
        }

        // Buscar rutas con parámetros
        foreach ($this->routes[$method] as $route => $handler) {
            if (strpos($route, '{') !== false) {
                $pattern = $this->convertRouteToRegex($route);
                if (preg_match($pattern, $uri, $matches)) {
                    array_shift($matches); // Remover el match completo
                    $this->executeRoute($handler, $matches);
                    return;
                }
            }
        }

        // Ruta no encontrada
        $this->show404();
    }

    private function convertRouteToRegex($route)
    {
        // Convertir {id} a (\d+), {slug} a ([a-zA-Z0-9-_]+), etc.
        $pattern = preg_replace('/\{id\}/', '(\d+)', $route);
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9-_]+)', $pattern);
        return '#^' . $pattern . '$#';
    }

    private function executeRoute($handler, $params = [])
    {
        if (is_array($handler)) {
            [$controller, $method] = $handler;
            if (method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], $params);
            } else {
                $this->show404();
            }
        } elseif (is_callable($handler)) {
            call_user_func_array($handler, $params);
        } else {
            $this->show404();
        }
    }

    private function show404()
    {
        http_response_code(404);
        echo "<h1>404 - Página no encontrada</h1>";
        echo "<p>La página que buscas no existe.</p>";
        echo "<a href='/users'>Volver al inicio</a>";
    }
}