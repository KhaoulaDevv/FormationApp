<?php
require_once __DIR__ . '/../../../config/db.php';
require_once __DIR__ . '/../../../Controllers/DomaineController.php';

$controller = new DomaineController($pdo);
$controller->addForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->add();
}
