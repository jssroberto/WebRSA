<?php
session_start();

if (!isset($_SESSION['usuario'])) {
  header('Location: index.php');
  exit();
}

$usuario = $_SESSION['usuario'];

// echo "Bienvenido, " . $usuario['nombre'] . "!";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/styles.css?v=<?php echo time(); ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300..700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="/resources/lock48.png" sizes="48x48">
  <link rel="icon" type="image/png" href="/resources/lock32.png" sizes="16x16">
  <link rel="icon" type="image/png" href="/resources/lock16.png" sizes="32x32">

  <title>Inicio</title>
</head>

<body>
  <div class="container">
    <h1>GENERADOR DE CLAVES RSA</h1>
    <button onclick="generarClaves()" class="generarClave">Generar Claves</button>

    <div class="keys">
      <div>
        <label for="privkey" class="llaveLabels">Llave Privada</label>
        <textarea id="privkey" rows="15" cols="70" class="key" readonly>-----BEGIN RSA PRIVATE KEY-----
        MIICXQIBAAKBgQDlOJu6TyygqxfWT7eLtGDwajtNFOb9I5XRb6khyfD1Yt3YiCgQ
        WMNW649887VGJiGr/L5i2osbl8C9+WJTeucF+S76xFxdU6jE0NQ+Z+zEdhUTooNR
        aY5nZiu5PgDB0ED/ZKBUSLKL7eibMxZtMlUDHjm4gwQco1KRMDSmXSMkDwIDAQAB
        AoGAfY9LpnuWK5Bs50UVep5c93SJdUi82u7yMx4iHFMc/Z2hfenfYEzu+57fI4fv
        xTQ//5DbzRR/XKb8ulNv6+CHyPF31xk7YOBfkGI8qjLoq06V+FyBfDSwL8KbLyeH
        m7KUZnLNQbk8yGLzB3iYKkRHlmUanQGaNMIJziWOkN+N9dECQQD0ONYRNZeuM8zd
        8XJTSdcIX4a3gy3GGCJxOzv16XHxD03GW6UNLmfPwenKu+cdrQeaqEixrCejXdAF
        z/7+BSMpAkEA8EaSOeP5Xr3ZrbiKzi6TGMwHMvC7HdJxaBJbVRfApFrE0/mPwmP5
        rN7QwjrMY+0+AbXcm8mRQyQ1+IGEembsdwJBAN6az8Rv7QnD/YBvi52POIlRSSIM
        V7SwWvSK4WSMnGb1ZBbhgdg57DXaspcwHsFV7hByQ5BvMtIduHcT14ECfcECQATe
        aTgjFnqE/lQ22Rk0eGaYO80cc643BXVGafNfd9fcvwBMnk0iGX0XRsOozVt5Azil
        psLBYuApa66NcVHJpCECQQDTjI2AQhFc1yRnCU/YgDnSpJVm1nASoRUnU8Jfm3Oz
        uku7JUXcVpt08DFSceCEX9unCuMcT72rAQlLpdZir876
        -----END RSA PRIVATE KEY-----</textarea>
      </div>
      <div>
        <label for="pubkey" class="llaveLabels">Llave Pública</label>
        <textarea id="pubkey" rows="15" cols="70" class="key" readonly>-----BEGIN PUBLIC KEY-----
        MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDlOJu6TyygqxfWT7eLtGDwajtN
        FOb9I5XRb6khyfD1Yt3YiCgQWMNW649887VGJiGr/L5i2osbl8C9+WJTeucF+S76
        xFxdU6jE0NQ+Z+zEdhUTooNRaY5nZiu5PgDB0ED/ZKBUSLKL7eibMxZtMlUDHjm4
        gwQco1KRMDSmXSMkDwIDAQAB
        -----END PUBLIC KEY-----</textarea>
      </div>
    </div>
    <div class="boxes">
      <div class="box">
        <label for="input" class="labelsFinal">Texto en claro</label>
        <textarea id="input" name="input" type="text" rows="5" cols="40" class="chicos">Encriptameesta</textarea>
        <button id="encrypt" class="botonAccion">➜<br>ENCRIPTAR</button>
      </div>

      <div class="box">
        <label for="encrypted" class="labelsFinal">Texto encriptado</label>
        <textarea id="encrypted" name="encrypted" type="text" rows="5" cols="40" class="chicos" readonly></textarea>
        <button id="decrypt" class="botonAccion">➜<br>DESENCRIPTAR
        </button>
      </div>

      <div class="box">
        <label for="decrypted" class="labelsFinal">Resultado de desencriptar</label>
        <textarea id="decrypted" name="decrypted" type="text" rows="5" cols="40" class="chicos"></textarea>
      </div>
    </div>
    <form action="cerrar_sesion.php" method="post" class="cerrarSesion">
      <button type="submit" class="cerrarSesion">Cerrar Sesión</button>
    </form>
  </div>


  <!-- <h1>Cerrar Sesión</h1> -->
</body>
<script src="/js/encriptacionRSA.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsencrypt/3.0.0/jsencrypt.min.js"></script>

</html>