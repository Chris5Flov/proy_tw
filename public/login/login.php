<?php
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM usuario
                    WHERE email = '%s'",
                    $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["id_rol"]  = (int)$user["id_rol"];

            if ($_SESSION["id_rol"] === 1) {
                header("Location:../administrador/index.php");
                exit;
            } elseif ($_SESSION["id_rol"] === 2) {
                header("Location: ../index.php");
                exit;
            } else {
                header("Location: signup.html");
                exit;
            }
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Vault - Iniciar sesión</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="contenedor-login">
        
        <div class="contenedor-logo">
            <div class="logo">
                <img src="../../assets/logo.png" alt="Logo" class="imagen-logo">
            </div>
            <p class="nombre-app">Track Vault</p>
        </div>

        <?php if ($is_invalid): ?>
            <div style="color: red; text-align: center; margin-bottom: 20px; padding: 10px; background: #ffe6e6; border-radius: 8px;">
                Email o contraseña incorrectos
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="grupo-formulario">
                <label class="etiqueta-formulario" for="email">Email</label>
                <input 
                    type="email" 
                    id="email"
                    name="email"
                    class="input-formulario" 
                    placeholder="correo@gmail.com"
                    value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"
                    required
                >
            </div>

            <div class="grupo-formulario">
                <label class="etiqueta-formulario" for="password">Contraseña</label>
                <input 
                    type="password" 
                    id="password"
                    name="password"
                    class="input-formulario" 
                    placeholder="contraseña"
                    required
                >
            </div>

            <div class="olvido-contrasena">
                <a href="#">¿Olvidaste tu contraseña?</a>
            </div>

            <button type="submit" class="boton-enviar">Iniciar sesión</button>

            <div class="link-signup">
                ¿No tienes cuenta? <a href="../signup/signup.php">Regístrate aquí</a>
            </div>
        </form>
    </div>
</body>
</html>