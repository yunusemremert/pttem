<?php

namespace App;

class Route {
    private array $routes = [];

    public function get($url, $handler): void
    {
        $this->addRoute('GET', $url, $handler);
    }

    // ... other methods (post, put, patch, delete)

    private function addRoute($method, $url, $handler): void
    {
        $pattern = preg_replace('/:[^\/]*/', '([^/]+)', $url);

        $this->routes[$method][$pattern] = $handler;
    }

    public function run(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes[$method] as $pattern => $handler) {
            if (preg_match("#^$pattern$#", $url, $matches)) {
                call_user_func($handler, $matches);

                return;
            }
        }

        http_response_code(404);

        echo json_encode( array("message" => "404 Not Found"));
    }
}
