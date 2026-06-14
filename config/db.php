<?php
// Database configuration
$host = 'localhost';
$db   = 'formationsapp';
$user = 'formationsapp';
$pass = 'FormationApp123';
$charset = 'utf8mb4';

// Data Source Name (DSN) for PDO connection
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// PDO options to handle errors and fetch modes
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch results as associative arrays
];

try {
    // Create PDO instance
    $pdo = new PDO($dsn, $user, $pass, $options);
//     var_dump($pdo);
//     if (!isset($pdo)) {
//         die('❌ $pdo not set');
//     } elseif (!$pdo instanceof PDO) {
//         die('❌ $pdo is not a PDO instance');
//     } else {
//         echo '✅ $pdo is OK';
//     }
} catch (PDOException $e) {
    // Stop script and show error message
    echo $e->getMessage();
    exit('Database connection failed: ' . $e->getMessage());
}
?>