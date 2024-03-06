<?php
namespace App;

use Error;

class Router
{
    private function stripParameters($uri)
    {
        if (str_contains($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        return $uri;
    }

    public function route($uri)
    {
        $uri = $this->stripParameters($uri);
        $explodedUri = explode('/', $uri);

        if (empty($explodedUri[1])) {
            $explodedUri[1] = 'home';
            $explodedUri[2] = 'index';
        }

        $controllerName = "App\\Controllers\\" . ucwords($explodedUri[1]) . "Controller";
        $methodName = isset($explodedUri[2]) ? $explodedUri[2] : 'index';
        
        if (!class_exists($controllerName) || !method_exists($controllerName, $methodName)) {
            $this->showNotFoundPage();
            exit;
        }
        try {
            $controllerObj = new $controllerName();
            $controllerObj->$methodName();
        } catch (Error $e) {
            echo $e->getMessage();
            http_response_code(500);
            exit;
        }
    }

    private function showNotFoundPage()
    {        
        http_response_code(404);
        include __DIR__ . '/views/error/not_found.php';
        exit;
    }
}
