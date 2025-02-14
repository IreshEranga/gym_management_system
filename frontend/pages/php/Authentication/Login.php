<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Gym Management</title>
    <link rel="stylesheet" href="">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <form id="loginForm">
            <input type="email" name="email" id="email" placeholder="Enter Email" required>
            <input type="password" name="password" id="password" placeholder="Enter Password" required>
            <button type="submit">Login</button>
        </form>
        <p id="errorMessage" style="color: red;"></p>
    </div>

    <script>
    $(document).ready(function() {
        $("#loginForm").submit(function(event) {
            event.preventDefault();
            var email = $("#email").val();
            var password = $("#password").val();

            $.ajax({
                url: "http://localhost/gym_management_system/backend/controllers/AuthController.php?action=login",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify({ email: email, password: password }),
                success: function(response) {
                    if (response.role_id == 1) {
                        window.location.href = "../Admin/AdminHome.php";
                     }// else if (response.role_id == 2) {
                    //     window.location.href = "dashboard_trainer.php";
                    // } else {
                    //     window.location.href = "dashboard_member.php";
                    // }
                },
                error: function(xhr) {
                    $("#errorMessage").text(xhr.responseJSON.error);
                }
            });
        });
    });
</script>


</body>
</html>
