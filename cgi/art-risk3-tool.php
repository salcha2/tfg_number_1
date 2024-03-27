<?php
// Verifica si se recibió un array llamado "miArray"
if (isset($_POST["miArray"])) { 
    $miArray = $_POST["miArray"]; // Guarda $miArray del POST hecho por la solicitud HTTP

    // Verifica si $miArray está vacío o no es un array
    if(empty($miArray) || !is_array($miArray)){  
        // $miArray no es un Array o está vacío
        $salida = "Error: vector parametros Art-Risk3 vacío o no es un Array"; 
    } elseif (count($miArray) != 19) {
        // $miArray no tiene 19 parámetros
        $salida = "Error: el numero de parametros de Art-Risk3 debe ser 19"; 
    } else {
        $error = 0;
        // Verifica si los elementos de $miArray están en el rango válido
        for ($i = 0; $i < 19; ++$i) {
            if ($miArray[$i] < 1.0 || $miArray[$i] > 5.0) {
                // Alguno de los 19 parámetros de $miArray no contiene un dato válido 
                $salida = "Error: alguno de los 19 parametros de Art-Risk no está entre 1.0 y 5.0 " . $i; 
                $error = 1;
                break;
            }
        }  

        if (!$error) {
            // No hay errores
            $input = "./art-risk3.bin";
            // Construye la cadena de entrada para ejecutar
            for ($i = 0; $i < 19; ++$i) {
                $input .= " " . $miArray[$i];
            }  

            $input .= " 2>&1"; 	  		
            exec($input, $output, $status);
            $salida = "";
            
            // Construye la salida concatenando cada línea
            foreach ($output as $line) {
                $salida .= $line . ",";
            }
        }		
    }
} else {
    $salida = "Error: el parametro de entrada a Art-Risk no es un Array";    // Existe pero es nulo
}
// Imprime la salida
echo $salida;
// Finaliza la ejecución del script
exit();
?>
