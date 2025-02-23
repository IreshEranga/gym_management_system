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
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>john@example.com</td>
                        <td>123-456-7890</td>
                        <td>
                            <button class="btn btn-info btn-sm">View</button>
                            <button class="btn btn-warning btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
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
          <input type="text" class="form-control mb-3" placeholder="Phone" id="traineePhone" required>
          <button type="submit" class="btn btn-primary w-100">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    $('#addTraineeBtn').click(function() {
        $('#addTraineeModal').modal('show');
    });

    $('#searchTrainee').on('input', function() {
        let value = $(this).val().toLowerCase();
        $("#traineeTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    $('#addTraineeForm').submit(function(event) {
        event.preventDefault();
        let name = $('#traineeName').val();
        let email = $('#traineeEmail').val();
        let phone = $('#traineePhone').val();
        
        if (name && email && phone) {
            let newRow = `<tr>
                <td>2</td>
                <td>${name}</td>
                <td>${email}</td>
                <td>${phone}</td>
                <td>
                    <button class="btn btn-info btn-sm">View</button>
                    <button class="btn btn-warning btn-sm">Edit</button>
                    <button class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>`;
            $('#traineeTable tbody').append(newRow);
            $('#addTraineeModal').modal('hide');
            $('#addTraineeForm')[0].reset();
        }
    });
});
</script>

</body>
</html>