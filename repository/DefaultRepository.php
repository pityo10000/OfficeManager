<?php


class DefaultRepository {
    const DB_INI_FILE_PATH = "database.ini";

    private $servername;
    private $username;
    private $password;
    private $dbname;

    private $connection;

    public function __construct() {
        $dbProps = parse_ini_file(self::DB_INI_FILE_PATH);

        $this->servername = $dbProps["servername"];
        $this->username = $dbProps["username"];
        $this->password = $dbProps["password"];
        $this->dbname = $dbProps["dbname"];

        $this->connect();
    }

    private function connect() {
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function __destruct() {
        $this->connection->close();
    }

    protected function runQuery($query) {
        $result = $this->connection->query($query);
        return $result;
    }

    protected function retrieveNextId($table) {
        $results = $this->runQuery("
        SELECT MAX(T.ID) + 1 AS ID
        FROM " . $table . " T");
        $result = $results->fetch_assoc();
        return $result['ID'];
    }

}