<?php

//require_once "../Objects/Car.php";
require_once __ROOT__ . "Objects\Car.php";
require_once __ROOT__ . "Other/isNumericExceptionCheck.php";
require_once __ROOT__ . "Models/DatabaseConn.php";
require_once __ROOT__ . "Models/CarModel.php";

class CarModel extends DatabaseConn
{
    /**
     * CarModel constructor.
     * @throws PDOException
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Car $car
     * @return bool
     * @throws PDOException
     */
    public function addCar(Car $car)
    {
        if (!($car instanceof Car))
            throw new TypeError();

        $stmt = $this->conn->prepare("INSERT INTO cars (manufacturer, year, color) VALUES (?, ?, ?)");
        return $stmt->execute([$car->getManufacturer(), $car->getYear(), $car->getColor()]);
    }

    /**
     * @param int $id
     * @return Car
     * @throws PDOException
     * @throws TypeError
     */
    public function getCar(int $id): Car
    {
        isNumericExceptionCheck($id);
        $stmt = $this->conn->prepare("SELECT * FROM cars WHERE (id) VALUES (?)");
        $stmt->execute($id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Car');
        return $stmt->fetch();
    }


    /**
     * @return mixed
     * @throws PDOException
     */
    public function getAllCars()
    {
        $stmt = $this->conn->prepare("SELECT * FROM cars");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "CarModel");
    }

    /**
     * @param int $id
     * @return bool
     * @throws PDOException
     * @throws TypeError
     */
    public function updateCar(int $id)
    {
        isNumericExceptionCheck($id);

        $stmt = $this->conn->prepare("UPDATE cars SET manufacturer=?, year=?, color=? WHERE id=?");
        $car = $this->getCar($id);
        return $stmt->execute([$car->getManufacturer(), $car->getYear(), $car->getColor(), $id]);
    }

    /**
     * @param int $id
     * @return bool
     * @throws PDOException
     * @throws TypeError
     */
    public function deleteCar(int $id)
    {
        isNumericExceptionCheck($id);

        $stmt = $this->conn->prepare("DELETE FROM cars WHERE (id) VALUES (?)");
        return $stmt->execute($id);
    }

    /***
     * @param int $id
     * @return bool
     * @throws PDOException
     * @throws TypeError
     */
    public function isCarExists(int $id)
    {
        isNumericExceptionCheck($id);

        $stmt = $this->conn->prepare("SELECT * FROM cars WHERE id = ?");
        $stmt->execute($id);
        if ($stmt->rowCount() > 0)
            return true;
        else
            false;


    }
}