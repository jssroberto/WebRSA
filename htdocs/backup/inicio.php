<?php
session_start(); 

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

$usuario = $_SESSION['usuario'];

echo "Bienvenido, " . $usuario['nombre'] . "!";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/inicio.css">

  <title>Inicio</title>
</head>
<body>
<div class="boxes">
  <div class="box">
    <label for="input">Text to encrypt</label>
    <div>
      <textarea id="input" name="input" type="text" rows="5" cols="30">We strike at dawn!</textarea>
      <button id="encrypt">
          ➜
          <br /> ENCRYPT
        </button>
    </div>
  </div>
  <div class="box">
    <label for="encrypted">Encryption result</label>
    <div>
      <textarea id="encrypted" name="encrypted" type="text" rows="5" cols="30"></textarea>
      <button id="decrypt">
          ➜
          <br /> DECRYPT
        </button>
    </div>
  </div>
  <div class="box">
    <label for="decrypted">Decrypted result</label>
    <div>
      <textarea id="decrypted" name="decrypted" type="text" rows="5" cols="30"></textarea>
    </div>
  </div>
</div>

</body>
<script src="js/encriptacionRSA.js"></script>
</html>