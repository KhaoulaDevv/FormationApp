<?php
require_once __DIR__ . '/../../../config/db.php';
require_once __DIR__ . '/../../../Controllers/PaysController.php';

$controller = new PaysController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->edit();
} else {
    $controller->editForm();
}
