<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    $query = "SELECT COUNT(*) as total_members FROM user WHERE role_ID = 3";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            echo json_encode(["total_members" => $row["total_members"]]);
        } else {
            echo json_encode(["total_members" => 0]);
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
