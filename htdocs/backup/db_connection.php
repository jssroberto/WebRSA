<?php
$servername = "sql305.infinityfree.com";
$username = "if0_36458724";
$password = "Y0QH1yevN9rH2ON";
$dbname = "if0_36458724_SeguridadInformatica";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
