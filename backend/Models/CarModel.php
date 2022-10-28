<?php

require_once "../Objects/Car.php";

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

        $stmt = $this->conn->prepare(`INSERT INTO cars (manufacturer, year, color) VALUES (?, ?, ?)`);
        return $stmt->execute([$car->getManufacturer(), $car->getYear(), $car->getColor()]);
    }

    /**
     * @param int $id
     * @return Car
     * @throws PDOException
     */
    public function getCar(int $id): Car
    {
        $this->isNumericException();

        $stmt = $this->conn->prepare(`SELECT * FROM cars WHERE (id) VALUES (?)`);
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
        $stmt = $this->conn->prepare(`SELECT * FROM cars`);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * @param int $id
     * @return bool
     * @throws PDOException
     */
    public function updateCar(int $id)
    {
        $this->isNumericException($id);

        $stmt = $this->conn->prepare(`UPDATE cars SET manufacturer=?, year=?, color=? WHERE id=?`);
        $car = $this->getCar($id);
        return $stmt->execute([$car->getManufacturer(), $car->getYear(), $car->getColor(), $id]);
    }

    /**
     * @param int $id
     * @return bool
     * @throws PDOException
     */
    public function deleteCar(int $id)
    {
        $this->isNumericException($id);

        $stmt = $this->conn->prepare(`DELETE FROM cars WHERE (id) VALUES (?)`);
        return $stmt->execute($id);
    }

    public function isCarExists(int $id)
    {
        $this->isNumericException($id);

        $stmt = $this->conn->prepare(`SELECT * FROM cars WHERE id = ?`);
        $stmt->execute($id);
        if ($stmt->rowCount() > 0)
            return true;
        else
            false;


    }

}