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
    <style>
        /* styles.css - Estilos para perfil.php */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
    min-height: 100vh;
}

/* Header */
.header-container {
    background: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 16px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 100;
}

.logo-img {
    height: 40px;
    width: auto;
}

.nav-principal {
    display: flex;
    gap: 32px;
}

.nav-principal a {
    color: #333;
    text-decoration: none;
    font-weight: 500;
    font-size: 15px;
    transition: color 0.3s ease;
    position: relative;
}

.nav-principal a:hover {
    color: #4338ca;
}

.nav-principal a::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 0;
    height: 2px;
    background: #4338ca;
    transition: width 0.3s ease;
}

.nav-principal a:hover::after {
    width: 100%;
}

.user-actions {
    display: flex;
    gap: 16px;
    align-items: center;
}

.user-actions a {
    color: #666;
    font-size: 20px;
    transition: all 0.3s ease;
    padding: 8px;
    border-radius: 8px;
}

.user-actions a:hover {
    color: #4338ca;
    background: #f5f7fa;
}

.user-actions a.active {
    color: #4338ca;
    background: #eef2ff;
}

/* Main Content */
.main-content-container {
    max-width: 800px;
    margin: 60px auto;
    padding: 0 20px;
}

.profile-container {
    background: white;
    border-radius: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 50px 40px;
}

.profile-container h2 {
    color: #333;
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 40px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.profile-container h2 i {
    color: #4338ca;
    font-size: 32px;
}

.profile-data-viewer {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group label {
    color: #333;
    font-size: 14px;
    font-weight: 500;
}

.form-group input {
    width: 100%;
    padding: 14px 16px;
    border: 2px solid #f5f7fa;
    background: #f5f7fa;
    border-radius: 12px;
    font-size: 15px;
    color: #333;
    cursor: not-allowed;
    transition: all 0.3s ease;
}

.form-group input:focus {
    outline: none;
    border-color: #4338ca;
    background: #fff;
}

/* Responsive */
@media (max-width: 768px) {
    .header-container {
        padding: 16px 20px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .nav-principal {
        order: 3;
        width: 100%;
        justify-content: center;
        gap: 20px;
        padding-top: 16px;
        border-top: 1px solid #f5f7fa;
    }

    .main-content-container {
        margin: 30px auto;
    }

    .profile-container {
        padding: 40px 30px;
    }

    .profile-container h2 {
        font-size: 24px;
    }
}

@media (max-width: 480px) {
    .header-container {
        padding: 12px 16px;
    }

    .logo-img {
        height: 32px;
    }

    .nav-principal {
        gap: 16px;
    }

    .nav-principal a {
        font-size: 14px;
    }

    .user-actions a {
        font-size: 18px;
    }

    .profile-container {
        padding: 30px 20px;
    }

    .profile-container h2 {
        font-size: 20px;
        margin-bottom: 30px;
    }

    .profile-container h2 i {
        font-size: 24px;
    }
}
    </style>
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

