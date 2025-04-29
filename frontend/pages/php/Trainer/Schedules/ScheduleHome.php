<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ./Login.php");
    exit();
}
?>

<script>
    const sessionUserID = <?php echo json_encode($_SESSION['user_id']); ?>;
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Workout Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="dashboard-container">

<?php include '../TrainerSideBar.php'; ?>
    <h2>Workout List</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#workoutModal">
        Add Workout
    </button>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Workout ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>User ID</th>
            </tr>
        </thead>
        <tbody id="workoutTableBody">
            <!-- Workout rows will be added here -->
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="workoutModal" tabindex="-1" aria-labelledby="workoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="workoutForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="workoutModalLabel">Add Workout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" class="form-control" id="title" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea class="form-control" id="description" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Create Workout</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("workoutForm");
    const modal = new bootstrap.Modal(document.getElementById('workoutModal'));
    const tableBody = document.getElementById("workoutTableBody");

    // Load all workouts on page load
    function fetchWorkouts() {
        fetch("../../../../../backend/controllers/Trainer/getAllWorkout.php")
            .then(response => response.json())
            .then(data => {
                tableBody.innerHTML = "";
                if (Array.isArray(data)) {
                    data.forEach(workout => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${workout.workout_ID}</td>
                            <td>${workout.title}</td>
                            <td>${workout.description}</td>
                            <td>${workout.user_ID ?? ''}</td>
                        `;
                        tableBody.appendChild(row);
                    });
                } else {
                    console.error("Unexpected response:", data);
                    alert(data.error || "Failed to load workouts.");
                }
            })
            .catch(error => {
                console.error("Error fetching workouts:", error);
                alert("Server error while loading workouts.");
            });
    }

    fetchWorkouts(); // Call on load

    // Create workout and refresh table
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const title = document.getElementById("title").value.trim();
        const description = document.getElementById("description").value.trim();
        const user_ID = sessionUserID;

        const workoutData = { title, description, user_ID };

        fetch("../../../../../backend/controllers/Trainer/createWorkout.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(workoutData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Workout created successfully!");
                modal.hide();
                form.reset();
                fetchWorkouts(); // Reload all workouts
            } else {
                alert("Error: " + (data.error || "Could not create workout."));
            }
        })
        .catch(error => {
            console.error("Error creating workout:", error);
            alert("Server error. Try again later.");
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
