
    /****************************************************************/
    /* SCRIPTS FORMULARIO CONTACTO */
    /****************************************************************/ 

    	// VARIABLES PARA EL FORMULARIO DE LA HERRAMIENTA
		var vector_params_contact = new Array();


	function validar_nombres_y_apellidos (nombre)
	{
  		//return (nombre == "") ? "Introduzca su nombre y apellidos.<br>" : "";
  		if (nombre == "") {
  			return "Enter your first and last name.<br>";
  		} else if (nombre.length > 80) {
  			//return "El nombre y los apellidos no pueden tener una longitud mayor de 80 caracteres.<br>";
  		} else {
  			return "";	
  		}
	}

	function validar_email (correo) {
		if (correo == "" ) {
			//document.getElementById('email_error_messages').innerHTML += "Por favor, introduzca una dirección de correo electrónico.<br>";
			//document.getElementById('email_error_messages').style.color='red'; 
			return "Enter an e-mail address.<br>";
			
		} else if (correo.length > 50) {
			return "The email entered cannot be more than 50 characters long.<br>";
		} else if (!((correo.indexOf(".") > 0) && (correo.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(correo)) {
			// document.getElementById('email_error_messages').innerHTML += "El correo electrónico introducido no es válido.<br>";
			//document.getElementById('email_error_messages').style.color='red'; 
			return "The email entered is not valid.<br>";
		}
  		return "";
	}

	function validar_telefono (telefono) {
		//reNumero = "/^(\+34|0034|34)?[\s|\-|\.]?[6|7|9][\s|\-|\.]?([0-9][\s|\-|\.]?){8}$/";
		//reNumero = new RegExp("^(\+34|0034|34)?[\s|\-|\.]?[6|7|9][\s|\-|\.]?([0-9][\s|\-|\.]?){8}$");
		//reNumero = new RegExp("^[0-9]{50}$");
	  	if (telefono.length > 50) {
  			return "The phone cannot have more than 50 characters.<br>";	
  		//} else if (!reNumero.exec(telefono)) {
  		//} else if (!reNumero.test(telefono) ) {
  		//	return "El teléfono introducido no es válido.<br>";	
  		} else {
			return "";  		
  		}
	}
		
		
	function validar_mensaje (mensaje)
	{
  		//return (mensaje == "") ? "Introduzca su comentario o mensaje al equipo de Art-Risk.<br>" : "";
  		if (mensaje == "") {
  			return "Enter your comment or message to the Art-Risk team.<br>";
  		} else if (mensaje.length > 2000) {
  			return "The message cannot be longer than 2000 characters.<br>";
  		} else {
  			return "";	
  		}
	}

	function validar_formulario_email () {
		mensaje = validar_nombres_y_apellidos (document.getElementById('nombre_apellidos').value);
		mensaje += validar_email (document.getElementById('correo_electronico').value);
		mensaje += validar_telefono (document.getElementById('telefono').value);
		mensaje += validar_mensaje (document.getElementById('mensaje').value);
		if (mensaje == "") {
			// ENVIO CORREO
			vector_params_contact = [];
			//vector_params[0] = document.getElementById('nombre_apellidos').value;
			param = document.getElementById('nombre_apellidos').value;
			vector_params_contact.push(param);
			//vector_params[1] = document.getElementById('correo_electronico').value;
			param = document.getElementById('correo_electronico').value;
			vector_params_contact.push(param);
			//vector_params[2] = document.getElementById('telefono').value;
			param = document.getElementById('telefono').value;
			vector_params_contact.push(param);
			//vector_params[3] = document.getElementById('mensaje').value;
			param = document.getElementById('mensaje').value;
			vector_params_contact.push(param);
			$.ajax({
    			type: "POST",
    			url: 'cgi/art-risk2-contact.php',
    			data: {miArray: vector_params_contact},
    				success: function(data){
						//document.getElementById('email_error_messages').innerHTML = "Mensaje enviado correctamente.<br>";
						document.getElementById('email_error_messages').innerHTML = data;
						document.getElementById('email_error_messages').style.color='brown'; 
						$('#nombre_apellidos').val('');
						$('#correo_electronico').val('');
						$('#telefono').val('');
						$('#mensaje').val('');
    				},
    				error:function(data){
    					$('html, body').css("cursor", "auto");
						alert("An error has occurred: "+data); //===Show Error Message====
					}
				});
		
		} else {
			document.getElementById('email_error_messages').innerHTML = "Error when entering the fields in the contact form.<br><br>";
			document.getElementById('email_error_messages').innerHTML += "<b>" + mensaje + "</b><br>"; 
			document.getElementById('email_error_messages').style.color='red'; 
		}
	}
	
	// CAPTURADORES DE EVENTOS DE LOS BOTONES:
	document.getElementById("submit-id-contact").addEventListener("click", validar_formulario_email);

