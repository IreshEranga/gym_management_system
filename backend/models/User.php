<?php
require_once __DIR__ . '/../config/database.php';

class User {
    private $conn;
    private $table_name = "user";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Login method to compare MD5 hashed passwords
    public function login($email, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && md5($password) == $user['password']) {
            return $user; 
        }

        return false; // Return false if password doesn't match or user doesn't exist
    }

    // Get role name based on role_id
    public function getRoleNameByRoleId($role_ID) {
        $query = "SELECT role FROM roles WHERE role_ID = :role_ID LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":role_ID", $role_ID);
        $stmt->execute();

        $role = $stmt->fetch(PDO::FETCH_ASSOC);
        return $role ? $role['role'] : 'Unknown'; 
    }

    // Method to register a user with MD5 password hashing
    public function register($name, $email, $password, $mobile, $address, $emergency_contact_number, $role_ID) {
        $query = "INSERT INTO " . $this->table_name . " (name, email, mobile, password, address, emergency_contact_number, role_ID) 
                  VALUES (:name, :email, :mobile, :password, :address, :emergency_contact_number, :role_ID)";
        $stmt = $this->conn->prepare($query);

        // Hash the password using MD5 before storing
        $hashed_password = md5($password);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":mobile", $mobile);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":emergency_contact_number", $emergency_contact_number);
        $stmt->bindParam(":role_ID", $role_ID);

        if ($stmt->execute()) {
            return true; // User successfully registered
        }

        return false; // Registration failed
    }
}
?>
