
<?php

header('Content-Type: application/json');

$host = "localhost";
$dbname = "track_vault";
$username = "root";
$password = ""; 

$mysqli = new mysqli($host, $username, $password, $dbname);
if ($mysqli->connect_errno) {
    echo json_encode(["status" => "error", "message" => "Error de conexión: " . $mysqli->connect_error]);
    exit;
}
$mysqli->set_charset("utf8mb4");


$input = json_decode(file_get_contents("php://input"), true);
$accion = $_GET['accion'] ?? '';




if ($_SERVER['REQUEST_METHOD'] === 'GET' && $accion === 'listar') {
    $sql = "SELECT * FROM archivos WHERE eliminado = 0";
    $result = $mysqli->query($sql);
    $archivos = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($archivos);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && $accion === 'buscar') {
    $search = $mysqli->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM archivos WHERE (nombre LIKE '%$search%' OR autor_o_empresa LIKE '%$search%') AND eliminado = 0";
    $result = $mysqli->query($sql);
    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $accion === 'obtener') {
    $id = (int)$_POST['id'];
    $sql = "SELECT * FROM archivos WHERE id = $id";
    $result = $mysqli->query($sql);
    echo json_encode($result->fetch_assoc());
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $accion === 'agregar') {
    
    
    if (empty($input['nombre']) || empty($input['autor_o_empresa']) || empty($input['descripcion']) || empty($input['ruta_archivo'])) {
        echo json_encode(["status" => "error", "message" => "Faltan datos obligatorios"]);
        exit; 
    }

    $stmt = $mysqli->prepare("INSERT INTO archivos (nombre, autor_o_empresa, descripcion, tipo, ruta_archivo, eliminado) VALUES (?, ?, ?, ?, ?, 0)");
    $stmt->bind_param("sssss", $input['nombre'], $input['autor_o_empresa'], $input['descripcion'], $input['tipo'], $input['ruta_archivo']);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Archivo guardado en TrackVault"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al guardar: " . $stmt->error]);
    }
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $accion === 'editar') {

    // VALIDACIÓN DE BACKEND
    if (empty($input['nombre']) || empty($input['autor_o_empresa']) || empty($input['descripcion']) || empty($input['ruta_archivo'])) {
        echo json_encode(["status" => "error", "message" => "Error del Servidor: No puedes dejar campos vacíos."]);
        exit;
    }

    $stmt = $mysqli->prepare("UPDATE archivos SET nombre=?, autor_o_empresa=?, descripcion=?, tipo=?, ruta_archivo=? WHERE id=?");
    $stmt->bind_param("sssssi", $input['nombre'], $input['autor_o_empresa'], $input['descripcion'], $input['tipo'], $input['ruta_archivo'], $input['id']);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Archivo actualizado correctamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error SQL: " . $stmt->error]);
    }
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $accion === 'eliminar') {
    $id = (int)$_POST['id'];
    $sql = "UPDATE archivos SET eliminado = 1 WHERE id = $id";
    if ($mysqli->query($sql)) {
        echo json_encode(["status" => "success", "message" => "Archivo eliminado"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $mysqli->error]);
    }
    exit;
}

if ($_GET['accion'] === 'dashboard') {
    $data = [];

    $total = $mysqli->query("SELECT 
                                COUNT(*) AS total 
                                FROM archivos 
                                WHERE eliminado = 0")->fetch_assoc();
    $data["total"] = $total['total'];

    $tipos = $mysqli->query("SELECT 
                                tipo, 
                                COUNT(*) as total 
                                FROM archivos 
                                WHERE eliminado = 0
                                GROUP BY tipo");
    $data["por_tipo"] = $tipos->fetch_all(MYSQLI_ASSOC);

    $autores = $mysqli->query("SELECT 
                                autor_o_empresa AS autor, 
                                COUNT(*) AS total 
                                FROM archivos 
                                WHERE eliminado = 0 
                                GROUP BY autor_o_empresa 
                                ORDER BY total 
                                DESC LIMIT 5");
    $data["top_autores"] = $autores->fetch_all(MYSQLI_ASSOC);

    echo json_encode($data);
    exit;
}
?>
