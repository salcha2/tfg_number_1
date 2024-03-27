    /****************************************************************/
    /* SCRIPTS FORMULARIO HERRAMIENTA */
    /****************************************************************/ 
   	
    /****************************************************************/
    /* VARIABLES PARA EL FORMULARIO DE LA HERRAMIENTA */
    /****************************************************************/   
     
		var vector_params = new Array();
		var vector_errores_texto = new Array ();
		var vector_errores_activacion = new Array ();
		var vector_errores_activacion2 = new Array ();
		var popover_activo = null;
		
		// INICIALIZACIÓN DEL VECTOR "vector_errores_texto" PARA MOSTRAR ERRORES DETALLADOS:
		vector_errores_texto [1] = '1. Geotecnia';
		vector_errores_texto [2] = '2. Entorno construido';
		vector_errores_texto [3] = '3. Sistema constructivo';
		vector_errores_texto [4] = '4. Crecimiento de población';
		vector_errores_texto [5] = '5. Valor patrimonial';
		vector_errores_texto [6] = '6. Valor mueble';
		vector_errores_texto [7] = '7. Ocupación';
		vector_errores_texto [8] = '8. Mantenimiento';
		vector_errores_texto [9] = '9. Diseño de cubierta';
		vector_errores_texto [10] = '10. Conservación';
		vector_errores_texto [11] = '11. Ventilación';
		vector_errores_texto [12] = '12. Instalaciones';
		vector_errores_texto [13] = '13. Riesgo de fuego';
		vector_errores_texto [14] = '14. Sobrecargas de uso';
		vector_errores_texto [15] = '15. Modificaciones estructurales';
		vector_errores_texto [16] = '16. Precipitación media';
		vector_errores_texto [17] = '17. Erosión por lluvia';
		vector_errores_texto [18] = '18. Estrés térmico, variación de temperatura';
		vector_errores_texto [19] = '19. Heladas';
		
		
	 /****************************************************************/
    /* EVENTOS ASOCIADOS A LOS BOTONES DEL FORMULARIO */
    /****************************************************************/   
     	
		// CAPTURADORES DE EVENTOS DE LOS BOTONES:
	document.getElementById("submit-id-send").addEventListener("click", send_button);
	document.getElementById("submit-id-clean").addEventListener("click", clean_button);

/**/
	function clean_button () {  	
		// BOTÓN "LIMPIAR_TODO" HERRAMIENTA.
			for (i=1; i<=21; i++) {
				document.getElementById("id_v"+i).value=" ";
			}
			//$('#id_v21').val('0');
			$('#result_vulnerability').val('');
			$('#result_risk').val('');
			$('#result_functionality').val('');
			document.getElementById("id_v21").value=" ";
			document.getElementById('error_messages').innerHTML=" ";
	}
/**/	
	
	function send_button () {  			
		// BOTÓN "ENVIAR" HERRAMIENTA.
			document.getElementById('error_messages').innerHTML="";

			errors = check_errors ();
			if (!errors) {
				// ENVIO DATOS UNA VEZ VERIFICADO NO HAY ERRORES:
				$.ajax({
    				type: "POST",
    				url: 'cgi/art-risk3-tool.php',
    				data: {miArray: vector_params},
    			
    				success: function(data){
    					var tmp = data.split(",");
        				document.getElementById('result_vulnerability').value = tmp[0];
        				document.getElementById('result_risk').value = tmp[1];
        				document.getElementById('result_functionality').value = tmp[2];
    				},
    				error:function(data){
    					$('html, body').css("cursor", "auto");
						alert("Ha ocurrido un error: "+data); //===Show Error Message====
					}
				});
			}
	}


	
	
	





     /****************************************************************/
    /* VERIFICACIÓN DE ERRORES */
    /****************************************************************/   
 
 
	function check_errors () {  	
		// COMPROBACIÓN DE ERRORES ANTES DE ENVIAR INFORMACIÓN DEL FORMULARIO.	
			// Recopilación datos de las 19 variables:
			errors = 0;
			contador = 0;
			contador2 = 0;
			vector_params = [];
			for (i=1; i<=19; i++) {
				param = document.getElementById("id_v"+i).value;
				// Verificación de que las variables no están vacías
				if (param=="") {
					vector_errores_activacion [i] = 1;
					vector_errores_activacion2 [i] = 0;
					contador++;
				} else {
					vector_errores_activacion [i] = 0;				
					// Verficación de que las variables tienen valores en el rango [1,5]
					if ( param<1 || param>5) {
						vector_errores_activacion2 [i] = 1;
						contador2++;
					} else {
						vector_errores_activacion2 [i] = 0;				
					}
				}
				vector_params.push(param);
			}
						
			// Comprobación de variables vacías:
			if (contador>4) {
				document.getElementById('error_messages').innerHTML = "Error: hay <b>"+contador+"</b> variables de entrada que no tienen ningún valor asignado<br>";
				document.getElementById('error_messages').style.color='red';
				errors = 1;
			} else if (contador>0) {
				if (contador==1) {
					document.getElementById('error_messages').innerHTML = "Error: la siguiente variable de entrada no tienen ningún valor asignado<br>";
				} else {	
					document.getElementById('error_messages').innerHTML = "Error. Las siguientes "+contador+" variables de entrada no tienen ningún valor asignado: <br>";
				}			
				for (i=1; i<=19; i++) {
					if (vector_errores_activacion [i] == 1) {
						document.getElementById('error_messages').innerHTML += "<b>"+vector_errores_texto[i]+"</b><br>";
					}
				}
				document.getElementById('error_messages').style.color='red';
				errors = 1;
			} 
			// Comprobación de rango [1,5]
			if (contador2>4) {
				document.getElementById('error_messages').innerHTML += "<br>Error: hay <b>"+contador2+"</b> variables de entrada que NO tienen valores comprendidos entre 1.0 y 5.0<br>";
				document.getElementById('error_messages').style.color='red';
				errors = 1;
			} else if (contador2>0) {
				if (contador2==1) {
					document.getElementById('error_messages').innerHTML += "<br>Error: la siguiente variable de entrada NO tiene ningún valor comprendido entre 1.0 y 5.0<br>";
				} else {	
					document.getElementById('error_messages').innerHTML += "<br>Error. Las siguientes "+contador2+" variables de entrada NO tienen valores comprendidos entre 1.0 y 5.0: <br>";
				}
				for (i=1; i<=19; i++) {
					if (vector_errores_activacion2 [i] == 1) {
						document.getElementById('error_messages').innerHTML += "<b>"+vector_errores_texto[i]+"</b><br>";
					}
				}
				document.getElementById('error_messages').style.color='red';
				errors = 1;
			} 			
			
		return errors;
		
	}
		
		  
    
    /****************************************************************/
    /* POPOVER */
    /****************************************************************/   
    
    
    $(document).ready (function () {
    	$('.popoverButton ').popover({
    		html:true,
    		container:'body'
    	});
    });
    	

	$(document.body).click(function(e) {
 		//document.getElementById('id_container').onclick = function(e) {
		if($(e.target).hasClass('popoverButton')) {
			if (popover_activo != null && popover_activo != e.target) {
				// Ocultar el anterior popover
				$(popover_activo).popover('hide');
			} 
		
			if (popover_activo!= null && e.target == popover_activo) {
				// Si se ha hecho click sobre el mismo popover, ocultarlo.
				// Si se pone 'hide' no funciona. Creo porque en los controles
				// del formulario pone 'data-toggle="popover"'.
    			$(popover_activo).popover('toggle'); 
    			//$(popover_activo).popover('hide'); 
    			popover_activo = null;   	
    		}
    	
    		if (e.target != popover_activo) {
    			// Mostrar el nuevo popover. No funciona con 'show'.
    			// Mismo motivo que caso anterior.
				popover_activo = e.target;
    			$(popover_activo).popover('toggle');
    		} 

  		} else if (popover_activo != null) {
  			// Ocultar el popover que haya activo cuando se pincha en 
  			// un área del cuerpo del documento.
  			$(popover_activo).popover('toggle');
  			$(popover_activo).popover('hide'); 
  			popover_activo = null;
  		}
	});
  	    
