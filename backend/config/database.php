<?php
class Database {
    private $host = "localhost";
    private $db_name = "gym_db";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Success message
            echo "<p style='color: green; font-weight: bold;'>✅ Database Connected Successfully</p>";
        } catch (PDOException $exception) {
            // Error message
            echo "<p style='color: red; font-weight: bold;'>❌ Connection failed: " . $exception->getMessage() . "</p>";
        }
        return $this->conn;
    }
}
?>
