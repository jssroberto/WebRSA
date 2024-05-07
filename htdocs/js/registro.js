document.getElementById("registrarse").addEventListener("click", function () {
  console.log("Event listener");
  let isValid = true;
  let captchaEjecutado = false;
  // Reset previous error messages
  document.getElementById("nombreError").textContent = "";
  document.getElementById("emailError").textContent = "";
  document.getElementById("contraseniaError").textContent = "";
  document.getElementById("confirmarContrasenaError").textContent = "";

  // Perform validation
  let nombre = document.getElementById("nombre").value.trim();
  let email = document.getElementById("email").value.trim();
  let contrasenia = document.getElementById("contrasenia").value;
  let confirmarContrasena = document.getElementById(
    "confirmar_contrasena"
  ).value;

  if (nombre === "") {
    document.getElementById("nombreError").textContent =
      "El nombre es obligatorio";
    isValid = false;
  } else if (!isValidName(nombre)) {
    document.getElementById("nombreError").textContent =
      "El nombre no es válido";
    isValid = false;
  }

  if (email === "") {
    document.getElementById("emailError").textContent =
      "El email es obligatorio";
    isValid = false;
  } else if (!isValidEmail(email)) {
    document.getElementById("emailError").textContent = "El email no es válido";
    isValid = false;
  }

  if (contrasenia === "") {
    document.getElementById("contraseniaError").textContent =
      "La contraseña es obligatoria";
    isValid = false;
  } else if (contrasenia.length < 8 || contrasenia.length > 20) {
    document.getElementById("contraseniaError").textContent =
      "La contraseña debe tener entre 8 y 20 caracteres";
    isValid = false;
  } else if (!/[a-z]/.test(contrasenia)) {
    document.getElementById("contraseniaError").textContent =
      "La contraseña debe tener mayúsculas y minúsculas";
    isValid = false;
  } else if (!/[A-Z]/.test(contrasenia)) {
    document.getElementById("contraseniaError").textContent =
      "La contraseña debe tener mayúsculas y minúsculas";
    isValid = false;
  } else if (!/\d/.test(contrasenia)) {
    document.getElementById("contraseniaError").textContent =
      "La contraseña debe tener numeros y símbolos";
    isValid = false;
  } else if (!/[^a-zA-Z0-9]/.test(contrasenia)) {
    document.getElementById("contraseniaError").textContent =
      "La contraseña debe tener numeros y símbolos";
    isValid = false;
  }

  if (confirmarContrasena === "") {
    document.getElementById("confirmarContrasenaError").textContent =
      "Por favor, confirma la contraseña";
    isValid = false;
  } else if (contrasenia !== confirmarContrasena) {
    document.getElementById("confirmarContrasenaError").textContent =
      "Las contraseñas no coinciden";
    isValid = false;
  }

  let validMail = false;

  // Si el correo es válido, realizamos la verificación AJAX
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "includes/verificar_correo.php", true);
  console.log(xhr);
  xhr.onreadystatechange = function () {
    console.log(xhr.responseText);
    // if (xhr.readyState == 4) {
    // if (xhr.status == 200) {
    // Manejar la respuesta del servidor

    if (
      xhr.responseText === "El correo electrónico ya existe en la base de datos"
    ) {
      validMail = false;
      document.getElementById("emailError").textContent = xhr.responseText;
    }
    if (
      xhr.responseText === "El correo electrónico no existe en la base de datos"
    ) {
      validMail = true;
      console.log("Estado antes de if" + captchaEjecutado);
      if (isValid && validMail && captchaEjecutado === false) {
        captchaEjecutado = true;
        console.log("Estado despues de if" + captchaEjecutado);
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
  xhr.send("email=" + email);
});

function validarCaptcha() {
  console.log("Dento de validar captcha");
  grecaptcha.ready(function () {
    grecaptcha
      .execute("6Ld_Uc0pAAAAAJrGuCT3B2tWUB2jraYTr_2Gg21-", {
        action: "procesarRegistro",
      })
      .then(function (token) {
        var form = document.getElementById("signup-form");
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

        console.log("Ya se va a enviar el form");
        form.submit();
      });
  });
}

function isValidEmail(email) {
  // Simple email validation regex, you might want to use a more comprehensive one
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  return emailRegex.test(email);
}

function isValidName(nombre) {
  // Expresión regular para validar nombres
  const nameRegex = /^[a-zA-ZáéíóúüÁÉÍÓÚñÑÜ\s]{1,100}$/;
  return nameRegex.test(nombre);
}
