<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function validateLogin(event) {
            event.preventDefault();
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;

            if (email.trim() === '' || password.trim() === '') {
                alert("All fields are required!");
                return false;
            }

            document.getElementById('loginForm').submit();
        }
    </script>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

<div class="container w-25">
    <h2 class="text-center">Gym Login</h2>
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    <form id="loginForm" action="../../../../backend/controllers/login.php" method="POST" onsubmit="validateLogin(event)">
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>

</body>
</html>
