<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../vendor/autoload.php';


use TrackVault\MyApi\Listar\Listar;
use TrackVault\MyApi\Buscar\Buscar;
use TrackVault\MyApi\Obtener\Obtener;
use TrackVault\MyApi\Crear\Crear;
use TrackVault\MyApi\Editar\Editar;
use TrackVault\MyApi\Eliminar\Eliminar;
use TrackVault\MyApi\Dashboard\Dashboard;

$accion = $_GET['accion'] ?? '';
$input = json_decode(file_get_contents("php://input"), true) ?? $_POST;

switch ($accion) {

    case "listar":
        echo json_encode((new Listar())->ejecutar());
        break;

    case "buscar":
        echo json_encode((new Buscar())->ejecutar($_GET['search']));
        break;

    case "obtener":
        echo json_encode((new Obtener())->ejecutar($_POST['id']));
        break;

    case "agregar":
        echo json_encode((new Crear())->ejecutar($input));
        break;

    case "editar":
        echo json_encode((new Editar())->ejecutar($input));
        break;

    case "eliminar":
        echo json_encode((new Eliminar())->ejecutar($_POST['id']));
        break;

    case "dashboard":
        echo json_encode((new Dashboard())->ejecutar());
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Acción no válida"]);
        break;
}
