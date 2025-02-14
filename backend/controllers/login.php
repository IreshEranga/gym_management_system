<?php
session_start();
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['User_ID'];
            $_SESSION['user_email'] = $user['email'];
            
            header("Location: ../../frontend/pages/php/Authentication/dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid password!";
            header("Location: ../../frontend/pages/php/Authentication/Login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "No account found with this email!";
        header("Location: ../../frontend/pages/php/Authentication/dashboard.php");
        exit();
    }
}
?>
