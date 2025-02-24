<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../css/Trainer/Workouts/WorkoutHome.css">
    <link rel="stylesheet" href="../../../../css/Trainer/TrainerSideBar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Trainer Workouts</title>
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
            <h2>Trainer Workouts</h2>
        </header>
        
        <section class="workout-categories">
            <h3>Workout Categories</h3>
            <div class="category-container">
                <div class="category-item">
                    <img src="../../../../assets/images/Trainer/cardio.jpg" alt="Cardio Workouts">
                    <h4>Cardio</h4>
                    <p>Boost endurance with high-intensity exercises.</p>
                    <a href="#" class="btn btn-primary">View Workouts</a>
                </div>
                <div class="category-item">
                    <img src="../../../../assets/images/Trainer/strength.png" alt="Strength Training">
                    <h4>Strength</h4>
                    <p>Enhance muscle power with weight training.</p>
                    <a href="#" class="btn btn-primary">View Workouts</a>
                </div>
                <div class="category-item">
                    <img src="../../../../assets/images/Trainer/flexibility.png" alt="Flexibility Workouts">
                    <h4>Flexibility</h4>
                    <p>Improve mobility with dynamic stretches.</p>
                    <a href="#" class="btn btn-primary">View Workouts</a>
                </div>
                <div class="category-item">
                    <img src="../../../../assets/images/Trainer/yoga.png" alt="Yoga Workouts">
                    <h4>Yoga</h4>
                    <p>Enhance balance and core strength with yoga.</p>
                    <a href="#" class="btn btn-primary">View Workouts</a>
                </div>
                <div class="category-item">
                    <img src="../../../../assets/images/Trainer/yoga.png" alt="Yoga Workouts">
                    <h4>Yoga</h4>
                    <p>Enhance balance and core strength with yoga.</p>
                    <a href="#" class="btn btn-primary">View Workouts</a>
                </div>
                <div class="category-item">
                    <img src="../../../../assets/images/Trainer/yoga.png" alt="Yoga Workouts">
                    <h4>Yoga</h4>
                    <p>Enhance balance and core strength with yoga.</p>
                    <a href="#" class="btn btn-primary">View Workouts</a>
                </div>
            </div>
        </section>
        
        <section class="workout-details">
            <h3>Featured Workout</h3>
            <div class="workout-card">
                <img src="../../../../assets/images/Trainer/fullbody.png" alt="Full Body Workout">
                <div class="workout-info">
                    <h4>Full Body Blast</h4>
                    <p>Train every muscle group with this balanced routine.</p>
                    <a href="#" class="btn btn-success">Start Workout</a>
                </div>
            </div>
        </section>
    </div>
</div>
</body>
</html>