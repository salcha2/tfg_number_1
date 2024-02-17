<?php

	// Rutas de datos para de llamada a GRASS para cada uno de los mapas:
/* */	$repositorio_mapas_GRASS_PERMANENT= "/home/dcagigas/grassdata/art-risk/PERMANENT/";
	$AR01_geotecnia = "AR15_Geotecnia";	//= "AR01_Geotecnia";
	$AR16_precipitacion = "AR16_Precipitacion";	//= "AR16_Precipitacion";
	$AR17_erosion_lluvia = "AR17_Erosion";	//= "AR17_erosion_lluvia";
	$AR18_estres_termico = "AR18_Oscilacion";	//= "AR18_estres_termico";
	$AR19_heladas = "AR19_Heladas";
	$AR20_riesgo_sismo = "AR20_Sismica";	//= "AR20_sismo";
	$AR21_riesgo_inundacion1 = "AR00_Inundacion1";	//= "AR21_inundacion";
	$AR21_riesgo_inundacion2 = "AR00_Inundacion2";	//= "AR21_inundacion";
	$AR21_riesgo_inundacion3 = "AR00_Inundacion2";	//= "AR21_inundacion";
	$AR21_riesgo_inundacion4 = "AR00_Inundacion4";	//= "AR21_inundacion";
	$AR21_riesgo_inundacion5 = "AR00_Inundacion5";	//= "AR21_inundacion";	
	
/* */
/*
	$AR01_geotecnia = "AR19_Heladas";	//= "AR01_Geotecnia";
	$AR16_precipitacion = "AR19_Heladas";	//= "AR16_Precipitacion";
	$AR17_erosion_lluvia = "AR19_Heladas";	//= "AR17_erosion_lluvia";
	$AR18_estres_termico = "AR19_Heladas";	//= "AR18_estres_termico";
	$AR19_heladas = "AR19_Heladas";
	$AR20_riesgo_sismo = "AR19_Heladas";	//= "AR20_sismo";
	$AR21_riesgo_inundacion = "AR19_Heladas";	//= "AR21_inundacion";
*/		
	
/*
	// Dimensiones y extensiones de cada mapa:
	$mapAR01_geotecnia_pixel_dimension = [1147, 822];
	$mapAR01_geotecnia_extent = [-20.41080340912, 26.022737926856, 6.58919659088, 45.40273792685601];  // Oeste, Sur, Este, Norte
	
	$mapAR16_precipitacion_pixel_dimension = [1147, 822];
	$mapAR16_precipitacion_extent = [-20.41080340912, 26.022737926856, 6.58919659088, 45.40273792685601];  // Oeste, Sur, Este, Norte	
	
	$mapAR17_erosion_lluvia_pixel_dimension = [1140, 816];
	$mapAR17_erosion_lluvia_extent = [-20.41080340912, 26.022737926856, 6.58919659088, 45.40273792685601];  // Oeste, Sur, Este, Norte	
	
	$mapAR18_estres_termico_pixel_dimension = [1147, 822];
	$mapAR18_estres_termico_extent = [-20.41080340912, 26.022737926856, 6.58919659088, 45.40273792685601];  // Oeste, Sur, Este, Norte	
	
	$mapAR19_heladas_pixel_dimension = [1140, 816];
	$mapAR19_heladas_extent = [-20.41080340912, 26.022737926856, 6.58919659088, 45.40273792685601];  // Oeste, Sur, Este, Norte	

	$mapAR20_riesgo_sismo_pixel_dimension = [1147, 822];
	$mapAR20_riesgo_sismo_extent = [-20.41080340912, 26.022737926856, 6.58919659088, 45.40273792685601];  // Oeste, Sur, Este, Norte	

	$mapAR21_riesgo_inundacion_pixel_dimension = [1147, 822];
	$mapAR21_riesgo_inundacion_extent = [-20.41080340912, 26.022737926856, 6.58919659088, 45.40273792685601];  // Oeste, Sur, Este, Norte	
*/

	if (isset($_POST["coordArray"])) { 
   	$coordArray = $_POST["coordArray"]; // save $foo from POST made by HTTP request
    	if(empty($coordArray) || !is_array($coordArray)){  
    		// $coordArray no es un Array o está vacío
    		$salida="Error: vector parametros coordenadas (x,y) Art-Risk3 vacio o no es un Array"; 
		} elseif (count($coordArray)!= 2) {
    		// $coordArray no tiene 2 parámetros
    		$salida="Error: el numero de parametros de las coordendas de los mapas de Art-Risk3 debe ser 2"; 
   	} else {
			$salida = null;
			
			$latitude = $coordArray[0]; 
			$longitude = $coordArray[1];
			
			// 0 geotecnia; 1 precipitacion; 2 erosion_lluvia; 3 estres_termico; 4 heladas; 5 riesgo_sismo; 6 riesgo_inundacion;
			//$salida = "5,5,5,5,5,5,";
			$salida = "";
			
   		/* La coma concatenada en '$salida' es para poder luego separar en 'art-risk-tool.js' los 3 valores:
   			vulnerabilidad, riesgo y funcionalidad */
   		
			// Ejecución con 'exec':
			
			putenv("LANG=es_ES.UTF-8"); 	
			//putenv("LANGUAGE=es_ES"); 	
			putenv("HOME=/home/dcagigas");
			//putenv ("GRASSDB=/home/dcagigas/grassdata");		
				
			//$input = "grass74 ".$repositorio_mapas_GRASS_PERMANENT." --exec v.what map=".$AR19_heladas." coordinates=".$longitude.",".$latitude." layer=1 -a | grep value* | cut  -d ' ' -f 3";
			//$input = "grass74 /home/dcagigas/grassdata/art-risk/PERMANENT/ --exec v.what map=AR19_Heladas coordinates=".$longitude.",".$latitude." layer=1 -a | grep value* | cut  -d ' ' -f 3";
			//$input = "grass74 /home/dcagigas/grassdata/art-risk/PERMANENT/ --exec v.what map=AR19_Heladas coordinates=-7.80029296875,42.5830078125 layer=1 -a | grep value* | cut  -d ' ' -f 3";
			
			$input = "grass78 ".$repositorio_mapas_GRASS_PERMANENT." --exec v.what map=".$AR01_geotecnia." coordinates=".$longitude.",".$latitude." layer=1 -a | grep Codigo* | cut  -d ' ' -f 3";
			$output = "";			
			exec($input, $output, $status);  
			if (empty($output) == TRUE){
			// if ($output == "" || is_nan($output)==TRUE || is_null($output)==TRUE || empty($output) == TRUE){
				// Al mapa de Geotecnia le faltan datos
				$salida = "8,8,8,8,8,8,8,";	
				echo $salida; 
				exit ();  													
			}
   		foreach ($output as $line) {
				// Si $line contiene el código 9 (Error) entonces las coordenadas seleccionadas pertenecen al mar o a Portugal.
				// En este caso hay que devolver todo '9' y salir:
				if ($line=="9") {
					$salida = "9,9,9,9,9,9,9,";	
					echo $salida; 
					exit ();  								
				}   			
    			$salida = $salida.$line.",";
   		}   			
			$input = "grass78 ".$repositorio_mapas_GRASS_PERMANENT." --exec v.what map=".$AR16_precipitacion." coordinates=".$longitude.",".$latitude." layer=1 -a | grep Codigo* | cut  -d ' ' -f 3";
			$output = "";	
			exec($input, $output, $status);  
   		foreach ($output as $line) {
    			$salida = $salida.$line.",";
   		}   			
   		$input = "grass78 ".$repositorio_mapas_GRASS_PERMANENT." --exec v.what map=".$AR17_erosion_lluvia." coordinates=".$longitude.",".$latitude." layer=1 -a | grep Codigo* | cut  -d ' ' -f 3";
			$output = "";	
			exec($input, $output, $status);  
   		foreach ($output as $line) {
    			$salida = $salida.$line.",";
   		}   			
			$input = "grass78 ".$repositorio_mapas_GRASS_PERMANENT." --exec v.what map=".$AR18_estres_termico." coordinates=".$longitude.",".$latitude." layer=1 -a | grep Codigo* | cut  -d ' ' -f 3";
			$output = "";	
			exec($input, $output, $status);  
   		foreach ($output as $line) {
    			$salida = $salida.$line.",";
   		}   			
			$input = "grass78 ".$repositorio_mapas_GRASS_PERMANENT." --exec v.what map=".$AR19_heladas." coordinates=".$longitude.",".$latitude." layer=1 -a | grep Codigo* | cut  -d ' ' -f 3";
			$output = "";	
			exec($input, $output, $status);  
   		foreach ($output as $line) {
    			$salida = $salida.$line.",";
   		}   			
			$input = "grass78 ".$repositorio_mapas_GRASS_PERMANENT." --exec v.what map=".$AR20_riesgo_sismo." coordinates=".$longitude.",".$latitude." layer=1 -a | grep Codigo* | cut  -d ' ' -f 3";
			$output = "";	
			exec($input, $output, $status);  
   		foreach ($output as $line) {
    			$salida = $salida.$line.",";
   		} 
   		
   		
   		// RIESGO DE INUNDACION: está definido en 5 capas/mapas diferentes. 
   		// CAPA 1 INUNDACION
   		/*
   		$resultado_anterior =""; 			
			$input = "grass74 ".$repositorio_mapas_GRASS_PERMANENT." --exec v.what map=".$AR21_riesgo_inundacion1." coordinates=".$longitude.",".$latitude." layer=1 -a | grep Codigo* | cut  -d ' ' -f 3";			
			$output = "";	
			exec($input, $output, $status);  
			$resultado_anterior = $output;
			*/
			$resultado_anterior =array(1);
			// CAPA 2 INUNDACION
			$input = "grass78 ".$repositorio_mapas_GRASS_PERMANENT." --exec v.what map=".$AR21_riesgo_inundacion2." coordinates=".$longitude.",".$latitude." layer=1 -a | grep Codigo* | cut  -d ' ' -f 3";			
			$output = "";	
			exec($input, $output, $status);  
			if (count($output) !=0) {
				// Hay datos para la capa 2. Riesgo por tanto >1. Seguir probando.
				$resultado_anterior = $output;
				// CAPA 3 INUNDACION
				$input = "grass78 ".$repositorio_mapas_GRASS_PERMANENT." --exec v.what map=".$AR21_riesgo_inundacion3." coordinates=".$longitude.",".$latitude." layer=1 -a | grep Codigo* | cut  -d ' ' -f 3";			
				$output = "";					
				exec($input, $output, $status);
				if (count($output) !=0) {
				// Hay datos para la capa 3. Riesgo por tanto >2. Seguir probando.
					$resultado_anterior = $output;
					// CAPA 4 INUNDACION
					$input = "grass78 ".$repositorio_mapas_GRASS_PERMANENT." --exec v.what map=".$AR21_riesgo_inundacion4." coordinates=".$longitude.",".$latitude." layer=1 -a | grep Codigo* | cut  -d ' ' -f 3";			
					$output = "";					
					exec($input, $output, $status);	
					if (count($output) !=0) {
						// Hay datos para la capa 4. Riesgo por tanto >3. Seguir probando.
						$resultado_anterior = $output;
						// CAPA 5 INUNDACION
						$input = "grass78 ".$repositorio_mapas_GRASS_PERMANENT." --exec v.what map=".$AR21_riesgo_inundacion5." coordinates=".$longitude.",".$latitude." layer=1 -a | grep Codigo* | cut  -d ' ' -f 3";			
						$output = "";					
						exec($input, $output, $status);
						if (count($output) !=0) {
							// HABÍA DATOS EN LA CAPA 5
							$resultado_anterior = $output;	
						}
					}			
				}
			}
				

/*
			$input = "grass74 ".$repositorio_mapas_GRASS_PERMANENT." --exec v.what map=".$AR21_riesgo_inundacion5." coordinates=".$longitude.",".$latitude." layer=1 -a | grep Codigo* | cut  -d ' ' -f 3";			
			$output = "";	
			exec($input, $output, $status);  
//file_put_contents("/home/dcagigas/grassdata/art-risk/Depuracion.txt", "Riesgo5: -".$output."-".count($output)."-\n  ", FILE_APPEND | LOCK_EX);
			if (count($output) ==0) {
				// Comprobar capa 4:
				$input = "grass74 ".$repositorio_mapas_GRASS_PERMANENT." --exec v.what map=".$AR21_riesgo_inundacion4." coordinates=".$longitude.",".$latitude." layer=1 -a | grep Codigo* | cut  -d ' ' -f 3";
				$output = "";	
				exec($input, $output, $status); 
//file_put_contents("/home/dcagigas/grassdata/art-risk/Depuracion.txt", "Riesgo4: -".$output."-".count($output)."-\n  ", FILE_APPEND | LOCK_EX);
				if (count($output) ==0) {
					// Comprobar capa 3:
					$input = "grass74 ".$repositorio_mapas_GRASS_PERMANENT." --exec v.what map=".$AR21_riesgo_inundacion3." coordinates=".$longitude.",".$latitude." layer=1 -a | grep Codigo* | cut  -d ' ' -f 3";
					$output = "";	
					exec($input, $output, $status); 
//file_put_contents("/home/dcagigas/grassdata/art-risk/Depuracion.txt", "Riesgo3: -".$output."-".count($output)."-\n  ", FILE_APPEND | LOCK_EX);
					if (count($output) ==0) {
						// Comprobar capa 2:
						$input = "grass74 ".$repositorio_mapas_GRASS_PERMANENT." --exec v.what map=".$AR21_riesgo_inundacion2." coordinates=".$longitude.",".$latitude." layer=1 -a | grep Codigo* | cut  -d ' ' -f 3";
						$output = "";	
						exec($input, $output, $status); 
//file_put_contents("/home/dcagigas/grassdata/art-risk/Depuracion.txt", "Riesgo2: -".$output."-".count($output)."-\n  ", FILE_APPEND | LOCK_EX);
						if (count($output) ==0) {
							// Comprobar capa 1:
							$input = "grass74 ".$repositorio_mapas_GRASS_PERMANENT." --exec v.what map=".$AR21_riesgo_inundacion1." coordinates=".$longitude.",".$latitude." layer=1 -a | grep Codigo* | cut  -d ' ' -f 3";
							$output = "";	
							exec($input, $output, $status); 
//file_put_contents("/home/dcagigas/grassdata/art-risk/Depuracion.txt", "Riesgo1: -".$output."-".count($output)."-\n  ", FILE_APPEND | LOCK_EX);
						} //else {
							//$output = 5;						
						//}
					}
				}
			}		
*/			
			
			// FIN CONSULTAS GRASS			
			
				
   		//foreach ($output as $line) {
   		foreach ($resultado_anterior as $line) {
    			$salida = $salida.$line.",";
   		}   			

   	}
   } else {
    	$salida="Error: el parametro de entrada a Art-Risk3 en la sección de elección de coordenadas en un mapa no es un Array";    // exist but it's null
   }
	echo $salida; 
	
	exit ();  
	
	
	// DEBUG:
	function debug_to_console($comment, $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log('Debug Objects. ".$comment.": ". $output . "' );</script>";
	}


?>
