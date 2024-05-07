<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    header("Location: inicio.php");
}

include 'db_connection.php';
$correo = $_POST['email'];

$sql = "SELECT * FROM Usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    echo "El correo electrónico ya existe en la base de datos";
} else {
    echo "El correo electrónico no existe en la base de datos";
}

$stmt->close();
$conn->close();
?>
