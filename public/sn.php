<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Sobre nosotros</title>
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
            <a href="index.php" >Home</a>
            <a href="descargas.php">Descargas</a> 
            <a href="sn.php" class="active">Sobre Nosotros</a>
        </nav>
        
        <div class="user-actions">
            <a href="perfil.php" title="Ver Perfil"><i class="fas fa-user-circle"></i></a>
            <a href="../public/login/login.php" title="Cerrar Sesión"><i class="fas fa-sign-out-alt"></i></a> 
            </div>
    </header>
    <main class="main-content-container">
        
        <section class="card-content about-us-card">
            <div class="card-title">Acerca de Track Vault</div>
            <div class="card-text">
                <p>Track Vault es una plataforma desarrollada para simplificar la gestión y distribución de recursos de información y archivos críticos para desarrolladores y equipos de IT.</p>

                <h3>Nuestra Misión</h3>
                <p>Facilitar el acceso rápido y seguro a documentación, librerías y herramientas de desarrollo, asegurando que los equipos siempre trabajen con la versión correcta de cada archivo.</p>
                
                <h3>El Equipo</h3>
                <p>Somos un pequeño equipo apasionado por la tecnología y la eficiencia. Nuestro objetivo es crear herramientas limpias y funcionales que mejoren el flujo de trabajo de la comunidad de programación.</p>
            </div>
        </section>

        <section class="card-content contact-info">
            <div class="card-title-blue">Contáctanos</div>
            <div class="card-text">
                <p> Email: csei.trackv@gmail.com</p>
                <p> Teléfono: +52 2228313187</p>
            </div>
        </section>

    </main>
</body>
</html>