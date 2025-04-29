<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../../../css/Admin/SideBar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <i class="fas fa-dumbbell"></i> <span>Gym Admin</span>
        </div>
        <ul class="nav-links">
            <li class="active">
                <a href="#"><img src="../../../assets/icons/home.png" alt="" style="width: 20px; height: 20px; margin-right: 10px; vertical-align: middle;"> Home</a>
            </li>
            <li>
                <a href="./Memberships/AdminMembership.php"><img src="../../../assets/icons/home.png" alt="" style="width: 20px; height: 20px; margin-right: 10px; vertical-align: middle;"> Memberships</a>
            </li>
            <li>
                <a href="./Trainers/AdminTrainer.php"><img src="../../../assets/icons/home.png" alt="" style="width: 20px; height: 20px; margin-right: 10px; vertical-align: middle;"> Trainers</a>
            </li>
            <li>
                <a href="./Members/AdminMember.php"><img src="../../../assets/icons/user.png" alt="members" style="width: 20px; height: 20px; margin-right: 10px; vertical-align: middle;"> Members</a>
            </li>
            <li>
                <a href="./Equipments/GymEquipments.php"><img src="../../../assets/icons/home.png" alt="" style="width: 20px; height: 20px; margin-right: 10px; vertical-align: middle;"> Equipments</a>
            </li>
        </ul>
        <div class="user-profile">
            <img src="../../../assets/images/admin.png" alt="Admin">
            <button type="button" class="btn btn-danger" onClick="logOut" id="logOutbtn" style="background-color: red; width: 150px; color: white; padding:10px;">Log Out</button>
        </div>
    </div>


    <script>
        document.getElementById("logOutbtn").addEventListener("click", function () {
            window.location.href = "../Authentication/logout.php"; 
        });
    </script>
</body>
</html>
