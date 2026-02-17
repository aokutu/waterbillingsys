<?php 
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'revenue';

class Database {
    private $connection;

    public function __construct() {
        global $host, $username, $password, $database;
        $this->connection = new mysqli($host, $username, $password, $database);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function query($sql) {
        return $this->connection->query($sql);
    }

    // Other methods for CRUD operations, etc.
}
print "xxxx";
?>
