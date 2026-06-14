<?php
require_once __DIR__ . '/../../../config/db.php';
require_once __DIR__ . '/../../../Controllers/DomaineController.php';

$controller = new DomaineController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->edit();
} else {
    $controller->editForm();
}
