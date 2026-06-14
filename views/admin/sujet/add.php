<?php
require_once __DIR__ . '/../../../config/db.php';
require_once __DIR__ . '/../../../Controllers/SujetController.php';

$controller = new SujetController($pdo);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->add();
} else {
    $controller->addForm();
}
