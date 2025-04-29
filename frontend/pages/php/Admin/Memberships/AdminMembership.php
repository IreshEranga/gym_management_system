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
    <link rel="stylesheet" href="../../../../css/Admin/Memberships/AdminMembership.css"> 
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
            <li class="active">
                <a href="#"><img src="../../../assets/icons/user.png" alt="memberships" style="width: 20px; height: 20px; margin-right: 10px;"> Memberships</a>
            </li>
            <li>
                <a href="../Trainers/AdminTrainer.php"><img src="../../../assets/icons/user.png" alt="trainers" style="width: 20px; height: 20px; margin-right: 10px;"> Trainers</a>
            </li>
            <li >
                <a href="../members/AdminMember.php"><img src="../../../../assets/icons/user.png" alt="members" style="width: 20px; height: 20px; margin-right: 10px;"> Members</a>
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
            <button class="btn btn-info btn-sm" style="margin-top:20px;" data-bs-toggle="modal" data-bs-target="#addMembershipModal">Add Membership</button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr class="memberTabletr" style="background-color:rgb(0, 29, 114); text-align: left; color: white;">
                        <th scope="col">Membership ID</th>
                        <th scope="col">Type</th>
                        <th scope="col">Description</th>
                        <th scope="col">Validity</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="membersTableBody"></tbody>
            </table>
        </div>
    </div>

   <!-- Add Member Modal -->
<div class="modal fade" id="addMembershipModal" tabindex="-1" aria-labelledby="addMemberLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMemberLabel">Add New Membership</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addMemberForm">
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" id="type" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" required>
                    </div>
                    <div class="mb-3">
                        <label for="expire_date" class="form-label">Validity</label>
                        <input type="text" class="form-control" id="expire_date" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Membership</button>
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
                <h5 class="modal-title" id="updateMemberLabel">Update Membership</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateMemberForm">
                    <div class="mb-3">
                        <label for="updateMembershipID" class="form-label">Membership ID</label>
                        <input type="text" class="form-control" id="updateMembershipID" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="updateType" class="form-label">Type</label>
                        <input type="text" class="form-control" id="updateType" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateDescription" class="form-label">Description</label>
                        <input type="text" class="form-control" id="updateDescription" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateValidity" class="form-label">Validity</label>
                        <input type="text" class="form-control" id="updateValidity" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update Membership</button>
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
                        <p>Are you sure you want to delete this membership?</p>
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
        function fetchMemberships() {
            fetch("../../../../../backend/controllers/Membership/getAllMembershipTypes.php")
                .then(response => response.json())
                .then(memberships => {
                    const tableBody = document.getElementById('membersTableBody');
                    tableBody.innerHTML = "";

                    memberships.forEach(membership => {
                        tableBody.innerHTML += `
                            <tr>
                                <td>${membership.membership_ID}</td>
                                <td>${membership.type}</td>
                                <td>${membership.description}</td>
                                <td>${membership.expire_date}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="showUpdateModal('${membership.membership_ID}', '${membership.type}', '${membership.description}', '${membership.expire_date}')">Update</button>

                                    <button class="btn btn-danger btn-sm" onclick="deleteMembership('${membership.membership_ID}')">Delete</button>

                                </td>
                            </tr>
                        `;
                    });
                })
                .catch(error => console.error("Error fetching memberships:", error));
        }

        document.getElementById("addMemberForm").addEventListener("submit", function(event) {
            event.preventDefault();

            const formData = {
                type: document.getElementById("type").value.trim(),
                description: document.getElementById("description").value.trim(),
                expire_date: document.getElementById("expire_date").value.trim(),
            };

            fetch("../../../../../backend/controllers/Membership/createMembership.php", {
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
                        let modalElement = document.getElementById("addMembershipModal");
                        let modalInstance = bootstrap.Modal.getInstance(modalElement);
                        if (modalInstance) {
                            modalInstance.hide();
                        }

                        // Reset the form
                        document.getElementById("addMemberForm").reset();

                        // Refresh the members table
                        fetchMemberships();

                } else {
                    alert("Error: " + (data.error || "Unknown error"));
                    showToastMessage("Error: " + (data.error || "Unknown error"), true);

                }
            })
            .catch(error => console.error("Fetch error:", error));
        });

        function showUpdateModal(membershipID, type, description, validity) {
            document.getElementById("updateMembershipID").value = membershipID;
            document.getElementById("updateType").value = type;
            document.getElementById("updateDescription").value = description;
            document.getElementById("updateValidity").value = validity;
 

            let updateModal = new bootstrap.Modal(document.getElementById("updateMemberModal"));
            updateModal.show();
        }

        document.getElementById("updateMemberForm").addEventListener("submit", function(event) {
            event.preventDefault();

            const formData = {
                membership_ID: document.getElementById("updateMembershipID").value,
                type: document.getElementById("updateType").value.trim(),
                description: document.getElementById("updateDescription").value.trim(),
                expire_date: document.getElementById("updateValidity").value.trim(),
                
            };

            fetch("../../../../../backend/controllers/Membership/updateMembership.php", {
                method: "PUT",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                showToastMessage(data.success ? data.success : "Error updating membership");

                let modalInstance = bootstrap.Modal.getInstance(document.getElementById("updateMemberModal"));
                if (modalInstance) {
                    modalInstance.hide();
                }

                fetchMemberships();
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
        //         fetchMemberships();
        //     })
        //     .catch(error => console.error("Fetch error:", error));
        // }

        let membershipToDelete = null;

    function deleteMembership(membershipID) {
        // Store the user ID in a variable before showing the modal
        membershipToDelete = membershipID;

        // Show the custom confirmation modal
        let deleteModal = new bootstrap.Modal(document.getElementById("deleteMemberModal"));
        deleteModal.show();
    }

// Event listener for the confirmation button inside the modal
    document.getElementById("confirmDeleteBtn").addEventListener("click", function() {
        if (membershipToDelete) {
            fetch("../../../../../backend/controllers/Membership/deleteMembership.php", {
                method: "DELETE",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ membership_ID: membershipToDelete })
            })
            .then(response => response.json())
            .then(data => {
                showToastMessage(data.success ? data.success : "Error deleting membership", data.success ? false : true);
                fetchMemberships(); // Refresh the members table after deletion
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


    


        window.onload = fetchMemberships;
    </script>

</body>
</html>
