<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // Not logged in or not admin: redirect to login or access denied page
    header('Location: ../../public/login.php');
    exit;
}

require_once __DIR__ . '/../../../config/db.php';
require_once __DIR__ . '/../../../Controllers/VilleController.php';

$controller = new VilleController($pdo);
$controller->list();
