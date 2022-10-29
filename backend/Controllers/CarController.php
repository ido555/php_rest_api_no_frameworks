<?php

require_once __ROOT__ . 'Models/CarModel.php';
require_once __ROOT__ . 'Objects/Car.php';
require_once __ROOT__ . 'Other/isMatchingArgumentAmount.php';

class CarController
{
    private CarModel $carModel;

    /**
     * CarController constructor.
     */
    public function __construct()
    {
        $this->carModel = new CarModel();
    }


    public function getAllCars()
    {
        echo json_encode($this->carModel->getAllCars());
        http_response_code(200);
    }

    public function addCar(...$args)
    {
        try {
            echo "\nsizeof(args):" . sizeof($args);
            if(isMatchingArgumentAmount(sizeof($args), "Car")){
                $car = new Car();
            }else{
                http_response_code(400);
            }
        } catch (ReflectionException $e) {
            throw $e;
        }
    }

}