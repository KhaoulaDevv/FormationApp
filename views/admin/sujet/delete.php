<?php
require_once __DIR__ . '/../../../config/db.php';
require_once __DIR__ . '/../../../Controllers/SujetController.php';

$controller = new SujetController($pdo);
$controller->delete();
