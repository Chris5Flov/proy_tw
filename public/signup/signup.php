<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Vault - Registrarse</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="contenedor-signup">
        
        <div class="contenedor-logo">
            <div class="logo">
                <img src="../../assets/logo.png" alt="Logo" class="imagen-logo">
            </div>
            <p class="nombre-app">Track Vault</p>
        </div>

        <form id="signup" method="POST" action="process-signup.php" novalidate>
            <div class="grupo-formulario">
                <label class="etiqueta-formulario" for="name">Nombre completo</label>
                <input 
                    type="text" 
                    id="name"
                    name="name"
                    class="input-formulario" 
                    placeholder="Juan Pérez"
                >
                <div class="error-message" id="name-error"></div>
            </div>

            <div class="grupo-formulario">
                <label class="etiqueta-formulario" for="email">Email</label>
                <input 
                    type="email" 
                    id="email"
                    name="email"
                    class="input-formulario" 
                    placeholder="correo@gmail.com"
                >
                <div class="error-message" id="email-error"></div>
            </div>

            <div class="grupo-formulario">
                <label class="etiqueta-formulario" for="password">Contraseña</label>
                <input 
                    type="password" 
                    id="password"
                    name="password"
                    class="input-formulario" 
                    placeholder="Mínimo 8 caracteres"
                >
                <div class="error-message" id="password-error"></div>
            </div>

            <div class="grupo-formulario">
                <label class="etiqueta-formulario" for="password_confirmation">Confirmar contraseña</label>
                <input 
                    type="password" 
                    id="password_confirmation"
                    name="password_confirmation"
                    class="input-formulario" 
                    placeholder="Repite tu contraseña"
                >
                <div class="error-message" id="password_confirmation-error"></div>
            </div>

            <button type="submit" class="boton-enviar">Crear cuenta</button>

            <div class="link-login">
                ¿Ya tienes cuenta? <a href="../login/login.php">Inicia sesión</a>
            </div>
        </form>
    </div>
</body>
</html>