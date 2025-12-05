<?php

$host = "localhost";
$dbname = "track_vault";
$username = "root";
$password = "Isra2818";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Error de conexión: " . $mysqli->connect_error);
}

return $mysqli;