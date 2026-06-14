<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
<h2>Register</h2>

<?php if (!empty($_SESSION['reg_error'])): ?>
    <p style="color:red;"><?php echo $_SESSION['reg_error']; unset($_SESSION['reg_error']); ?></p>
<?php elseif (!empty($_SESSION['reg_success'])): ?>
    <p style="color:green;"><?php echo $_SESSION['reg_success']; unset($_SESSION['reg_success']); ?></p>
<?php endif; ?>

<form method="post" action="/FormationApp/controllers/register_process.php">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    Confirm Password: <input type="password" name="confirm_password" required><br><br>
    <button type="submit">Register</button>
</form>

<p>Already have an account? <a href="login.php">Login here</a>.</p>
</body>
</html>
