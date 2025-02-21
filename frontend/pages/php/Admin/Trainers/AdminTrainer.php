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
    <link rel="stylesheet" href="../../../../css/Admin/Trainer/AdminTrainer.css"> 
    <link rel="stylesheet" href="../../../../css/Admin/SideBar.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    
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
            <li class="active">
                <a href="#"><img src="../../../assets/icons/user.png" alt="" style="width: 20px; height: 20px; margin-right: 10px; vertical-align: middle;"> Trainers</a>
            </li>
            <li >
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
        

        <div class="table-responsive">
            <table class="table table-striped" style="">
                <thead>
                    <tr class="memberTabletr" style="background-color:rgb(0, 29, 114); text-align: left; color: white;">
                        <th scope="col" style="padding: 8px; border: 1px solid #ddd;">User ID</th>
                        <th scope="col" style="padding: 8px; border: 1px solid #ddd;">Name</th>
                        <th scope="col" style="padding: 8px; border: 1px solid #ddd;">Email</th>
                        <th scope="col" style="padding: 8px; border: 1px solid #ddd;">Mobile</th>
                        <th scope="col" style="padding: 8px; border: 1px solid #ddd;">Address</th>
                        <th scope="col" style="padding: 8px; border: 1px solid #ddd;">Emergency Contact</th>
                        <th scope="col" style="padding: 8px; border: 1px solid #ddd;">Actions</th>
                    </tr>
                </thead>
                <tbody id="membersTableBody">
                    
                </tbody>
            </table>
        </div>
        
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AJAX for fetch member data -->
    <script>
        function fetchTrainers() {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "../../../../../backend/controllers/Trainer/getAllTrainers.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.onload = function() {
                if (xhr.status === 200) {
                    const trainers = JSON.parse(xhr.responseText); // Parse the JSON response

                    if (trainers.error) {
                        alert(trainers.error);  // Show error if no trainers found
                    } else {
                        const tableBody = document.getElementById('membersTableBody');
                        tableBody.innerHTML = ""; // Clear any previous rows

                        // Loop through the members and add rows to the table
                        trainers.forEach(function(trainer) {
                            const row = document.createElement("tr");

                            row.innerHTML = `
                                <td scope="row">${trainer.User_ID}</td>
                                <td scope="row">${trainer.name}</td>
                                <td scope="row">${trainer.email}</td>
                                <td scope="row">${trainer.mobile}</td>
                                <td scope="row">${trainer.address}</td>
                                <td scope="row">${trainer.emergency_contact_number}</td>
                                <td scope="row">
                                    <button onclick="updateTariner('\${trainer.User_ID}')" class="btn btn-warning btn-sm">Update</button>
                                    <button onclick="deleteTrainer('\${trainer.User_ID}')" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            `;
                            tableBody.appendChild(row);
                        });
                    }
                } else {
                    console.error("Error fetching members:", xhr.statusText);
                }
            };

            xhr.onerror = function() {
                console.error("Request failed");
            };

            xhr.send();
        }

        // Call the fetchMembers function when the page loads
        window.onload = function() {
            fetchTrainers();
        };
    </script>
</body>
</html>
