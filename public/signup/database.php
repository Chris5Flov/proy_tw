<?php

$host = "localhost";
$dbname = "track_vault";
$username = "root"; 
$password = "";   

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Error de conexión: " . $mysqli->connect_error);
}

$mysqli->set_charset("utf8mb4");

return $mysqli;