<?php
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
  }

// Define las variables
$private_key = "-----BEGIN RSA PRIVATE KEY-----
MIICWgIBAAKBgGe+RctvgTA8Uc0la10juao7OJOCPdPFavf1jufNjdgxWaTy/gkV
5gVm4TADaGQf9oEeJvHW7zoqJBmY2FvGxoEfl+cxRhNrqpm9JPtA4nBNJb7CBghc
ApY8B5dJm3ilk+9ccLWCak7PhkbOCWWcSovr4qKBb8AsHzuLJEEPjUCLAgMBAAEC
gYBJI1hbOsouMmhNI5NUf4o2XDffrpNeCDEIjMLp4v2cK/aSFolH6HtY1ZXuXoir
BemoT5SPLMNNE0aOETZ/RVzN5iOPpQiBdx3cbsGImwknddlSBT1PiRM5tZ1ojQeL
Gg+IQHmRxceruRBLz/i+g1zLkONVf+Xf/ZOTH1LKaQVjcQJBALbdf9KKfn0YHdmj
ZEGqep2hh+XL2hxnyurQR5UK5xoAQ/YbAHLd13ua54bH5GB8zAu5orOj6GNCjlN4
56QCc9MCQQCRO+/f5fMBUJcRembFwx5r2pWgXO2UfZLKjuSwRSWblgziScsSf90X
StFu6eFmBzaTw77BBzwom94yydSdUOVpAkBBTldw7G8B49P9PsH2RZjmpKJw6d1q
GZM5SsrVqoAgJAohYUFGxH1JMmgPFWI1JzyDz3cQqq+6izFjFCG9y/ZrAkAleB0u
2piTIkOXUsjpBKn4kXBA6ziwMqWIdM0zXOOS/GdeikNGBo73z2mw/84TEJFYFgxE
qKUwpOXynHeqDpDhAkBKDc2nLTbIssZymQkd8lUhnhj+ymXgbm21dBbg6mRTuZuL
P3iRFlipRt3uh1CW3aJ+kG/CkEBUr0Mb5INlE6rF
-----END RSA PRIVATE KEY-----";
$public_key = "-----BEGIN PUBLIC KEY-----
MIGeMA0GCSqGSIb3DQEBAQUAA4GMADCBiAKBgGe+RctvgTA8Uc0la10juao7OJOC
PdPFavf1jufNjdgxWaTy/gkV5gVm4TADaGQf9oEeJvHW7zoqJBmY2FvGxoEfl+cx
RhNrqpm9JPtA4nBNJb7CBghcApY8B5dJm3ilk+9ccLWCak7PhkbOCWWcSovr4qKB
b8AsHzuLJEEPjUCLAgMBAAE=
-----END PUBLIC KEY-----";

// Verifica si se ha realizado una solicitud GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Devuelve las variables como respuesta
    echo json_encode(array("public_key" => $public_key, "private_key" => $private_key));
}
?>
