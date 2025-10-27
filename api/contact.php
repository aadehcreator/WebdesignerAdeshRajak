<?php
// api/contact.php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once "db_config.php";

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!is_array($input)) $input = $_POST;

    $name = trim($input['name'] ?? '');
    $email = trim($input['email'] ?? '');
    $phone = trim($input['phone'] ?? '');
    $message = trim($input['message'] ?? '');
    $sub = trim($input['sub'] ?? '');

    if (empty($name) || empty($email)) {
        echo json_encode(["success" => false, "message" => "Name and email are required"]);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO contacts (name, email, phone, message, sub) VALUES (:n, :e, :p, :m ,:s)");
    $stmt->execute([':n' => $name, ':e' => $email, ':p' => $phone, ':m' => $message,':s' => $sub]);
    echo json_encode(["success" => true, "message" => "Message Send Succefully"]);
    exit;
}

if ($method === 'GET') {
    $stmt = $pdo->query("SELECT * FROM contacts ORDER BY id DESC");
    $data = $stmt->fetchAll();
    echo json_encode(["success" => true, "data" => $data]);
    exit;
}

http_response_code(405);
echo json_encode(["success" => false, "message" => "Method not allowed"]);
