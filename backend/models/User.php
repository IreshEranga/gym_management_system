<?php
require_once "../config/database.php"; // Adjust path as needed

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function login($email, $password) {
        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user;
            } else {
                error_log("Password mismatch for email: " . $email);
            }
        } else {
            error_log("User not found with email: " . $email);
        }
        
        return false;
    }
    

    public function getRoleNameByRoleId($role_ID) {
        $query = "SELECT role_name FROM roles WHERE role_ID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$role_ID]);

        $role = $stmt->fetch(PDO::FETCH_ASSOC);
        return $role ? $role['role_name'] : "Unknown";
    }
}
?>
