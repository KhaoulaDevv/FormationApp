<?php
require_once '../../../config/db.php';
require_once '../../../Controllers/InscriptionController.php';

$controller = new InscriptionController($pdo);
$controller->delete();
