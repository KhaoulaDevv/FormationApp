<?php
require_once __DIR__ . '/../../../config/db.php';
require_once __DIR__ . '/../../../Controllers/FormationController.php';

$controller = new FormationController($pdo);
$controller->delete();
