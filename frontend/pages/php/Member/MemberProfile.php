<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Authentication/Login.php");
    exit();
}

$user_id = $_SESSION['user_id']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Power Fit Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/Member/MemberProfile.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const userId = <?php echo json_encode($user_id); ?>; 

            fetch(`../../../../backend/controllers/User/getAllUserData.php?user_id=${userId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        document.getElementById("profile-info").innerHTML = `<p class="text-danger">${data.error}</p>`;
                    } else {
                        document.getElementById("user-name").textContent = data.name;
                        document.getElementById("user-email").textContent = data.email;
                        document.getElementById("user-mobile").textContent = data.mobile;
                        document.getElementById("user-address").textContent = data.address;
                        document.getElementById("user-emergency").textContent = data.emergency_contact_number;
                        document.getElementById("user-membership").textContent = data.membership_id;
                    }
                })
                .catch(error => console.error("Error fetching data:", error));
        });
    </script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Power Fit</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="./MemberHome.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="./updateMember.php">update</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="../Authentication/Login.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile Section -->
    <div class="container mt-5 profileContainer">
        <div class="profile-card">
            <div class="profile_img">
                <img src="../../../assets/images/userProfile.png" alt="User Image">
            </div>
            <h3 id="user-name"></h3>
            <p><strong>Email:</strong> <span id="user-email"></span></p>
            <p><strong>Mobile:</strong> <span id="user-mobile"></span></p>
            <p><strong>Address:</strong> <span id="user-address"></span></p>
            <p><strong>Emergency Contact:</strong> <span id="user-emergency"></span></p>
            <p><strong>Membership ID:</strong> <span id="user-membership"></span></p>
        </div>
        <div id="profile-info" class="text-center"></div>
    </div>
</body>
</html>
