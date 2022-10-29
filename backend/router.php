<?php

define('__ROOT__', dirname(dirname(__FILE__)) . "/backend/");
require_once __ROOT__ . 'Config/DevEnv.php';
require_once __ROOT__ . 'Models/Request.php';
require_once __ROOT__ . 'Models/CarModel.php';

header('Content-Type: application/json; charset=utf-8'); // for debugging

// autoload controllers and models
spl_autoload_register('autoload');
function autoload($classname)
{
    if (preg_match('/[a-zA-Z]+Controller$/', $classname)) {
        include __ROOT__ . '/Controllers/' . $classname . '.php';
        return true;
    } elseif (preg_match('/[a-zA-Z]+Model$/', $classname)) {
        include __ROOT__ . '/Models/' . $classname . '.php';
        return true;
    }
}

try {
    $request = new Request();

// route the request
    $controller_name = ucfirst($request->url_elements[1]);
    if (class_exists($controller_name)) {
        $controller = new $controller_name();
        $action = $request->url_elements[2];

        if (method_exists($controller, $action)) {
            if (isset($request->url_elements[2])) {
                if ($request->verb == "GET") {
                    $controller->$action();
                }
                if ($request->verb == "POST") {
                    $controller->$action($request->parameters);
                }
            }
        }
    } else {
        http_response_code(404);
        exit();
    }

} catch (Exception $e) {
    echo($e->getMessage());
    http_response_code(500);
}
