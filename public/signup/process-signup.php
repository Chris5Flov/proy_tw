<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: signup.html");
    exit;
}

if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["password"])) {
    die("Por favor completa todos los campos");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Las contraseñas no coinciden");
}

if (strlen($_POST["password"]) < 8) {
    die("La contraseña debe tener al menos 8 caracteres");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Email inválido");
}

$mysqli = require __DIR__ . "/database.php";

// Verificar si el email ya existe
$sql = sprintf("SELECT * FROM usuario WHERE email = '%s'",
            $mysqli->real_escape_string($_POST["email"]));
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    die("Este email ya está registrado");
}

// Encriptar la contraseña
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// Insertar el nuevo usuario (por defecto id_rol = 2, usuario normal)
$sql = "INSERT INTO usuario (name, email, password_hash, id_rol) VALUES (?, ?, ?, 2)";

$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    die("Error SQL: " . $mysqli->error);
}

$stmt->bind_param("sss",
                $_POST["name"],
                $_POST["email"],
                $password_hash);

if ($stmt->execute()) {
    header("Location: signup-success.html");
    exit;
} else {
    if ($mysqli->errno === 1062) {
        die("Este email ya está registrado");
    } else {
        die("Error: " . $mysqli->error);
    }
}