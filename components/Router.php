<?php

namespace App\Components;


class Router
{
    protected $routes = [];

    public function __construct()
    {
        $this->routes = include(ROOT . '/routes/routes.php');
        $this->clearFlashMessages();
    }

    /**
     * Метод очищает флеш сообщения, при кажном запросе
     */
    protected function clearFlashMessages()
    {
        Session::clearFlashMessage();
    }

    public function getRequestUri()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        } else {
            return null;
        }
    }

    protected function getResponse($res)
    {
        echo $res;
    }

    /**
     * @param array $middlewares
     *
     * Метод выполняет все действия, которые указаны в классах посредниках
     */
    protected function checkMiddlewares(array $middlewares)
    {
        foreach ($middlewares as $middlewareClassName) {
            $middlewareClassName = "App\\Middleware\\" . $middlewareClassName;
            $middleware = new $middlewareClassName();
            $middleware->handle();
        }
    }

    public function handle()
    {
        try {
            $uri = $this->getRequestUri();

            $internalRoute = null;

            $middlewares = [];

            // получаем масив маршрутов и проходимся по ему
            foreach ($this->routes as $routePattern => $path) {
                $newPath = null;
                if (!is_array($path)) {
                    $newPath = $path;
                } else {
                    if (isset($path['route'])) {
                        $newPath = $path['route'];
                    }
                }
                if ($newPath !== null) {
                    if ($uri == "" && $routePattern == '/') {
                        $internalRoute = $newPath;
                        if (isset($path['middleware'])) {
                            $middlewares = $path['middleware'];
                        }
                        break;
                    } elseif($uri != "" && preg_match("~^$routePattern$~", $uri)) {
                        if (isset($path['middleware'])) {
                            $middlewares = $path['middleware'];
                        }
                        $internalRoute = preg_replace("~^$routePattern$~", $newPath, $uri);
                        break;
                    }
                }
            }
            if (!$internalRoute) {
                throw new \Exception("Error: 404: Resource is not found");
            }

            // передаем управление классам посредникам (если таковы имеються для даного маршрута)
            $this->checkMiddlewares($middlewares);

            // определяем имя контроллера и действия
            $segments = explode('/', $internalRoute);
            $controllerName = ucfirst(array_shift($segments)) . 'Controller';
            $fullControllerClassName = "App\\Controllers\\" . $controllerName;

            $controller = new $fullControllerClassName();

            $action = array_shift($segments);

            $parametrs = $segments;
            $result = call_user_func_array(array($controller,$action), $parametrs);
            $this->getResponse($result);
        } catch (\Exception $e) {
            echo $e;
        }
    }
}