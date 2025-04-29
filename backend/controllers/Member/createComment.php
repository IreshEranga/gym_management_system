<?php
session_start();
include '../../config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // For AJAX
    if ($_SERVER['HTTP_ACCEPT'] === 'application/json') {
        header('Content-Type: application/json');
        http_response_code(401);
        echo json_encode(['error' => 'User not logged in']);
        exit;
    } else {
        // For form fallback
        header("Location: ../Authentication/Login.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $description = trim($_POST['description'] ?? '');

    if (empty($description)) {
        http_response_code(400);
        echo json_encode(['error' => 'Comment cannot be empty']);
        exit;
    }

    // Insert into `comment` table
    $stmt = $conn->prepare("INSERT INTO comment (User_ID, description) VALUES (?, ?)");
    if ($stmt) {
        $stmt->bind_param("is", $user_id, $description);
        if ($stmt->execute()) {
            // AJAX or regular form submission
            if ($_SERVER['HTTP_ACCEPT'] === 'application/json') {
                echo json_encode(['success' => 'Comment submitted successfully']);
            } else {
                header("Location: comment_success.html"); // Optional thank-you page
            }
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to submit comment']);
        }
        $stmt->close();
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Database error']);
    }

    $conn->close();
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Invalid request method']);
}
?>
