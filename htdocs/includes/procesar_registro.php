<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    header("Location: inicio.php");
}

define('CLAVE', '6Ld_Uc0pAAAAAFr0rerqVhO5xYVRAnXjZGUVLv3O');

function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<;>console.log('Debug: " . $output . "' );</script>";
}

// Función para validar el formato del correo electrónico
function validar_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Función para validar el nombre
function validar_nombre($nombre)
{
    // Verifica que el nombre no exceda los 100 caracteres y solo contenga letras en español
    return preg_match('/^[a-zA-ZáéíóúüÁÉÍÓÚñÑÜ\s]{1,100}$/', $nombre);
}
// Función para validar la contraseña
function validar_contrasenia($contrasenia)
{
    // Verifica que la contraseña contenga al menos una letra mayúscula, una minúscula, un número y un carácter especial
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,20}$/', $contrasenia);
}

$token = $_POST['token'];
$action = $_POST['action'];

$cu = curl_init();
curl_setopt($cu, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
curl_setopt($cu, CURLOPT_POST, 1);
curl_setopt($cu, CURLOPT_POSTFIELDS, http_build_query(array('secret' => CLAVE, 'response' => $token)));
curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($cu);
curl_close($cu);

$datos = json_decode($response, true);


if ($datos['success'] == 1 && $datos['score'] >= 0.5) {
    if ($datos['action'] == 'procesarRegistro') {
        include 'db_connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST["nombre"];
            $contrasenia = $_POST["contrasenia"];
            $email = $_POST["email"];
            if (empty($nombre) || empty($email) || empty($contrasenia)) {
                echo "Por favor, complete todos los campos.";

                exit();
            }

            if (!validar_nombre($nombre)) {
                echo "El nombre proporcionado no es válido.";

                exit();
            }

            if (!validar_email($email)) {
                echo "El correo electrónico proporcionado no es válido.";
                exit();
            }
            if (!validar_contrasenia($contrasenia)) {
                echo "La contraseña debe contener al menos una letra mayúscula, una minúscula, un número y un carácter especial, y tener entre 8 y 20 caracteres.";
                exit();
            }
            $hash = password_hash($contrasenia, PASSWORD_DEFAULT);

            try {

                $sql = "INSERT INTO Usuarios (nombre, email, contrasenia) VALUES ('$nombre', '$email', '$hash')";

                // Ejecutar la consulta y verificar si fue exitosa
                if ($conn->query($sql) === TRUE) {
                    // Registro exitoso
                    $titulo = "<h2>Registro exitoso</h2>";
                    $link = '<div class="link"> <a href="/index.php" class="hover-animado">Inicia sesión ahora</a> </div>';
                } else {
                    // Manejo de errores
                    echo "Error al insertar datos: " . $sql . "<br>" . $conn->error;
                }
            } catch (mysqli_sql_exception $e) {
                // Si hay un error de clave duplicada, envía un mensaje específico
                if ($e->getCode() === 1062) {
                    echo json_encode(array("tipo" => "error", "mensaje" => "El correo electrónico ya está registrado"));
                    // exit();
                } else {
                    echo json_encode(array("tipo" => "error", "mensaje" => "Error desconocido: " . $e->getMessage()));
                    // exit();
                }
            }
        }
        $conn->close();
    }
} else {
    $titulo = "<h2>Captcha inválido</h2>";
    $link = '<div class="link"> <a href="/register.php" class="hover-animado">Intentar de nuevo.</a> </div>';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro exitoso</title>
    <link rel="stylesheet" href="/css/styles.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="/resources/lock48.png" sizes="48x48">
    <link rel="icon" type="image/png" href="/resources/lock32.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/resources/lock16.png" sizes="32x32">
</head>

<body>
    <div class="container">
        <div>
            <?php echo $titulo; ?>
        </div>

        <div>
            <?php echo $link; ?>
        </div>
    </div>

</body>

</html>