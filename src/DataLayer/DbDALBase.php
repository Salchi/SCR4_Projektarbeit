<?php

namespace DataLayer;

class DbDALBase {

    private $server;
    private $userName;
    private $password;
    private $database;

    public function __construct($server, $userName, $password, $database) {
        $this->server = $server;
        $this->userName = $userName;
        $this->password = $password;
        $this->database = $database;
    }

    protected function getConnection() {
        $con = new \mysqli($this->server, $this->userName, $this->password, $this->database);

        if (!$con) {
            die('Unable to connect to database. Error: ' . mysqli_connect_errno());
        }

        return $con;
    }

    protected function extecuteQuery($connection, $query) {
        $result = $connection->query($query);

        if (!$result) {
            die("Error in query '$query': " . $connection->errno);
        }

        return $result;
    }

    protected function executeStatement($connection, $query, $bindFunc) {
        $statement = $connection->prepare($query);

        if (!$statement) {
            die("Error in statement '$query'.");
        }

        $bindFunc($statement);

        if (!$statement->execute()) {
            die("Error executing statement '$query'." . $statement->errno);
        }

        return $statement;
    }

}
