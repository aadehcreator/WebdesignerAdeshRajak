<?php
// api/db_config.php
$host = 'https://aadehcreator.github.io/WebdesignerAdeshRajak/';
$db   = 'aadesh_portfolio';
$user = 'root';
$pass = ''; // change if needed
$dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Database connection failed",
        "error" => $e->getMessage()
    ]);
    exit;
}
?>
