<?php
namespace App\Core\Router;


/**
 * List of routes
 * @return mix
 */
class Routes {

    public $routes = [];

    public function setRoutes($http_request_type, $route, $controller, $method) {
        return $routes[$http_request_type.':/grades_manager/'.$route] = ['class' => 'App\\Controllers\\'.$controller, 'method' => $method];
    }

    public function routesList()
    {
        $urlParam = isset($_SERVER['REDIRECT_QUERY_STRING']) ? str_replace('page=','',$_SERVER['REDIRECT_QUERY_STRING']) : '';
 
        $routes = array(
            'GET:/grades_manager/'.$urlParam => array('class' => 'App\Controllers\StudentController', 'method' => 'index','data' => $urlParam)
            );
        return $routes;
    }
}