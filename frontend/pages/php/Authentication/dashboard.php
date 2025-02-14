<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ./Login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to Gym Dashboard</h1>
    <p>Hello, <strong><?php echo htmlspecialchars($_SESSION['user_email']); ?></strong></p>
    
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
