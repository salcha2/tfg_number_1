<?php
// Inicia la sesión
session_start();

// Verifica si se ha enviado la solicitud de cerrar sesión
if(isset($_POST['cerrar_sesion'])) {
    // Elimina todas las variables de sesión
    session_unset();
    // Destruye la sesión
    session_destroy();
    // Redirige al usuario al index.php
    header("Location: index.php");
    exit;
}

// Verifica si el usuario está logueado
if(isset($_SESSION['usuario'])) {
    // Si el usuario está logueado, muestra el botón "Cerrar Sesión"
    echo '<form action="" method="post">';
    echo '<input type="submit" name="cerrar_sesion" value="Cerrar Sesión">';
    echo '</form>';
} else {
    // Si el usuario no está logueado, muestra el botón "Iniciar Sesión" que lleva a login.html
    echo '<a href="login.html"><button>Iniciar Sesión</button></a>';
}
?>
