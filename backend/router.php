<?php

define('__ROOT__', dirname(dirname(__FILE__)) . "/backend/");
require_once __ROOT__.'Config/DevEnv.php';
require_once __ROOT__.'Models/Request.php';
require_once __ROOT__.'Models/CarModel.php';

header('Content-Type: application/json; charset=utf-8'); // for debugging

// autoload controllers and models
spl_autoload_register('autoload');
function autoload($classname)
{
    if (preg_match('/[a-zA-Z]+Controller$/', $classname)) {
        include __ROOT__. '/Controllers/' . $classname . '.php';
        return true;
    } elseif (preg_match('/[a-zA-Z]+Model$/', $classname)) {
        include __ROOT__. '/Models/' . $classname . '.php';
        return true;
    }
}
try {
    $request = new Request();

// route the request
    $controller_name = ucfirst($request->url_elements[1]);
    if (class_exists($controller_name)) {
        $controller = new $controller_name();
        if (isset($request->url_elements[2])) {
            $action = $request->url_elements[2];
            echo 'action: ' . $action . "\n\n";
        }
        var_dump($controller);
    } else {
        http_response_code(404);
        exit();
    }

    var_dump($request);
} catch (Exception $e) {
    var_dump($e);
}
