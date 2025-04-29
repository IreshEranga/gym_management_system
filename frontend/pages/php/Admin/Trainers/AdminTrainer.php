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
    <title>Admin Dashboard - Trainers</title>
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
                <a href="../AdminHome.php"><img src="../../../../assets/icons/home.png" alt="" style="width: 20px; height: 20px; margin-right: 10px; vertical-align: middle;"> Home</a>
            </li>
            <li>
                <a href="../Memberships/AdminMembership.php"><img src="../../../assets/icons/user.png" alt="" style="width: 20px; height: 20px; margin-right: 10px; vertical-align: middle;"> Memberships</a>
            </li>
            <li class="active">
                <a href="#"><img src="../../../assets/icons/user.png" alt="" style="width: 20px; height: 20px; margin-right: 10px; vertical-align: middle;"> Trainers</a>
            </li>
            <li >
                <a href="../Members/AdminMember.php"><img src="../../../../assets/icons/user.png" alt="members" style="width: 20px; height: 20px; margin-right: 10px; vertical-align: middle;"> Members</a>
            </li>
            <li>
                <a href="../Equipments/GymEquipments.php"><img src="../../../assets/icons/user.png" alt="" style="width: 20px; height: 20px; margin-right: 10px; vertical-align: middle;"> Equipments</a>
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
            <button class="btn btn-info btn-sm" style="margin-top:20px;" data-bs-toggle="modal" data-bs-target="#addMemberModal">Add Trainer</button>
        </div>
        

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

       <!-- Add Trainer Modal -->
    <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMemberLabel">Add New Trainer</h5>
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
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Trainer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Trainer Modal -->
<div class="modal fade" id="updateMemberModal" tabindex="-1" aria-labelledby="updateMemberLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateMemberLabel">Update Trainer</h5>
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
                    
                    <button type="submit" class="btn btn-primary">Update Trainer</button>
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
                        <p>Are you sure you want to delete this trainer?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes, Delete</button>
                    </div>
                </div>
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
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="showUpdateModal('${trainer.User_ID}', '${trainer.name}', '${trainer.email}', '${trainer.mobile}', '${trainer.address}', '${trainer.emergency_contact_number}')">Update</button>

                                    <button class="btn btn-danger btn-sm" onclick="deleteMember('${trainer.User_ID}')">Delete</button>

                                </td>
                            `;
                            tableBody.appendChild(row);
                        });
                    }
                } else {
                    console.error("Error fetching trainers:", xhr.statusText);
                }
            };

            xhr.onerror = function() {
                console.error("Request failed");
            };

            xhr.send();
        }

        document.getElementById("addMemberForm").addEventListener("submit", function(event) {
            event.preventDefault();

            const formData = {
                name: document.getElementById("name").value.trim(),
                email: document.getElementById("email").value.trim(),
                mobile: document.getElementById("mobile").value.trim(),
                address: document.getElementById("address").value.trim(),
                emergency_contact_number: document.getElementById("emergencyContact").value.trim(),
                //membership_ID: document.getElementById("membershipID").value.trim() || null,
                password: document.getElementById("password").value.trim()
            };

            fetch("../../../../../backend/controllers/Trainer/createTrainer.php", {
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

        function showUpdateModal(userID, name, email, mobile, address, emergencyContact) {
            document.getElementById("updateUserID").value = userID;
            document.getElementById("updateName").value = name;
            document.getElementById("updateEmail").value = email;
            document.getElementById("updateMobile").value = mobile;
            document.getElementById("updateAddress").value = address;
            document.getElementById("updateEmergencyContact").value = emergencyContact;
            //document.getElementById("updateMembershipID").value = membershipID;

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
                //membership_ID: document.getElementById("updateMembershipID").value.trim() || null
            };

            fetch("../../../../../backend/controllers/Trainer/updateTrainer.php", {
                method: "PUT",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                showToastMessage(data.success ? data.success : "Error updating trainer");

                let modalInstance = bootstrap.Modal.getInstance(document.getElementById("updateMemberModal"));
                if (modalInstance) {
                    modalInstance.hide();
                }

                fetchTrainers();
            })
            .catch(error => console.error("Fetch error:", error));
        });

        let userToDelete = null; // Store the User ID of the member to be deleted

    function deleteMember(userID) {
        // Store the user ID in a variable before showing the modal
        userToDelete = userID;

        // Show the custom confirmation modal
        let deleteModal = new bootstrap.Modal(document.getElementById("deleteMemberModal"));
        deleteModal.show();
    }

    document.getElementById("confirmDeleteBtn").addEventListener("click", function() {
        if (userToDelete) {
            fetch("../../../../../backend/controllers/Trainer/deleteTrainer.php", {
                method: "DELETE",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ User_ID: userToDelete })
            })
            .then(response => response.json())
            .then(data => {
                showToastMessage(data.success ? data.success : "Error deleting trainer", data.success ? false : true);
                fetchTrainers(); // Refresh the members table after deletion
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


       
        window.onload = function() {
            fetchTrainers();
        };
    </script>
</body>
</html>
