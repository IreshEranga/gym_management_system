<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../css/Trainer/Schedules/ScheduleHome.css">
    <link rel="stylesheet" href="../../../../css/Trainer/TrainerSideBar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Trainer Schedule</title>
</head>
<body>

<div class="dashboard-container">
    <div class="sidebar">
    <h2>Trainer Panel</h2>
    <ul>
        <li><a href="../TrainerHome.php" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="../Trainees/TraineeHome.php"><i class="fas fa-users"></i> Trainees</a></li>
        <li><a href="../Schedules/ScheduleHome.php"><i class="fas fa-calendar-alt"></i> Schedules</a></li>
        <li><a href="../Workouts/WorkoutHome.php"><i class="fas fa-dumbbell"></i> Workouts</a></li>
    </ul>
    <a href="../Authentication/logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="main-content">
        <header>
            <h2>Trainer Schedule</h2>
        </header>

        <!-- Button to Open Add Schedule Modal -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#scheduleModal">
            <i class="fas fa-plus"></i> Add Schedule
        </button>

        <!-- Schedule Table -->
        <div class="schedule-container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Client Name</th>
                        <th>Session Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add/Edit Schedule Modal -->
<div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleModalLabel">Add/Edit Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="scheduleForm">
                    <input type="hidden" id="schedule_id">
                    <div class="mb-3">
                        <label>Date</label>
                        <input type="date" class="form-control" id="date" required>
                    </div>
                    <div class="mb-3">
                        <label>Time</label>
                        <input type="time" class="form-control" id="time" required>
                    </div>
                    <div class="mb-3">
                        <label>Client Name</label>
                        <input type="text" class="form-control" id="client_name" required>
                    </div>
                    <div class="mb-3">
                        <label>Session Type</label>
                        <select class="form-control" id="session_type">
                            <option>Personal Training</option>
                            <option>Group Class</option>
                            <option>Cardio</option>
                            <option>Strength Training</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Save Schedule</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
    $(".edit-btn").click(function () {
        $("#schedule_id").val($(this).data("id"));
        $("#date").val($(this).data("date"));
        $("#time").val($(this).data("time"));
        $("#client_name").val($(this).data("client"));
        $("#session_type").val($(this).data("session"));
        $("#scheduleModalLabel").text("Edit Schedule");
    });

    $(".delete-btn").click(function () {
        if (confirm("Are you sure you want to delete this schedule?")) {
            let scheduleId = $(this).data("id");
            $.post("../../../../api/delete_schedule.php", { id: scheduleId }, function (response) {
                location.reload();
            });
        }
    });

    $("#scheduleForm").submit(function (event) {
        event.preventDefault();
        let scheduleData = {
            id: $("#schedule_id").val(),
            date: $("#date").val(),
            time: $("#time").val(),
            client_name: $("#client_name").val(),
            session_type: $("#session_type").val(),
        };

        $.post("../../../../api/save_schedule.php", scheduleData, function (response) {
            location.reload();
        });
    });
});
</script>
</body>
</html>