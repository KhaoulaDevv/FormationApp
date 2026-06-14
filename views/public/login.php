<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>

<h2>Login</h2>

<?php if (!empty($_SESSION['error'])): ?>
    <p style="color:red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
<?php endif; ?>
<form method="post" action="/FormationApp/controllers/login_process.php">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>

<p>Pas encore inscrit ? <a href="./register.php">Inscrivez-vous ici</a></p>
</body>
</html>
