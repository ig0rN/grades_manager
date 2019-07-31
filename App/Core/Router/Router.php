<?php
namespace App\Core\Router;

use App\Core\Router\Routes as Routes;
use App\Core\Helpers\Helper as Helper;

class Router extends Routes
{
    public $request_type;

    public $routes = [];

    public $route;

    /**
     * Initiates whole router
     * Router constructor.
     * @param $routes
     */
    public function __construct()
    {
        $routeTest = $this->setRoutes('GET','/','StudentController','index');
        
        $this->checkRequestType($_SERVER['REQUEST_METHOD']);

        $this->routes = self::routesList();

        $this->setRoute();

        $this->executeRoute();
    }

    /**
     * Check current request for its type
     * @param $server
     * @throws \Exception
     */
    public function checkRequestType($server) {

        switch($server)
        {
            case 'GET':
                $this->request_type = 'GET'; break;
            case 'POST':
                $this->request_type = 'POST'; break;
            case 'PUT':
                $this->request_type = 'PUT'; break;
            case 'DELETE':
                $this->request_type = 'DELETE'; break;
            default: throw new \Exception('Invalid request type');
        };
    }

    /**
     * Sets currently requested route
     * @throws \Exception
     */
    public function setRoute() {
        $address = $_SERVER['REQUEST_URI'];

        $route = $this->routes[$this->request_type . ':' . $address];

        if(isset($route)) {
            $this->route = $route;
        } else {
            throw new \Exception('Page not found',404);
        }
    }

    /**
     * Returns object from requested route
     * @return mixed
     */
    public function executeRoute() {
        $className = $this->route['class'];
        $methodName = $this->route['method'];
        $methodData = $this->route['data'];

        $instance = new $className();

        $fullClassInstanceWithMethod = $instance->$methodName($methodData);

        return $fullClassInstanceWithMethod;
    }
}

