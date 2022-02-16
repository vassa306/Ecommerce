<?php
namespace app;

use AltoRouter;

class RouteDispatcher
{

    protected $match;

    protected $controller;

    protected $method;

    public function __construct(AltoRouter $router)
    {
        $this->match = $router->match();

        if ($this->match) {
            list ($controller, $method) = explode('@', $this->match['target']);
            $this->controller = $controller;
            $this->method = $method;
            
            if (is_callable(array(
                new $this->controller(),
                $this->method
            ))) {
                call_user_func_array(array(
                    new $this->controller(),
                    $this->method
                ),
                    is_array($this->match['params']) ? $this->match['params'] : array($this->match['params'])
                );
            } else {
                echo "The method {$this->method} is not defined in {$this->controller}";
            }
        } else {
            // no route was matched
            header($_SERVER['SERVER_PROTOCOL'] . '404 not found');
            view('errors/404');
        }
    }
}

