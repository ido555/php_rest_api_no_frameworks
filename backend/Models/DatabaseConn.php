<?php

require_once("../Config/DevEnv.php");

class DatabaseConn
{
    protected ?pdo $conn;

    public function __construct()
    {
        try {
            $host = $_ENV["dbHost"];
            $dbName = $_ENV["dbName"];
            $dsn = `mysql:host=$host;dbname=$dbName`;

            $user = $_ENV["dbUser"];
            $pass = $_ENV["dbPass"];

            $this->conn = new pdo($dsn, $user, $pass);
//          make sure the PDO will throw an exception to alert of any problems
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

}