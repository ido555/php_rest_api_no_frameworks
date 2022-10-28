<?php


class CarModel extends DatabaseConn
{

    public function addCar(Car $car)
    {
        if (!($car instanceof Car))
            throw new TypeError();

        $stmt = $this->conn->prepare(`INSERT INTO cars (manufacturer, year, color) VALUES (?, ?, ?)`);
        return $stmt->execute($car->getManufacturer(), $car->getYear(), $car->getColor());
    }

    public function getCar(int $id){
        if (!is_numeric($id))
            throw new TypeError();

        $stmt = $this->conn->prepare(`SELECT * FROM cars WHERE (id) VALUES (?)`);
        $stmt->execute($id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Car');
        return $stmt->fetch();
    }

    public function getAllCars(){
        $stmt = $this->conn->prepare(`SELECT * FROM cars`);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updateCar(int $id){
        if (!is_numeric($id))
            throw new TypeError();

        $stmt = $this->conn->prepare(`UPDATE cars SET manufacturer=?, year=?, color=?`);
        return $stmt->execute($id);
    }

    public function deleteCar(int $id){
        if (!is_numeric($id))
            throw new TypeError();

        $stmt = $this->conn->prepare(`DELETE FROM cars WHERE (id) VALUES (?)`);
        return $stmt->execute($id);
    }


}