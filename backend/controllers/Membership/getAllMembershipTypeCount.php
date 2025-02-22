<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    $query = "SELECT COUNT(*) as total_membership_types FROM membership";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            echo json_encode(["total_membership_types" => $row["total_membership_types"]]);
        } else {
            echo json_encode(["total_membership_types" => 0]);
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
