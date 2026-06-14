<?php
require_once '../../../config/db.php';
require_once '../../../Controllers/InscriptionController.php';

$controller = new InscriptionController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->add();
} else {
    $controller->addForm();
}
