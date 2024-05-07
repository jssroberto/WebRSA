<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="/resources/lock48.png" sizes="48x48">
    <link rel="icon" type="image/png" href="/resources/lock32.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/resources/lock16.png" sizes="32x32">
</head>

<body>
    <div class="container">
        <h2>Iniciar Sesión</h2>
        <form action="includes/procesar_inicio.php" id="login-form" method="POST">
            <input type="email" id="email" name="email" placeholder="Email" required>
            <div id="emailError" class="error"></div>
            <input type="password" id="contrasenia" name="contrasenia" placeholder="Contraseña" required>
            <div id="credencialesError" class="error"></div>
            <button type="button" id="iniciar-sesion">Iniciar Sesión</button>
        </form>
        <div class="link">
            ¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a>.
        </div>
    </div>
    <script src="js\login.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=6Ld_Uc0pAAAAAJrGuCT3B2tWUB2jraYTr_2Gg21-"></script>

</body>

</html>