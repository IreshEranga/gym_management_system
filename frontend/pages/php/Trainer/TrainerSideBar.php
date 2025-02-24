<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../../../css/Trainer/TrainerSideBar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="sidebar">
    <h2>Trainer Panel</h2>
    <ul>
        <li><a href="./TrainerHome.php" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="./Trainees/TraineeHome.php"><i class="fas fa-users"></i> Trainees</a></li>
        <li><a href="./Schedules/ScheduleHome.php"><i class="fas fa-calendar-alt"></i> Schedules</a></li>
        <li><a href="./Workouts/WorkoutHome.php"><i class="fas fa-dumbbell"></i> Workouts</a></li>
    </ul>
    <a href="../Authentication/logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</body>
</html>