<?php
require_once '../backend/Models/Request.php';
header('Content-Type: application/json; charset=utf-8');
//var_dump($_SERVER);
//var_dump($_POST);

$request = new Request();
// route the request
$controller_name = ucfirst($request->url_elements[1]);
if (class_exists($controller_name)) {
    $controller = new $controller_name();
    $action_name = strtolower($request->verb);
    $result = $controller->$action_name();
    print_r($result);
}
var_dump($request);