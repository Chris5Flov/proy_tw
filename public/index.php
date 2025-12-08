<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
            <a href="logout.php" title="Cerrar Sesión"><i class="fas fa-sign-out-alt"></i></a> 
            </div>
    </header>

    <main class="main-content-container">
        
        <section class="card-content mundo-actual" aria-labelledby="mundo-actual-title">
            <h2 class="card-title" id="mundo-actual-title">Mundo actual y Tendencias</h2>
            <div class="card-text">
                <p>Información de interés para los programadores. Mantente al día con las últimas tendencias y noticias del desarrollo web y software.</p>
                
                <h3>Rápida Adopción de TypeScript 5.0</h3>
                <p>TypeScript, el superset de JavaScript, ha visto una explosión de popularidad tras el lanzamiento de su versión 5.0. Los desarrolladores están migrando para mejorar la robustez del código y facilitar el mantenimiento en proyectos grandes.</p>
                
                <h3>Impacto de Serverless en el Backend</h3>
                <p>Las arquitecturas 'serverless' (sin servidor), como AWS Lambda y Google Cloud Functions, están redefiniendo el backend. Permiten a los equipos enfocarse solo en el código, reduciendo la gestión de infraestructura y optimizando costos.</p>
                
                <h3>Prioridad en Core Web Vitals</h3>
                <p>Google sigue enfatizando la importancia de Core Web Vitals (Métricas Web Esenciales). Optimizar la velocidad de carga (LCP) y la estabilidad visual (CLS) ya no es opcional, sino un requisito para el buen posicionamiento SEO y la experiencia del usuario (UX).</p>
            </div>
        </section>

        <nav class="nav-secundaria" aria-label="Selección de lenguaje de programación">
            <a href="#python-info" class="tab">Python</a>
            <a href="#php-info" class="tab">PHP</a>
            <a href="#javascript-info" class="tab">JavaScript</a>
            <a href="#json-info" class="tab">JSON</a>
        </nav>

        <div class="content-tabs-container">
            
            <section class="card-content lenguaje-seleccionado tab-content" id="python-info">
                <h2 class="card-title-blue"> Python: El lenguaje versátil</h2>
                <div class="card-text">
                    <p><strong>Python</strong> es ideal para desarrollo web (Django/Flask), ciencia de datos e IA. Se valora por su sintaxis clara y su vasta colección de librerías.</p>
                    <p>Es el lenguaje perfecto para iniciar nuevos proyectos rápidamente y mantener una alta legibilidad.</p>
                </div>
            </section>

            <section class="card-content lenguaje-seleccionado tab-content" id="php-info">
                <h2 class="card-title-blue"> PHP: La base del desarrollo web</h2>
                <div class="card-text">
                    <p><strong>PHP</strong> es el lenguaje backend dominante para millones de sitios (WordPress, Laravel). Es robusto, estable y cuenta con una comunidad de soporte enorme.</p>
                    <p>Es eficiente para aplicaciones basadas en servidor y bases de datos.</p>
                </div>
            </section>
            
            <section class="card-content lenguaje-seleccionado tab-content" id="javascript-info">
                <h2 class="card-title-blue"> JavaScript: El motor del Frontend y Backend</h2>
                <div class="card-text">
                    <p><strong>JavaScript (JS)</strong> es esencial para la interactividad del frontend. Con Node.js, domina también el backend. Permite el desarrollo Full-Stack con un solo lenguaje.</p>
                    <p>Frameworks clave: React, Vue y Angular.</p>
                </div>
            </section>
            
            <section class="card-content lenguaje-seleccionado tab-content" id="json-info">
                <h2 class="card-title-blue"> JSON: Formato de intercambio de datos</h2>
                <div class="card-text">
                    <p><strong>JSON (JavaScript Object Notation)</strong> no es un lenguaje de programación, sino un formato ligero basado en texto para transferir datos entre un servidor y aplicaciones web.</p>
                    <p>Es fácil de leer y escribir para los humanos y se utiliza para configurar sistemas.</p>
                </div>
            </section>
            
        </div>

    </main>
    <script>
        window.onpageshow = function(event) {
            if (event.persisted) {
                window.location.href = "logout.php";
            }
        };
    </script>
    </body>
</html>