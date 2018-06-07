 $(document).ready(function() {

  $("form[id='formularioNuevo']").validate({
    rules: {
      usuario: "required",
      email: {
        required: true,
        email: true
      },
      contraseña: {
        required: true,
        minlength: 8,
        pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/
      },
      repite:{
        equalTo:"#passRegistro"
      },
    },
    // Mensajes de error específicos
    messages: {
        email: "Por favor introduce una dirección de correo electrónico válida.",
        usuario: "Por favor introduce tu nombre de usuario",
        contraseña: {
            required: "Por favor introduce una contraseña",
            minlength: "La contraseña tiene que tener mínimo 8 caracteres",
            pattern:"Tiene que tener una minuscula,mayuscula,numero,caracter especial"
        },
        repite:"Las dos contraseñas deben coincidir",
    },
    //Función para hacer submit sólo cuando los datos del formulario sean válidos
    submitHandler: function(form) {
      form.submit();
    }
  });

           
    });