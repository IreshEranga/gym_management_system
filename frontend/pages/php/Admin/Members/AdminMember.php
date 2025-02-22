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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="sidebar">
        <div class="logo">
            <i class="fas fa-dumbbell"></i> <span>Gym Admin</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="#"><img src="../../../../assets/icons/home.png" alt="home" style="width: 20px; height: 20px; margin-right: 10px;"> Home</a>
            </li>
            <li>
                <a href="#"><img src="../../../assets/icons/user.png" alt="memberships" style="width: 20px; height: 20px; margin-right: 10px;"> Memberships</a>
            </li>
            <li>
                <a href="#"><img src="../../../assets/icons/user.png" alt="trainers" style="width: 20px; height: 20px; margin-right: 10px;"> Trainers</a>
            </li>
            <li class="active">
                <a href="#"><img src="../../../../assets/icons/user.png" alt="members" style="width: 20px; height: 20px; margin-right: 10px;"> Members</a>
            </li>
            <li>
                <a href="#"><img src="../../../assets/icons/user.png" alt="payments" style="width: 20px; height: 20px; margin-right: 10px;"> Payments</a>
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
        <div class="btns">
            <button class="btn btn-info btn-sm" style="margin-top:20px;" data-bs-toggle="modal" data-bs-target="#addMemberModal">Add Member</button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr class="memberTabletr" style="background-color:rgb(0, 29, 114); text-align: left; color: white;">
                        <th scope="col">User ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Address</th>
                        <th scope="col">Emergency Contact</th>
                        <th scope="col">Membership ID</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="membersTableBody"></tbody>
            </table>
        </div>
    </div>

   <!-- Add Member Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMemberLabel">Add New Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addMemberForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control" id="mobile" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="emergencyContact" class="form-label">Emergency Contact</label>
                        <input type="text" class="form-control" id="emergencyContact" required>
                    </div>
                    <div class="mb-3">
                        <label for="membershipID" class="form-label">Membership ID (Optional)</label>
                        <input type="text" class="form-control" id="membershipID">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Member</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <!-- Toast Message -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="toastMessage" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AJAX for fetching and adding members -->
    <script>
        function fetchMembers() {
            fetch("../../../../../backend/controllers/Member/getAllMembers.php")
                .then(response => response.json())
                .then(members => {
                    const tableBody = document.getElementById('membersTableBody');
                    tableBody.innerHTML = "";

                    members.forEach(member => {
                        tableBody.innerHTML += `
                            <tr>
                                <td>${member.User_ID}</td>
                                <td>${member.name}</td>
                                <td>${member.email}</td>
                                <td>${member.mobile}</td>
                                <td>${member.address}</td>
                                <td>${member.emergency_contact_number}</td>
                                <td>${member.membership_id ?? "N/A"}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm">Update</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                })
                .catch(error => console.error("Error fetching members:", error));
        }

        document.getElementById("addMemberForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const formData = {
        name: document.getElementById("name").value.trim(),
        email: document.getElementById("email").value.trim(),
        mobile: document.getElementById("mobile").value.trim(),
        address: document.getElementById("address").value.trim(),
        emergency_contact_number: document.getElementById("emergencyContact").value.trim(),
        membership_ID: document.getElementById("membershipID").value.trim() || null,
        password: document.getElementById("password").value.trim()
    };

    fetch("../../../../../backend/controllers/Member/createMember.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelector("#toastMessage .toast-body").textContent = data.success;
            new bootstrap.Toast(document.getElementById("toastMessage")).show();
            document.getElementById("addMemberForm").reset();
            fetchMembers(); // Refresh the table
        } else {
            alert("Error: " + (data.error || "Unknown error"));
        }
    })
    .catch(error => console.error("Fetch error:", error));
});

    


        window.onload = fetchMembers;
    </script>

</body>
</html>
