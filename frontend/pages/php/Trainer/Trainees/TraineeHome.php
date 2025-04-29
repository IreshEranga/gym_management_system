<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../css/Trainer/Trainees/TraineeHome.css">
    <link rel="stylesheet" href="../../../../css/Trainer/TrainerSideBar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Trainees</title>
</head>
<body>

<div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Trainer Panel</h2>
        <ul>
            <li><a href="../TrainerHome.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="../Trainees/TraineeHome.php" class="active"><i class="fas fa-users"></i> Trainees</a></li>
            <li><a href="../Schedules/ScheduleHome.php"><i class="fas fa-calendar-alt"></i> Schedules</a></li>
            <li><a href="../Workouts/WorkoutHome.php"><i class="fas fa-dumbbell"></i> Workouts</a></li>
        </ul>
        <a href="../Authentication/logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header>
            <h2>Trainer - Trainee List</h2>
            <button class="btn btn-primary" id="addTraineeBtn">Add Trainee</button>
        </header>

        <section class="trainee-list">
            <input type="text" class="form-control mb-3" placeholder="Search Trainee" id="searchTrainee">
            <table class="table table-striped" id="traineeTable">
                <thead>
                    <tr>
                        <th style="color: black;">ID</th>
                        <th style="color: black;">Name</th>
                        <th style="color: black;">Email</th>
                        <th style="color: black;">Phone</th>
                        <th style="color: black;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be injected via JavaScript -->
                </tbody>
            </table>
        </section>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addTraineeModal" tabindex="-1" aria-labelledby="addTraineeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add Trainee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addTraineeForm">
                    <input type="text" class="form-control mb-3" placeholder="Name" id="traineeName" required>
                    <input type="email" class="form-control mb-3" placeholder="Email" id="traineeEmail" required>
                    <input type="text" class="form-control mb-3" placeholder="Mobile" id="traineePhone" required>
                    <input type="text" class="form-control mb-3" placeholder="Membership ID" id="traineeMembershipID" required>
                    <input type="text" class="form-control mb-3" placeholder="Address" id="traineeAddress" required>
                    <input type="text" class="form-control mb-3" placeholder="Emergency Contact Number" id="traineeEmergencyContact" required>
                    <button type="submit" class="btn btn-primary w-100">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Base URL for consistency
    const baseUrl = "http://localhost/GYM_MANAGEMENT_SYSTEM/backend/controllers/Trainee/";

    // Load all trainees
    function loadTrainees() {
        $.ajax({
            url: baseUrl + "getAllTrainee.php",
            type: "GET",
            dataType: "json",
            success: function(data) {
                let rows = '';
                data.forEach(function(trainee) {
                    rows += `<tr data-user-id="${trainee.User_ID}">
                        <td>${trainee.User_ID}</td>
                        <td>${trainee.name}</td>
                        <td>${trainee.email}</td>
                        <td>${trainee.mobile}</td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" 
                                    data-user-id="${trainee.User_ID}" 
                                    data-name="${trainee.name}" 
                                    data-email="${trainee.email}" 
                                    data-phone="${trainee.mobile}"
                                    data-address="${trainee.address}"
                                    data-emergency-contact-number="${trainee.emergency_contact_number}">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn">Delete</button>
                        </td>
                    </tr>`;
                });
                $('#traineeTable tbody').html(rows);
            },
            error: function(xhr) {
                console.error("Error loading trainees:", xhr.responseText);
                alert("Failed to load trainees. Please try again.");
            }
        });
    }

    loadTrainees();

    // Open modal for adding trainee
    $('#addTraineeBtn').click(function() {
        $('#addTraineeForm')[0].reset();
        $('#addTraineeModal .modal-title').text('Add Trainee');
        $('#addTraineeForm').data('mode', 'add');
        $('#addTraineeForm button[type="submit"]').text('Add');
        $('#addTraineeModal').modal('show');
    });

    // Search filter
    $('#searchTrainee').on('input', function() {
        let value = $(this).val().toLowerCase();
        $("#traineeTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Add or update trainee
    $('#addTraineeForm').submit(function(e) {
        e.preventDefault();
        let mode = $(this).data('mode');
        let name = $('#traineeName').val().trim();
        let email = $('#traineeEmail').val().trim();
        let mobile = $('#traineePhone').val().trim();
        let password = $('#traineeMembershipID').val().trim(); // Renamed field, but sent as password
        let address = $('#traineeAddress').val().trim();
        let emergency_contact_number = $('#traineeEmergencyContact').val().trim();

        if (mode === 'add' && (!name || !email || !mobile || !password || !address || !emergency_contact_number)) {
            alert("Please fill in all required fields.");
            return;
        }
        if (mode === 'edit' && (!name || !email || !mobile || !address || !emergency_contact_number)) {
            alert("Please fill in all required fields.");
            return;
        }

        let url = mode === 'add' ? baseUrl + "createTrainee.php" : baseUrl + "updateTrainee.php";
        let method = mode === 'add' ? "POST" : "PUT";
        let data = mode === 'add'
            ? { name, email, mobile, password, address, emergency_contact_number }
            : { User_ID: $(this).data('user-id'), name, email, mobile, address, emergency_contact_number };

        $.ajax({
            url: url,
            type: method,
            contentType: "application/json",
            data: JSON.stringify(data),
            beforeSend: function() {
                $('#addTraineeForm button[type="submit"]').prop('disabled', true).text('Saving...');
            },
            success: function(response) {
                console.log(`${mode === 'add' ? 'Add' : 'Update'} response:`, response);
                $('#addTraineeModal').modal('hide');
                $('#addTraineeForm')[0].reset();
                loadTrainees();
            },
            error: function(xhr) {
                console.error(`Error ${mode === 'add' ? 'adding' : 'updating'} trainee:`, xhr.responseText);
                alert(`Failed to ${mode === 'add' ? 'add' : 'update'} trainee. Please try again.`);
            },
            complete: function() {
                $('#addTraineeForm button[type="submit"]').prop('disabled', false).text(mode === 'add' ? 'Add' : 'Update');
            }
        });
    });

    // Delete trainee
    $('#traineeTable').on('click', '.delete-btn', function() {
        let $button = $(this);
        let row = $button.closest('tr');
        let user_id = row.data('user-id');

        if (!user_id) {
            console.error("User_ID not found for this row.");
            alert("Error: Trainee ID not found.");
            return;
        }

        if (confirm("Are you sure you want to delete this trainee?")) {
            $.ajax({
                url: baseUrl + "deleteTrainee.php",
                type: "DELETE",
                contentType: "application/json",
                data: JSON.stringify({ User_ID: user_id }),
                beforeSend: function() {
                    $button.prop('disabled', true).text('Deleting...');
                },
                success: function(response) {
                    console.log("Delete response:", response);
                    loadTrainees();
                },
                error: function(xhr) {
                    console.error("Error deleting trainee:", xhr.responseText);
                    alert("Failed to delete trainee. Please try again.");
                },
                complete: function() {
                    $button.prop('disabled', false).text('Delete');
                }
            });
        }
    });

    // Edit trainee
    $('#traineeTable').on('click', '.edit-btn', function() {
        let user_id = $(this).data('user-id');
        let name = $(this).data('name');
        let email = $(this).data('email');
        let phone = $(this).data('phone');
        let address = $(this).data('address');
        let emergency_contact_number = $(this).data('emergency-contact-number');

        $('#traineeName').val(name);
        $('#traineeEmail').val(email);
        $('#traineePhone').val(phone);
        $('#traineeAddress').val(address);
        $('#traineeEmergencyContact').val(emergency_contact_number);
        $('#traineeMembershipID').val(''); // Clear membership ID (password) field for edit
        $('#addTraineeForm').data('mode', 'edit').data('user-id', user_id);
        $('#addTraineeModal .modal-title').text('Edit Trainee');
        $('#addTraineeForm button[type="submit"]').text('Update');
        $('#addTraineeModal').modal('show');
    });

    // Placeholder for view functionality
    $('#traineeTable').on('click', '.view-btn', function() {
        alert("View functionality not implemented yet.");
    });
});
</script>

</body>
</html>