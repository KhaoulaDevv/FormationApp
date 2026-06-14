<?php

session_start();


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'client') {
    // Not logged in or not admin: redirect to login or access denied page
    header('Location: ../../public/login.php');
    exit;
}

require_once __DIR__ . '/../../../config/db.php';
require_once __DIR__ . '/../../../controllers/FormationClientController.php';

$filters = [
    'pays_id' => $_GET['pays_id'] ?? 0,
    'ville_id' => $_GET['ville_id'] ?? 0,
    'search' => trim($_GET['search'] ?? ''),
];

// Suppose you have a way to get formations client already registered to avoid re-inscription:
$registered_formations = []; // fetch for current user from DB/session

$controller = new FormationClientController($pdo);
$controller->list($filters, $registered_formations);
