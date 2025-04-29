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
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <div class="sidebar">
        <div class="logo">
            <i class="fas fa-dumbbell"></i> <span>Admin - Power Fit</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="../AdminHome.php"><img src="../../../../assets/icons/home.png" alt="home" style="width: 20px; height: 20px; margin-right: 10px;"> Home</a>
            </li>
            <li>
                <a href="../Memberships/AdminMembership.php"><img src="../../../assets/icons/user.png" alt="memberships" style="width: 20px; height: 20px; margin-right: 10px;"> Memberships</a>
            </li>
            <li>
                <a href="../Trainers/AdminTrainer.php"><img src="../../../assets/icons/user.png" alt="trainers" style="width: 20px; height: 20px; margin-right: 10px;"> Trainers</a>
            </li>
            <li class="active">
                <a href="#"><img src="../../../../assets/icons/user.png" alt="members" style="width: 20px; height: 20px; margin-right: 10px;"> Members</a>
            </li>
            <li>
                <a href="../Equipments/GymEquipments.php"><img src="../../../assets/icons/user.png" alt="payments" style="width: 20px; height: 20px; margin-right: 10px;"> Equipments</a>
            </li>
        </ul>
        <div class="user-profile">
            <img src="../../../assets/images/admin.png" alt="Admin">
            <button type="button" class="btn btn-danger" onClick="logOut" id="logOutbtn" style="background-color: red; width: 150px;">Log Out</button>
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

<!-- Update Member Modal -->
<div class="modal fade" id="updateMemberModal" tabindex="-1" aria-labelledby="updateMemberLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateMemberLabel">Update Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateMemberForm">
                    <div class="mb-3">
                        <label for="updateUserID" class="form-label">User ID</label>
                        <input type="text" class="form-control" id="updateUserID" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="updateName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="updateName" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="updateEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateMobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control" id="updateMobile" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="updateAddress" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateEmergencyContact" class="form-label">Emergency Contact</label>
                        <input type="text" class="form-control" id="updateEmergencyContact" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateMembershipID" class="form-label">Membership ID (Optional)</label>
                        <input type="text" class="form-control" id="updateMembershipID">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Member</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <!-- Toast Message -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="toastMessage" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteMemberModal" tabindex="-1" aria-labelledby="deleteMemberLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteMemberLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this member?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes, Delete</button>
                    </div>
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
                                    <button class="btn btn-warning btn-sm" onclick="showUpdateModal('${member.User_ID}', '${member.name}', '${member.email}', '${member.mobile}', '${member.address}', '${member.emergency_contact_number}', '${member.membership_id}')">Update</button>

                                    <button class="btn btn-danger btn-sm" onclick="deleteMember('${member.User_ID}')">Delete</button>

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
                    let toastMessage = document.getElementById("toastMessage");
                        toastMessage.querySelector(".toast-body").textContent = data.success;
                        let toast = new bootstrap.Toast(toastMessage);
                        toast.show();

                        // Hide the modal
                        let modalElement = document.getElementById("addMemberModal");
                        let modalInstance = bootstrap.Modal.getInstance(modalElement);
                        if (modalInstance) {
                            modalInstance.hide();
                        }

                        // Reset the form
                        document.getElementById("addMemberForm").reset();

                        // Refresh the members table
                        fetchMembers();

                } else {
                    alert("Error: " + (data.error || "Unknown error"));
                    showToastMessage("Error: " + (data.error || "Unknown error"), true);

                }
            })
            .catch(error => console.error("Fetch error:", error));
        });

        function showUpdateModal(userID, name, email, mobile, address, emergencyContact, membershipID) {
            document.getElementById("updateUserID").value = userID;
            document.getElementById("updateName").value = name;
            document.getElementById("updateEmail").value = email;
            document.getElementById("updateMobile").value = mobile;
            document.getElementById("updateAddress").value = address;
            document.getElementById("updateEmergencyContact").value = emergencyContact;
            document.getElementById("updateMembershipID").value = membershipID;

            let updateModal = new bootstrap.Modal(document.getElementById("updateMemberModal"));
            updateModal.show();
        }

        document.getElementById("updateMemberForm").addEventListener("submit", function(event) {
            event.preventDefault();

            const formData = {
                User_ID: document.getElementById("updateUserID").value,
                name: document.getElementById("updateName").value.trim(),
                email: document.getElementById("updateEmail").value.trim(),
                mobile: document.getElementById("updateMobile").value.trim(),
                address: document.getElementById("updateAddress").value.trim(),
                emergency_contact_number: document.getElementById("updateEmergencyContact").value.trim(),
                membership_ID: document.getElementById("updateMembershipID").value.trim() || null
            };

            fetch("../../../../../backend/controllers/Member/updateMember.php", {
                method: "PUT",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                showToastMessage(data.success ? data.success : "Error updating member");

                let modalInstance = bootstrap.Modal.getInstance(document.getElementById("updateMemberModal"));
                if (modalInstance) {
                    modalInstance.hide();
                }

                fetchMembers();
            })
            .catch(error => console.error("Fetch error:", error));
        });

        // function deleteMember(userID) {
        //     if (!confirm("Are you sure you want to delete this member?")) return;

        //     fetch("../../../../../backend/controllers/Member/deleteMember.php", {
        //         method: "DELETE",
        //         headers: { "Content-Type": "application/json" },
        //         body: JSON.stringify({ User_ID: userID })
        //     })
        //     .then(response => response.json())
        //     .then(data => {
        //         showToastMessage(data.success ? data.success : "Error deleting member");
        //         fetchMembers();
        //     })
        //     .catch(error => console.error("Fetch error:", error));
        // }

        let userToDelete = null; // Store the User ID of the member to be deleted

    function deleteMember(userID) {
        // Store the user ID in a variable before showing the modal
        userToDelete = userID;

        // Show the custom confirmation modal
        let deleteModal = new bootstrap.Modal(document.getElementById("deleteMemberModal"));
        deleteModal.show();
    }

// Event listener for the confirmation button inside the modal
    document.getElementById("confirmDeleteBtn").addEventListener("click", function() {
        if (userToDelete) {
            fetch("../../../../../backend/controllers/Member/deleteMember.php", {
                method: "DELETE",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ User_ID: userToDelete })
            })
            .then(response => response.json())
            .then(data => {
                showToastMessage(data.success ? data.success : "Error deleting member", data.success ? false : true);
                fetchMembers(); // Refresh the members table after deletion
                // Close the modal
                let modalInstance = bootstrap.Modal.getInstance(document.getElementById("deleteMemberModal"));
                modalInstance.hide();
            })
            .catch(error => {
                showToastMessage("Fetch error: " + error, true);
            });
        }
    });


        function showToastMessage(message, isError = false) {
            let toastMessage = document.getElementById("toastMessage");
            toastMessage.querySelector(".toast-body").textContent = message;

            // Set the toast color based on success or error
            if (isError) {
                toastMessage.classList.remove('bg-success');
                toastMessage.classList.add('bg-danger'); // Red for errors
            } else {
                toastMessage.classList.remove('bg-danger');
                toastMessage.classList.add('bg-success'); // Green for success
            }

            let toast = new bootstrap.Toast(toastMessage);
            toast.show();
        }

        
        document.getElementById("logOutbtn").addEventListener("click", function () {
            window.location.href = "../../Authentication/logout.php"; 
        });


    


        window.onload = fetchMembers;
    </script>

</body>
</html>
