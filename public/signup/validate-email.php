<?php
header("Content-Type: application/json");

// Verifica que se haya enviado el email
if (!isset($_GET["email"]) || empty($_GET["email"])) {
    echo json_encode(["available" => false, "error" => "Email no proporcionado"]);
    exit;
}

$mysqli = require __DIR__ . "/database.php";

$sql = sprintf("SELECT * FROM usuario
                WHERE email = '%s'",
                $mysqli->real_escape_string($_GET["email"]));
                
$result = $mysqli->query($sql);

$is_available = $result->num_rows === 0;

echo json_encode(["available" => $is_available]);