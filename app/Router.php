<?php
class Router {
    protected $routes = [];

    public function get($path, $handler) { $this->add('GET', $path, $handler); }
    public function post($path, $handler) { $this->add('POST', $path, $handler); }

    protected function add($method, $path, $handler) {
        $this->routes[] = ['method'=>$method,'path'=>$path,'handler'=>$handler];
    }

    public function dispatch($requestUri = null, $requestMethod = null) {
        $requestUri = $requestUri ?? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestMethod = $requestMethod ?? $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['method'] !== $requestMethod) continue;
            $params = $this->match($route['path'], $requestUri);
            if ($params !== false) {
                $handler = $route['handler'];
                if (is_callable($handler)) return call_user_func($handler, $params);
                if (is_string($handler) && strpos($handler, '@')!==false) {
                    list($controller, $method) = explode('@', $handler, 2);
                    if (class_exists($controller)) {
                        $c = new $controller(new ProductModel());
                        return $c->{$method}(...array_values($params));
                    }
                }
            }
        }
        // no route matched
        http_response_code(404);
        echo "Not Found";
    }

    // match path like /product/{id}
    protected function match($routePath, $requestPath) {
        $routePath = rtrim($routePath, '/'); if ($routePath==='') $routePath='/';
        $requestPath = rtrim($requestPath, '/'); if ($requestPath==='') $requestPath='/';
        $routeParts = explode('/', $routePath);
        $reqParts = explode('/', $requestPath);
        if (count($routeParts) !== count($reqParts)) return false;
        $params = [];
        for ($i=0;$i<count($routeParts);$i++) {
            $rp = $routeParts[$i]; $rq = $reqParts[$i];
            if (strlen($rp)>1 && $rp[0]=='{' && $rp[strlen($rp)-1]=='}') {
                $key = trim($rp,'{}'); $params[$key] = $rq;
            } elseif ($rp !== $rq) {
                return false;
            }
        }
        return $params;
    }
}
