<?php

require_once '../Models/CarModel.php';

class CarController
{
    private CarModel $carModel;

    /**
     * CarController constructor.
     * @param CarModel $carModel
     */
    public function __construct()
    {
        $this->carModel = new CarModel();
    }


    public function getAllCars()
    {
        return $this->carModel->getAllCars();
    }
}