<?php
require_once __DIR__ . '/../../../config/db.php';
require_once __DIR__ . '/../../../Controllers/VilleController.php';

$controller = new VilleController($pdo);
$controller->delete();
