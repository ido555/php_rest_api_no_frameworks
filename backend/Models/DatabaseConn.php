<?php

require_once __ROOT__ . "Config/DevEnv.php";

class DatabaseConn
{
    protected ?pdo $conn;

    public function __construct()
    {

        try {
            $host = getenv("dbHost");
            $dbName = getenv("dbName");
            $user = getenv("dbUser");
            $pass = getenv("dbPass");

            $this->conn = new pdo("mysql:host=$host;dbname=$dbName;user=$user;password:$pass");
//          make sure the PDO will throw an exception to alert of any problems
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

}