<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    $query = "SELECT COUNT(*) as total_trainers FROM user WHERE role_ID = 2";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            echo json_encode(["total_trainers" => $row["total_trainers"]]);
        } else {
            echo json_encode(["total_trainers" => 0]);
        }
        
        $stmt->close();
    } else {
        echo json_encode(["error" => "Query execution failed"]);
    }

    $conn->close();
} else {
    echo json_encode(["error" => "Invalid request method"]);
}
?>
