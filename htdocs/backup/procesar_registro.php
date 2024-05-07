<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $contrasenia = $_POST["contrasenia"];
    $email = $_POST["email"];
    $hash = password_hash($contrasenia, PASSWORD_DEFAULT);

    $sql = "INSERT INTO Usuarios (nombre, email, contrasenia) VALUES ('$nombre', '$email', '$hash')";
    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso";
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
header("Location: index.php");

$conn->close();
?>
