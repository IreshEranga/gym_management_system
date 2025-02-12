<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    // Login method
    public function login() {
        session_start();
        header("Content-Type: application/json");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents("php://input"), true);

            if (!isset($data['email']) || !isset($data['password'])) {
                echo json_encode(["error" => "Email and password are required"]);
                http_response_code(400);
                exit();
            }

            $email = $data['email'];
            $password = $data['password'];

            $userModel = new User();
            $user = $userModel->login($email, $password); 

            if ($user) {

                $role_name = $userModel->getRoleNameByRoleId($user['role_ID']);

                $_SESSION['user_id'] = $user['User_ID'];
                $_SESSION['role'] = $user['role_ID'];

                echo json_encode([
                    "message" => "Login successful",
                    "user_id" => $user['User_ID'],
                    "role_id" => $user['role_ID'],
                    "role"    => $role_name
                ]);
                http_response_code(200);
            } else {
                echo json_encode(["error" => "Invalid email or password"]);
                http_response_code(401);
            }
        } else {
            echo json_encode(["error" => "Invalid request method"]);
            http_response_code(405);
        }
    }

    // Logout method
    public function logout() {
        session_start();
        session_destroy();
        header("Content-Type: application/json");
        echo json_encode(["message" => "Logout successful"]);
        http_response_code(200);
    }

    // Register method
    public function register() {
        session_start();
        header("Content-Type: application/json");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents("php://input"), true);

            if (!isset($data['name']) || !isset($data['email']) || !isset($data['password'])) {
                echo json_encode(["error" => "Name, email, and password are required"]);
                http_response_code(400);
                exit();
            }

            $name = $data['name'];
            $email = $data['email'];
            $password = $data['password']; // The password should be hashed before storing it

            $userModel = new User();
            $success = $userModel->register(
                $name, $email, $password, $data['mobile'], $data['address'], $data['emergency_contact_number'], $data['role_ID']
            );

            if ($success) {
                echo json_encode(["message" => "User registered successfully"]);
                http_response_code(200);
            } else {
                echo json_encode(["error" => "Registration failed"]);
                http_response_code(500);
            }
        } else {
            echo json_encode(["error" => "Invalid request method"]);
            http_response_code(405);
        }
    }
}

// Handle API request
$authController = new AuthController();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'login') {
    $authController->login();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'logout') {
    $authController->logout();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'register') {
    $authController->register();
} else {
    echo json_encode(["error" => "Invalid API request"]);
    http_response_code(400);
}
?>
