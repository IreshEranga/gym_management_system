<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Power Fit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/LoginPage.css">
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
<body>

<div class="overlay"></div>

<div class="login-container text-center">
    <h2 class="loginFormTitle">Login</h2><br>
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    <form id="loginForm" action="../../../../backend/controllers/login.php" method="POST" onsubmit="validateLogin(event)">
        <div class="mb-3">
            <label class="text-white formLabelLogin">Email</label>
            <br>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
            <label class="text-white formLabelLogin">Password</label>
            <br>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
        </div>
        <!-- <button type="submit" class="btn btn-primary w-100">Login</button> -->

        <!-- Forgot Password Link -->
        <div class="d-flex justify-content-between mb-3">
            <a href="../../../../backend/controllers/forgot_password.php" class="text-warning">Forgot Password?</a>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

  <!-- Sign Up Link -->
<p class="mt-3 text-white">Don't have an account? 
    <a href="SignUp.html" class="text-warning">Sign Up</a>
</p>

</div>
    </form>
</div>

</body>
</html>