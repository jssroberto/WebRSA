<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    header("Location: inicio.php");
}
include 'db_connection.php';

// Obtener el correo electrónico y la contraseña enviados por AJAX
$correo = $_POST['email'];
$contrasenia = $_POST['contrasenia'];

// Consultar si el correo existe en la base de datos
$sql = "SELECT * FROM Usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // El correo existe, ahora verificar la contraseña
    $row = mysqli_fetch_assoc($result);
    $hashed_password = $row['contrasenia'];

    // Verificar la contraseña
    if (password_verify($contrasenia, $hashed_password)) {
        echo "Credenciales válidas";
    } else {
        echo "Usuario no encontrado";
    }
} else {
    echo "Usuario no encontrado";
}

// Cerrar conexión
$stmt->close();
$conn->close();
