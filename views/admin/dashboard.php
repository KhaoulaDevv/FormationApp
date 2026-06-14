<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // Not logged in or not admin: redirect to login or access denied page
    header('Location: ../public/login.php');
    exit;
}
?>
<!-- HTML for admin dashboard below -->
<h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> (Admin)</h1>




<a href="./pays/list.php">Pays List</a>
<br>
<a href="./ville/list.php">Villes</a>
<br>
<a href="./domaine/list.php">Domaines</a>
<br>
<a href="./sujet/list.php">Sujets</a>
<br>
<a href="./formateur/list.php">Formateurs</a>
<br>
<a href="./cours/list.php">Cours</a>
<br>
<a href="./formation/list.php">Formations</a>
<br>
<a href="./inscription/list.php">Inscriptions</a>
<br>
<a href="../public/logout.php">Logout</a>