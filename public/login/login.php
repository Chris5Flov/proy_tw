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

        <form>
            <div class="grupo-formulario">
                <label class="etiqueta-formulario" for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    class="input-formulario" 
                    placeholder="correo@gmail.com"
                    required
                >
            </div>

            <div class="grupo-formulario">
                <label class="etiqueta-formulario" for="password">Contraseña</label>
                <input 
                    type="password" 
                    id="password" 
                    class="input-formulario" 
                    placeholder="contraseña"
                    required
                >
            </div>

            <div class="olvido-contrasena">
                <a href="#">¿Olvidaste tu contraseña?</a>
            </div>

            <button type="submit" class="boton-enviar">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>