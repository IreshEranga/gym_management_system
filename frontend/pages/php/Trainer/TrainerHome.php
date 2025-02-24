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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Dashboard</title>
    <link rel="stylesheet" href="../../../css/Trainer/TrainerHome.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="dashboard-container">
        <?php include './TrainerSideBar.php'; ?>
        <main class="main-content">
            <header>
                <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
                <p><strong>User ID:</strong> <?php echo htmlspecialchars($_SESSION['user_id']); ?></p>
            </header>
            <section class="stats">
                <div class="card">
                    <h3>Total Trainees</h3>
                    <p>45</p>
                </div>
                <div class="card">
                    <h3>Upcoming Sessions</h3>
                    <ul>
                        <li>Session 1: 10:00 AM - John Doe</li>
                        <li>Session 2: 2:00 PM - Jane Smith</li>
                    </ul>
                </div>
                <div class="card">
                    <h3>Completed Sessions</h3>
                    <p>120</p>
                </div>
                <div class="card">
                    <h3>Pending Requests</h3>
                    <p>5</p>
                </div>
            </section>
        </main>
    </div>
</body>
</html>