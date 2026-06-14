<?php
session_start();
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Get user by username
    $stmt = $pdo->prepare('SELECT * FROM Users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Authentication successful
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        if ($user['role'] === 'admin') {
            header('Location: ../views/admin/dashboard.php');
        } else {
            header('Location: ../views/client/formations/list.php');
        }
        exit;
    } else {
        $_SESSION['error'] = 'Invalid username or password.';
        header('Location: ../views/public/login.php');
        exit;
    }
} else {
    header('Location: ../views/public/login.php');
    exit;
}
