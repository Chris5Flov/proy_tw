<?php

session_start();


if (!isset($_SESSION["user_id"])) {
    header("Location: ../login/login.php");
    exit;
}


$mysqli = require __DIR__ . "/login/database.php"; 
$user_id = $_SESSION["user_id"];

$sql = "SELECT name, email FROM usuario WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $user_id); 
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc(); 

$stmt->close();
$mysqli->close();

if (!$user) {
    header("Location: ../login/logout.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Vault - Mi Perfil</title>
    <link rel="stylesheet" href="styles.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    
    <header class="header-container">
        <div class="logo"><img src="../assets/Logo.png" alt="Track Vault Logo" class="logo-img"></div>
        <nav class="nav-principal">
            <a href="index.php">Home</a>
            <a href="descargas.php">Descargas</a> 
            <a href="sn.php">Sobre Nosotros</a>
        </nav>
        <div class="user-actions">
            <a href="perfil.php" class="active"><i class="fas fa-user-circle"></i></a> 
            <a href="../public/login/login.php" title="Cerrar Sesión"><i class="fas fa-sign-out-alt"></i></a> 
        </div>
    </header>

    <main class="main-content-container">
        
        <div class="profile-container">
            <h2><i class="fas fa-user-circle"></i> Información de Perfil</h2>
            
            <div class="profile-data-viewer">
                
                <div class="form-group">
                    <label for="name">Nombre de Usuario:</label>
                    <input type="text" id="name" value="<?= htmlspecialchars($user["name"] ?? 'N/A') ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" value="<?= htmlspecialchars($user["email"] ?? 'N/A') ?>" readonly>
                </div>
                
            </div>
        </div>
    </main>
    
</body>
</html>

