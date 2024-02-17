<?php
    // Iniciar la sesión
    session_start();

    // Verificar si la variable de sesión 'usuario' está configurada
    if(isset($_SESSION['usuario'])) {
        // Si la sesión está iniciada, imprimir un saludo personalizado
        echo "Hola " . $_SESSION['usuario'] . "! Bienvenido de nuevo.";
    } else {
        // Si la sesión no está iniciada, imprimir un saludo genérico
        echo "Hola Mundo!";
    }
?>
