<?php

class DBConnection {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "tekaya_db";
    private $database_connection;
    private static $instance = null;

    // Private constructor to prevent creating a new instance with 'new'
    private function __construct() {
        $this->database_connection = $this->database_connect(
            $this->host,
            $this->username,
            $this->password,
            $this->db_name
        );
    }

    // Singleton method to get the instance
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new DBConnection();
        }
        return self::$instance;
    }

    // Connection method
    private function database_connect($database_host, $database_username, $database_password, $db_name) {
        $connection = mysqli_connect($database_host, $database_username, $database_password, $db_name);

        if (!$connection) {
            throw new Exception("Database connection error: " . mysqli_connect_error());
        }
        return $connection;
    }

    // Example method to query the database
    public function getConnection() {
        return $this->database_connection;
    }
}

?>
