<?php
$mysqli = require __DIR__ . "/login/database.php"; 

require_once __DIR__ . "/archivosmanager.php"; 

$filtro_activo = $_GET['tipo'] ?? 'Todos'; 

$manager = new ArchivosManager($mysqli); 

$archivos_disponibles = $manager->obtenerArchivos($filtro_activo);
?>


<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Downloads</title>
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
            <a href="index.php">Home</a>
            <a href="descargas.php" class="active">Descargas</a> 
            <a href="sn.php">Sobre Nosotros</a>
        </nav>
        
        <div class="user-actions">
            <a href="perfil.php" title="Ver Perfil"><i class="fas fa-user-circle"></i></a>
            <a href="../public/login/login.php" title="Cerrar Sesión"><i class="fas fa-sign-out-alt"></i></a> 
            </div>
    </header>

    <main class="main-content-container">
        
        <div class="downloads-layout"> 
            
            <aside class="sidebar-filtro">
                <div class="search-box">
                    <input type="text" placeholder="Búsqueda" class="search-input">
                    <i class="fas fa-search search-icon"></i>
                </div>
                
                <div class="filter-section">
                    <div class="filter-title">Selecciona tu tipo de archivo</div>
                    <div class="file-type-list">
                        <a href="?tipo=XML" class="<?= ($filtro_activo === 'XML') ? 'active-filter' : '' ?>">XML</a>
                        <a href="?tipo=PDF" class="<?= ($filtro_activo === 'PDF') ? 'active-filter' : '' ?>">PDF</a>
                        <a href="?tipo=EXE" class="<?= ($filtro_activo === 'EXE') ? 'active-filter' : '' ?>">EXE</a>
                        <a href="?tipo=JSON" class="<?= ($filtro_activo === 'JSON') ? 'active-filter' : '' ?>">JSON</a>
                        <a href="?tipo=Todos" class="<?= ($filtro_activo === 'Todos' || $filtro_activo === 'All') ? 'active-filter' : '' ?>">Todos</a>
                    </div>
                </div>
            </aside>

            <section class="file-gallery">
                <?php 
                // archivos bd
                foreach ($archivos_disponibles as $archivo): 
                    
                    // icono de Font Awesome jaja
                    $icon_class = match (strtoupper($archivo['tipo'])) {
                        'XML' => 'fa-file-code',
                        'PDF' => 'fa-file-pdf',
                        'EXE' => 'fa-file-powerpoint', 
                        'JSON' => 'fa-file-code', 
                        default => 'fa-file',
                    };
                ?>
                
                <div class="file-item">
                    <i class="fas <?= htmlspecialchars($icon_class) ?> file-icon-big"></i> 
                    <div class="file-name"><?= htmlspecialchars($archivo['nombre']) ?>.<?= htmlspecialchars($archivo['tipo']) ?></div>
                    <div class="file-info"><?= htmlspecialchars($archivo['descripcion']) ?></div>
                    <a href="descargar.php?id=<?= $archivo['id'] ?>">
                        <i class="fas fa-download download-icon" title="Descargar <?= htmlspecialchars($archivo['nombre']) ?>"></i>
                    </a>
                </div>
                
                <?php endforeach; ?>
            </section>
        </div>
    </main>
</body>
</html>