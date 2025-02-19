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
    <title>Admin Dashboard - Members</title>
    <link rel="stylesheet" href="../../../../css/Admin/AdminHome.css"> 
    <link rel="stylesheet" href="../../../../css/Admin/SideBar.css"> 
</head>
<body>
    <!-- Include Sidebar -->
    <!-- <?php include '../AdminSideBar.php'; ?> -->
    <div class="sidebar">
        <div class="logo">
            <i class="fas fa-dumbbell"></i> <span>Gym Admin</span>
        </div>
        <ul class="nav-links">
            <li >
                <a href="#"><img src="../../../assets/icons/user.png" alt=""> Home</a>
            </li>
            <li>
                <a href="#"><i class="fas fa-chart-line"></i> Memberships</a>
            </li>
            <li>
                <a href="#"><i class="fas fa-shopping-cart"></i> Trainers</a>
            </li>
            <li class="active">
                <a href="#"><img src="../../../../assets/icons/user.png" alt="members"> Members</a>
            </li>
            <li>
                <a href="#"><i class="fas fa-users"></i> Payments</a>
            </li>
        </ul>
        <div class="user-profile">
            <img src="../../../assets/images/admin.png" alt="Admin">
            <span>Admin</span>
            <i class="fas fa-chevron-down"></i>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Welcome Admindfg</h1>

        <!-- Admin Cards -->
        <div class="adminCards">
            <div class="card">
                <div class="icon">
                    <img src="../../../assets/gif/user.gif" alt="Members Icon">
                </div>
                <h2>Total Members</h2>
                <p>250</p>
            </div>

            <div class="card">
                <div class="icon">
                    <img src="../../../assets/icons/workouts.svg" alt="Workouts Icon">
                </div>
                <h2>Active Workouts</h2>
                <p>45</p>
            </div>

            <div class="card">
                <div class="icon">
                    <img src="../../../assets/icons/revenue.svg" alt="Revenue Icon">
                </div>
                <h2>Revenue</h2>
                <p>$12,500</p>
            </div>
        </div>

        <!-- Second Row -->
        <div class="adminCards">
            <div class="card">
                <div class="icon">
                    <img src="../../../assets/icons/trainers.svg" alt="Trainers Icon">
                </div>
                <h2>Trainers</h2>
                <p>10</p>
            </div>

            <div class="card">
                <div class="icon">
                    <img src="../../../assets/icons/subscriptions.svg" alt="Subscriptions Icon">
                </div>
                <h2>New Subscriptions</h2>
                <p>120</p>
            </div>

            <div class="card">
                <div class="icon">
                    <img src="../../../assets/icons/sessions.svg" alt="Sessions Icon">
                </div>
                <h2>Upcoming Sessions</h2>
                <p>30</p>
            </div>
        </div>
    </div>
</body>
</html>
