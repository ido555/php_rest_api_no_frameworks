<?php


class Request
{
    public $url_elements;
    public $verb;
    public $parameters;

    public function __construct()
    {
        $this->verb = $_SERVER['REQUEST_METHOD'];
        // urls this applies to: http://localhost:xxxx or http://localhost:xxxx/
        if (!isset($_SERVER['PATH_INFO'])){
            http_response_code(404);
            exit();
        }
        $this->url_elements = explode('/', $_SERVER['PATH_INFO']);
        $this->parseIncomingParams();
        // set json as the default format
        $this->format = 'json';
        if (isset($this->parameters['format'])) {
            $this->format = $this->parameters['format'];
        }
    }

    public function parseIncomingParams()
    {
        $parameters = array();

        // pull the GET vars
        if (isset($_SERVER['QUERY_STRING'])) {
            parse_str($_SERVER['QUERY_STRING'], $parameters);
        }

        // get raw input stream
        $body = file_get_contents("php://input");

        $content_type = false;
        if (isset($_SERVER['CONTENT_TYPE'])) {
            $content_type = $_SERVER['CONTENT_TYPE'];
        }

        switch ($content_type) {
            case "application/json":
                $body_params = json_decode($body);
                if ($body_params) {
                    foreach ($body_params as $param_name => $param_value) {
                        $parameters[$param_name] = $param_value;
                    }
                }
                $this->format = "json";
                break;
            case "application/x-www-form-urlencoded":
                parse_str($body, $postvars);
                foreach ($postvars as $field => $value) {
                    $parameters[$field] = $value;

                }
                $this->format = "html";
                break;
            default:
                break;
//                http_response_code(415);
//                echo "Unsupported Content-Type: " . $content_type;
//                exit();
        }
        $this->parameters = $parameters;
    }
}