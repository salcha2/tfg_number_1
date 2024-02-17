
<?php

//error_reporting(-1);
//ini_set('display_errors', 'On');
//set_error_handler("var_dump");
/*
			miArray[0] = document.getElementById('nombre_apellidos').value;
			miArray[1] = document.getElementById('correo_electronico').value;
			miArray[2] = document.getElementById('telefono').value;
			miArray[3] = document.getElementById('mensaje').value;
*/
//$salida="";
//$salida = "Punto1<br>";

	if (isset($_POST["miArray"])) { 
//$salida .= "Punto2<br>";
   	$miArray = $_POST["miArray"]; // save $foo from POST made by HTTP request
//$salida .= "Punto3<br>".$miArray." <br>";
//foreach ($miArray as $element ) {
//	$salida .=$element." <br>";
//}


    	if(empty($miArray) || !is_array($miArray)){  
    		// $miArray no es un Array o está vacío
    		$salida="Error: vector parametros formulario contacto vacio o no es un Array"; 
//$salida .= "Punto4<br>";
		} elseif (count($miArray)!= 4) {
    		// $miArray no tiene 4 parámetros
    		$salida="Error: el numero de parametros del formulario de contacto debe ser 4"; 
//$salida .= "Punto5<br>";
   	} else {
   		// Limpiar campos array  		
//$salida .= "Punto6<br>";
			for ($i=0; $i<4; ++$i) {
				$miArray[$i] = sanitizeString ($miArray[$i]);				
			}  
//$salida .= "Punto7<br>";
//foreach ($miArray as $element ) {
//	$salida .=$element." <br>";
//}
			// Comprobación de errores:
    		$error_message = "";
    		$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    		//$string_exp = "/^[A-Za-z .'-]+$/";
    		//$string_exp = "/^[A-Za-z .'-áéíóúÁÉÍÓÚñÑ]+$/";
    		$string_exp = "/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/";
    
  			//if (!preg_match($string_exp, $miArray[0])) {
  			if ( strlen($miArray[0]) < 2 || strlen($miArray[0]) > 80) { // || strlen($miArray[0]) > 80
    			$error_message .= 'El nombre y apellidos que ha ingresado no parece ser válido: '.$miArray[0].'<br />';
  			}
  			if (!preg_match($email_exp, $miArray[1]) || strlen($miArray[1]) > 50) { // || strlen($miArray[1]) > 50
    			$error_message .= 'El email que ha ingresado no parece ser válido: '.$miArray[1].'<br />';
  			}
  			if (strlen($miArray[2]) > 50) { // || strlen($miArray[2]) > 50
    			$error_message .= 'El teléfono que ha ingresado no parece ser válido: '.$miArray[2].'<br />';
  			}
  			if(strlen($miArray[3]) < 2 || strlen($miArray[3]) > 2000) {
    			$error_message .= 'El mensaje que ha ingresado no parece ser válido (debe ser menor de 2000 caracteres y no ser vacío) <br />';
  			}
  			if(strlen($error_message) > 0) {
  				//document.getElementById('email_error_messages').innerHTML = $error_message;
  				//document.getElementById('email_error_messages').style.color='red';
  				$salida = $error_message; //."ERROR -------------<br>";
  				echo "ERROR -------------<br>".$salida;
    			exit ();
  			}	

//$salida .= "Punto8<br>";
/*foreach ($miArray as $element ) {
	$salida .=$element." <br>";
}
*/
			// Mandar correo:
			// Para y asunto del mensaje a enviar
    		$email_to = "dcagigas@us.es"; 
    		$email_subject = "[Art-Risk3] Mensaje de ".$miArray[0];
     		// Cuerpo del Email
/*
$salida .= "<b>Punto9</b><br>";
foreach ($miArray as $element ) {
	$salida .=$element." <br>";
}   
$salida .="<br>";
$salida .= $email_to."<br>".$email_subject."<br>"; //.$CuerpoMensaje."<br>"
*/

/*
    		$CuerpoMensaje .= "<br>Detalles del correo:\r\n\r\n";
    		$CuerpoMensaje .= "<br><b>Nombre y apellidos:</b> ".$miArray[0]."\r\n";
    		$CuerpoMensaje .= "<br><b>Email:</b> ".$miArray[1]."\r\n";    
    		$CuerpoMensaje .= "<br><b>Telefono:</b> ".$miArray[2]."\r\n";
    		$CuerpoMensaje .= "<br><b>Mensaje:</b> ".$miArray[3]."\r\n<br>";

			//armando mensaje del email
    		$email_message = "--=A=G=R=O=\r\n";
    		$email_message .= "Content-type:text/plain; charset=utf-8\r\n";
    		$email_message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    		$email_message .= $CuerpoMensaje . "\r\n\r\n";

         // Set content-type header for sending HTML email
         $headers = "MIME-Version: 1.0" . "\r\n";
         $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
*/



            $email_message = '<h2>Petición del formulario de contacto enviada</h2>
                <h4>Nombre: </h4><p>'.$miArray[0].'</p>
                <h4>Email: </h4><p>'.$miArray[1].'</p>
                <h4>Telefono: </h4><p>'.$miArray[2].'</p>
                <h4>Mensaje: </h4><p>'.$miArray[3].'</p>';
            
            // Set content-type header for sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // Additional headers
            $headers .= 'From: '.$miArray[0].'<'.$miArray[1].'>'. "\r\n";

    		//enviamos el email
    		
/**/
//$salida .= "<b>Punto10</b><br>";
//foreach ($miArray as $element ) {
//	$salida .=$element." <br>";
//}   
//$salida .="<br>";
//$salida .= $email_to."<br>".$email_subject."<br>".$email_message."<br>";
/**/
			$status = mail ($email_to, $email_subject, $email_message, $headers);
			if($status)
			{ 
    			$salida.="Mensaje enviado correctamente<br>";	
			} else { 
    			$salida.="Mensaje NO enviado por el servidor de correo.<br>";
			}
		
    		//mail($email_to, $email_subject, $email_message);
    		//$salida.="Mensaje enviado correctamente<br>";			
   	}
   } else {
    	$salida="Error: no hay parametros de entrada para el formulario de contacto<br>";    // exist but it's null
   }
	//echo "Salida: ".$salida." Status: ".$status; 	

	echo $salida; 
	
	exit ();  
	
  function sanitizeString($var)
  {
  
    $var = stripslashes($var);
    $var = strip_tags($var);
    $var = htmlentities($var);
    return $var;
  }	
?>

<!--
	if (isset($_POST["miArray"])) { 
   	$miArray = $_POST["miArray"]; // save $foo from POST made by HTTP request
    	if(empty($miArray)){  
    		$errMess="Vacio";    // exist but it's null
   	} else {
   		$errMess=$miArray.": Daniel";
   	}
   }
	echo "Resultado: ".$errMess; 
	exit ()   

    -->
 
 <!-- $miArray = $_POST['miArray']  -->
	<!--
	foreach($miArray as $msg){
    	echo $msg;
    	-->
    	