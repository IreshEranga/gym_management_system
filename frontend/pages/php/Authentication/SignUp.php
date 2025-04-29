<?php
// Enable error reporting (for debugging during development)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection settings
$servername = "localhost";
$username = "root";     // default for XAMPP
$password = "";         // default for XAMPP
$database = "gym_db";   // your actual DB name

// Create database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if all required POST data is received
if (
    isset($_POST['fullname']) &&
    isset($_POST['email']) &&
    isset($_POST['mobile']) &&
    isset($_POST['password']) &&
    isset($_POST['address']) &&
    isset($_POST['emergency_contact'])
) {
    // Sanitize and validate inputs
    $fullname          = $conn->real_escape_string(trim($_POST['fullname']));
    $email             = $conn->real_escape_string(trim($_POST['email']));
    $mobile            = $conn->real_escape_string(trim($_POST['mobile']));
    $password_hash     = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $address           = $conn->real_escape_string(trim($_POST['address']));
    $emergency_contact = $conn->real_escape_string(trim($_POST['emergency_contact']));
    $role_ID           = isset($_POST['role']) ? intval($_POST['role']) : 3; // Default to 3 (Member)
    $membership_ID     = NULL;

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    // Mobile and emergency contact validation (must be 10 digits)
    if (!preg_match('/^[0-9]{10}$/', $mobile)) {
        echo "Invalid mobile number format.";
        exit();
    }
    if (!preg_match('/^[0-9]{10}$/', $emergency_contact)) {
        echo "Invalid emergency contact number format.";
        exit();
    }

    // Prepare and execute the SQL insert query
    $stmt = $conn->prepare("INSERT INTO user 
        (name, email, mobile, password, address, emergency_contact_number, role_ID, membership_ID)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssii", $fullname, $email, $mobile, $password_hash, $address, $emergency_contact, $role_ID, $membership_ID);

    // Execute and handle result
    if ($stmt->execute()) {
        // Redirect to login page after successful registration
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
} else {
    echo "Please fill all the required fields.";
}

// Close database connection
$conn->close();
?>
