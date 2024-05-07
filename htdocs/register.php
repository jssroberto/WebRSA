<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
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
        <h2>Registrarse</h2>

        <form action="includes/procesar_registro.php" id="signup-form" method="POST">
            <input type="text" name="nombre" id="nombre" placeholder="Nombre">
            <div id="nombreError" class="error"></div>

            <input type="email" name="email" id="email" placeholder="Email" autocomplete="email">
            <div id="emailError" class="error"></div>

            <input type="password" id="contrasenia" name="contrasenia" placeholder="Contraseña">
            <div id="contraseniaError" class="error"></div>

            <input type="password" id="confirmar_contrasena" placeholder="Confirmar contraseña">
            <div id="confirmarContrasenaError" class="error"></div>

            <button type="button" id="registrarse">Registrarse</button>
        </form>

        <div class="link">
            ¿Ya tienes una cuenta? <a href="index.php" class="hover-animado">Inicia sesión aquí</a>.
        </div>
    </div>

    <script src="js\registro.js"></script>
    <script src="js\script.js"></script>

    <script src="https://www.google.com/recaptcha/api.js?render=6Ld_Uc0pAAAAAJrGuCT3B2tWUB2jraYTr_2Gg21-"></script>

</body>

</html>