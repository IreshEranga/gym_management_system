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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../../css/Admin/AdminHome.css"> 
</head>
<body>
    <!-- Include Sidebar -->
    <?php include './AdminSideBar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Welcome Admin</h1>

        <!-- Admin Cards -->
        <div class="adminCards">
            <div class="card">
                <div class="icon">
                    <img src="../../../assets/gif/user.gif" alt="Members Icon">
                </div>
                <h2>Total Members</h2>
                <p id="totalMembers">Loading...</p>
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
                    <img src="../../../assets/gif/trainer.gif" alt="Trainers Icon">
                </div>
                <h2>Trainers</h2>
                <p id="totalTrainers">Loading...</p>
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


    <script>
        function fetchTotalMembers() {
            fetch('../../../../backend/controllers/Member/getAllMemberCount.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('totalMembers').innerText = data.total_members ?? "0";
                })
                .catch(error => {
                    console.error("Error fetching total members:", error);
                    document.getElementById('totalMembers').innerText = "Error";
                });
        }

        function fetchTotalTrainers() {
            fetch('../../../../backend/controllers/Trainer/getAllTrainerCount.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('totalTrainers').innerText = data.total_trainers ?? "0";
                })
                .catch(error => {
                    console.error("Error fetching total members:", error);
                    document.getElementById('totalTrainers').innerText = "Error";
                });
        }

        // Fetch total members on page load
        window.onload = function() {
            fetchTotalMembers();
            fetchTotalTrainers();
        };

    </script>
    
    <script>
        
    </script>
</body>
</html>
