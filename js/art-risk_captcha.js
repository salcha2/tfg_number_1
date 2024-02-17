    	
      /* ===============
       *  CAPTCHA
       * =============== */
      $(document).ready(function () { 
       	<!-- jQuery(document).ready(function(){ -->
         $('#my-contact-form').captcha(); 
         //$('#captchaInput').tooltip({'trigger':'focus', 'title': 'Password tooltip'});
         $('#captchaInput').tooltip({'effect': 'fade', 'duration': '1', 'title': 'Introduzca por favor el resultado de la suma antes de pulsar \"Enviar\"'});
      });
      
      
      $('#captchaInput').click( function ()
      {
      	//$('#captchaInput').tooltip({'hide': 'false'}); 
      	//$('#captchaInput').tooltip("disable");
      	//$('#captchaInput').tooltip( {"show": "false" });
			//$('#captchaInput').tooltip("close");
			$(this).tooltip("close");

     	});
      	
		

