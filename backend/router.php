<?php
require_once 'Config/DevEnv.php';
require_once 'Models/Request.php';

header('Content-Type: application/json; charset=utf-8'); // for debugging

// autoload classes
spl_autoload_register('autoload');
function autoload($classname)
{
    if (preg_match('/[a-zA-Z]+Controller$/', $classname)) {
        include __DIR__ . '/Controllers/' . $classname . '.php';
        return true;
    } elseif (preg_match('/[a-zA-Z]+Model$/', $classname)) {
        include __DIR__ . '/Models/' . $classname . '.php';
        return true;
    }
}

try {
    $request = new Request();

// route the request
    $controller_name = ucfirst($request->url_elements[1]);
    if (class_exists($controller_name)) {
        $controller = new $controller_name();
        $action_name = strtolower($request->verb);
        var_dump($controller);
    } else {
        http_response_code(404);
        exit();
    }

    var_dump($request);
} catch (Exception $e) {
    var_dump($e);
}
