<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
</head>
<body>
    <header class="header-container">
        <div class="logo">
            <img src="../assets/Logo.png" alt="Track Vault Logo" class="logo-img">
            <?php // echo $userName; ?> 
        </div>
        
        <nav class="nav-principal" aria-label="Navegación principal de la aplicación">
            <a href="index.php" class="active">Home</a>
            <a href="descargas.php">Descargas</a> 
            <a href="sn.php">Sobre Nosotros</a>
        </nav>
        
        <div class="user-actions">
            <a href="perfil.php" title="Ver Perfil"><i class="fas fa-user-circle"></i></a>
            <a href="../public/login/login.php" title="Cerrar Sesión"><i class="fas fa-sign-out-alt"></i></a> 
            </div>
    </header>
</body>
</html>