<?php
session_start();
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validate inputs
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $_SESSION['reg_error'] = "All fields are required.";
        header("Location: ../views/public/register.php");
        exit;
    }

    if ($password !== $confirm_password) {
        $_SESSION['reg_error'] = "Passwords do not match.";
        header("Location: ../views/public/register.php");
        exit;
    }

    // Check if username already exists
    $stmt = $pdo->prepare("SELECT id FROM Users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        $_SESSION['reg_error'] = "Username already taken.";
        header("Location: ../views/public/register.php");
        exit;
    }

    // Hash password and insert user with 'client' role
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO Users (username, password, role) VALUES (?, ?, 'client')");
    $stmt->execute([$username, $hashed_password]);

    $_SESSION['reg_success'] = "Registration successful! You can now log in.";
    header("Location: ../views/public/register.php");
    exit;
} else {
    header("Location: ../views/public/register.php");
    exit;
}
