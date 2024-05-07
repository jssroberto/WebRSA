<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "GET") {

    header("Location: inicio.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'db_connection.php';

    $email = $_POST['email'];
    $contrasenia = $_POST['contrasenia'];

    $sql = "SELECT * FROM Usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $usuario = $result->fetch_assoc();
        $contrasena_hash = $usuario['contrasenia'];

        if (password_verify($contrasenia, $contrasena_hash)) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['success'] = "Inicio de sesión exitoso.";
            header("Location: inicio.php");
            exit();
        } else {
            $_SESSION['error'] = "Usuario o contraseña incorrectos.";
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Usuario o contraseña incorrectos.";
        header("Location: index.php");
        exit();
    }

    $stmt->close(); // Cerrar la sentencia preparada
    $conn->close(); // Cerrar la conexión a la base de datos
} else {

    header("Location: index.php");
    exit();
    
}
?>
