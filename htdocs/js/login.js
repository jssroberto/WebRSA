document
  .getElementById("iniciar-sesion")
  .addEventListener("click", function () {
    let captchaEjecutado = false;
    let isValid = true;
    // Reset previous error messages
    document.getElementById("credencialesError").textContent = "";
    document.getElementById("emailError").textContent = "";

    // Perform validation
    let email = document.getElementById("email").value.trim();
    let contrasenia = document.getElementById("contrasenia").value;

    if (email === "" || contrasenia === "") {
      isValid = false;
      document.getElementById("credencialesError").textContent =
        "Es necesario llenar todos los campos";
    }
    if (!isValidEmail(email)) {
        isValid = false; 
      document.getElementById("emailError").textContent =
        "El email no es válido";
    }

    let validLogin = false;

    if (isValid) {
      // Si el correo es válido, realizamos la verificación AJAX
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "includes/verificar_login.php", true);
      console.log(xhr);
      xhr.onreadystatechange = function () {
        console.log("Dentro del login ajax");
        // if (xhr.readyState == 4) {
        // if (xhr.status == 200) {
        // Manejar la respuesta del servidor

        if (xhr.responseText === "Usuario no encontrado") {
          validLogin = false;
          document.getElementById("credencialesError").textContent =
            xhr.responseText;
        }
        if (xhr.responseText === "Credenciales válidas") {
          validLogin = true;
          if (isValid && validLogin && !captchaEjecutado) {
            captchaEjecutado = true;
            console.log("a validar mi gente");
            validarCaptcha();
          }

          // Procesar el registro ya que el correo no está en la base de datos
        }
        //   } else {
        //     // Manejar el error de la solicitud AJAX
        //     console.error("Error en la solicitud AJAX");
        //   }
        // }
      };
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send("email=" + email + "&contrasenia=" + contrasenia);
    }
  });

function validarCaptcha() {
  // alert("validarCaptcha");
  grecaptcha.ready(function () {
    grecaptcha
      .execute("6Ld_Uc0pAAAAAJrGuCT3B2tWUB2jraYTr_2Gg21-", {
        action: "procesarRegistro",
      })
      .then(function (token) {
        var form = document.getElementById("login-form");
        var tokenInput = document.createElement("input");
        tokenInput.type = "hidden";
        tokenInput.name = "token";
        tokenInput.value = token;
        form.prepend(tokenInput);

        var actionInput = document.createElement("input");
        actionInput.type = "hidden";
        actionInput.name = "action";
        actionInput.value = "procesarRegistro";
        form.prepend(actionInput);

        form.submit();
      });
  });
}

function isValidEmail(email) {
  // Simple email validation regex, you might want to use a more comprehensive one
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  return emailRegex.test(email);
}
