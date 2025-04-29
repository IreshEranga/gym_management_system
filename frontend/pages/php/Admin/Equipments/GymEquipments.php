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
    <title>Admin Dashboard - Gym Equipment</title>
    <link rel="stylesheet" href="../../../../css/Admin/Equipment/AdminEquipment.css"> 
    <link rel="stylesheet" href="../../../../css/Admin/SideBar.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="sidebar">
    <div class="logo">
        <i class="fas fa-dumbbell"></i> <span>Admin - Power Fit</span>
    </div>
    <ul class="nav-links">
        <li><a href="../AdminHome.php"><img src="../../../../assets/icons/home.png" style="width: 20px;"> Home</a></li>
        <li><a href="../Memberships/AdminMembership.php"><img src="../../../../assets/icons/user.png" style="width: 20px;"> Memberships</a></li>
        <li><a href="../Trainers/AdminTrainer.php"><img src="../../../../assets/icons/user.png" style="width: 20px;"> Trainers</a></li>
        <li><a href="../Members/AdminMember.php"><img src="../../../../assets/icons/user.png" style="width: 20px;"> Members</a></li>
        
        <li class="active"><a href="#"><img src="../../../../assets/icons/user.png" style="width: 20px;"> Equipment</a></li>
    </ul>
    <div class="user-profile">
        <img src="../../../assets/images/admin.png" alt="Admin">
        <button class="btn btn-danger" id="logOutbtn" style="width: 150px;">Log Out</button>
    </div>
</div>

<div class="main-content" style="margin-left: 255px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Gym Equipment List</h3>
        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#addEquipmentModal">Add Equipment</button>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Equipment Name</th>
                <th>Last Service Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="equipmentTableBody"></tbody>
    </table>
</div>

<!-- Add Equipment Modal -->
<div class="modal fade" id="addEquipmentModal" tabindex="-1" aria-labelledby="addEquipmentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addEquipmentForm" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Equipment</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control mb-3" id="equipmentName" placeholder="Equipment Name" required>
                <input type="date" class="form-control mb-3" id="lastServiceDate" required>
                <select class="form-control" id="status">
                    <option value="Operational">Operational</option>
                    <option value="Under Maintenance">Under Maintenance</option>
                </select>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Add</button>
            </div>
        </form>
    </div>
</div>

<!-- Toast -->
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="toastMessage" class="toast text-white bg-success" role="alert">
        <div class="d-flex">
            <div class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const showToast = (msg, isError = false) => {
        const toast = document.getElementById("toastMessage");
        toast.querySelector(".toast-body").textContent = msg;
        toast.classList.remove("bg-success", "bg-danger");
        toast.classList.add(isError ? "bg-danger" : "bg-success");
        new bootstrap.Toast(toast).show();
    };

    function fetchEquipment() {
        fetch("../../../../../backend/controllers/Equipments/getAllEquipments.php")
            .then(res => res.json())
            .then(data => {
                const body = document.getElementById("equipmentTableBody");
                body.innerHTML = "";

                if (data.equipment && data.equipment.length) {
                    data.equipment.forEach(eq => {
                        body.innerHTML += `
                            <tr>
                                <td>${eq.equipment_ID}</td>
                                <td>${eq.equipment_name}</td>
                                <td>${eq.last_service_date}</td>
                                <td>${eq.status}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm edit-btn" data-id="${eq.equipment_ID}" data-name="${eq.equipment_name}" data-date="${eq.last_service_date}" data-status="${eq.status}">Edit</button>
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="${eq.equipment_ID}">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    body.innerHTML = '<tr><td colspan="5">No equipment found</td></tr>';
                }
            })
            .catch(err => showToast("Error loading equipment", true));
    }

    document.getElementById("addEquipmentForm").addEventListener("submit", function(e) {
        e.preventDefault();

        const formData = {
            equipment_name: document.getElementById("equipmentName").value.trim(),
            last_service_date: document.getElementById("lastServiceDate").value,
            status: document.getElementById("status").value
        };

        fetch("../../../../../backend/controllers/Equipments/createGymEquipment.php", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify(formData)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showToast(data.success);
                document.getElementById("addEquipmentForm").reset();
                bootstrap.Modal.getInstance(document.getElementById("addEquipmentModal")).hide();
                fetchEquipment();
            } else {
                showToast(data.error || "Error adding equipment", true);
            }
        })
        .catch(err => showToast("Fetch error: " + err, true));
    });

    document.getElementById("equipmentTableBody").addEventListener("click", function (e) {
    const target = e.target;

    // Handle delete
    if (target.classList.contains("delete-btn")) {
        const id = target.getAttribute("data-id");
        deleteEquipment(id);
    }

    // Handle edit
    if (target.classList.contains("edit-btn")) {
        const id = target.getAttribute("data-id");
        const name = target.getAttribute("data-name");
        const date = target.getAttribute("data-date");
        const status = target.getAttribute("data-status");

        const row = target.closest("tr");
        editEquipment(row, {
            equipment_ID: id,
            equipment_name: name,
            last_service_date: date,
            status: status
        });
    }
});

    function deleteEquipment(id) {
    if (!confirm("Are you sure you want to delete this equipment?")) return;

    fetch("../../../../../backend/controllers/Equipments/deleteGymEquipment.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ equipment_ID: id })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            showToast(data.success);
            fetchEquipment();
        } else {
            showToast(data.error || "Failed to delete", true);
        }
    })
    .catch(err => showToast("Delete error: " + err, true));
}

function editEquipment(row, equipment) {
    row.innerHTML = `
        <td>${equipment.equipment_ID}</td>
        <td><input class="form-control form-control-sm" value="${equipment.equipment_name}" id="editName${equipment.equipment_ID}"></td>
        <td><input type="date" class="form-control form-control-sm" value="${equipment.last_service_date}" id="editDate${equipment.equipment_ID}"></td>
        <td>
            <select class="form-select form-select-sm" id="editStatus${equipment.equipment_ID}">
                <option value="Operational" ${equipment.status === 'Operational' ? 'selected' : ''}>Operational</option>
                <option value="Under Maintenance" ${equipment.status === 'Under Maintenance' ? 'selected' : ''}>Under Maintenance</option>
            </select>
        </td>
        <td>
            <button class="btn btn-success btn-sm" onclick="saveEdit(${equipment.equipment_ID})">Save</button>
            <button class="btn btn-secondary btn-sm" onclick="fetchEquipment()">Cancel</button>
        </td>
    `;
}

function saveEdit(id) {
    const updatedData = {
        equipment_ID: id,
        equipment_name: document.getElementById(`editName${id}`).value,
        last_service_date: document.getElementById(`editDate${id}`).value,
        status: document.getElementById(`editStatus${id}`).value
    };

    fetch("../../../../../backend/controllers/Equipments/updateGymEquipment.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(updatedData)
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            showToast(data.success);
            fetchEquipment();
        } else {
            showToast(data.error || "Update failed", true);
        }
    })
    .catch(err => showToast("Update error: " + err, true));
}

    document.getElementById("logOutbtn").addEventListener("click", function () {
        window.location.href = "../../Authentication/logout.php"; 
    });

    window.onload = fetchEquipment;
</script>

</body>
</html>
