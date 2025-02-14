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
    <h1>Admin Home</h1>
    <h1>Welcome to Gym Dashboard</h1>
    <p><strong>User ID:</strong> <?php echo htmlspecialchars($_SESSION['user_id']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
    <p><strong>Role ID:</strong> <?php echo htmlspecialchars($_SESSION['user_role_id']); ?></p>

    <p><a href="../Authentication/Login.php">Logout</a></p>
</body>
</html>
