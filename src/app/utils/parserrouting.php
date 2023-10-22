<?php

class ParserRouting {

    private $path;

    public function __construct($path) {
        $this->path = $path;
    }

    public function matchURL($route, $url) {
        $route = trim($route, '/');
        $url = trim($url, '/');
    
        $routeSegments = explode('/', $route);
        $urlSegments = explode('/', $url);
    
        if (count($routeSegments) != count($urlSegments)) {
            return false;
        }
    
        $params = [];

        for ($i = 0; $i < count($routeSegments); $i++) {
            if ($routeSegments[$i] == $urlSegments[$i]) {
                continue;
            } elseif (strpos($routeSegments[$i], ':') !== false) {
                if (isset($urlSegments[$i]) && $urlSegments[$i] !== '') {
                    $paramName = ltrim($routeSegments[$i], ':');
                    $params[$paramName] = $urlSegments[$i];
                }
            } elseif (str_starts_with($urlSegments[$i], $routeSegments[$i].'?')){
                continue;
            }
            
            else {
                return false;
            }
        }
        return $params;
    }

    public function checkURL($path, $method) {

        foreach ($this->path as $key => $value) {
            $routeParams = $this->matchURL($key, $path);
            if ($routeParams !== false) {
                if (!isset($value[$method])) {
                    http_response_code(405);
                    return null; // Error 405
                }

                return [
                    'controller' => $value[$method],
                    'params' => $routeParams
                ];
            }
        }

        return null; // Page not found
    }

    public function call($path, $method) {
        $result = $this->checkURL($path, $method);
        if (!isset($result)) {
            $controllerName = "conditional/NotFoundController";
            $methodName = "showNotFoundPage";
        } elseif (http_response_code() === 405) {
            $controllerName = "MethodNotAllowedController";
            $methodName = "showMethodNotAllowedPage";
        } else {
            $controller = explode("@", $result['controller']);
            $controllerName = $controller[0];
            $methodName = $controller[1];
            $routeParams = $result['params'];
        }

        require_once DIRECTORY . "/../controller/" . $controllerName . ".php";
        $controllerCall = explode('/', $controllerName);
        $controller = new $controllerCall[1]();
        
        if (isset($routeParams)) {
            $controller->$methodName($routeParams);
        } else {
            $controller->$methodName();
        }
    }
}
