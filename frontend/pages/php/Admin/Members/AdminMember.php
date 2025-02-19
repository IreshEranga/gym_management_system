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
    <link rel="stylesheet" href="../../../../css/Admin/Members/AdminMember.css"> 
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
                <a href="#"><img src="../../../../assets/icons/home.png" alt="" style="width: 20px; height: 20px; margin-right: 10px; vertical-align: middle;"> Home</a>
            </li>
            <li>
                <a href="#"><img src="../../../assets/icons/user.png" alt="" style="width: 20px; height: 20px; margin-right: 10px; vertical-align: middle;"> Memberships</a>
            </li>
            <li>
                <a href="#"><img src="../../../assets/icons/user.png" alt="" style="width: 20px; height: 20px; margin-right: 10px; vertical-align: middle;"> Trainers</a>
            </li>
            <li class="active">
                <a href="#"><img src="../../../../assets/icons/user.png" alt="members" style="width: 20px; height: 20px; margin-right: 10px; vertical-align: middle;"> Members</a>
            </li>
            <li>
                <a href="#"><img src="../../../assets/icons/user.png" alt="" style="width: 20px; height: 20px; margin-right: 10px; vertical-align: middle;"> Payments</a>
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
        <h1>Members</h1>

    </div>
</body>
</html>
