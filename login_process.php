<?php
    // Conexión a la base de datos PostgreSQL
    $conexion = pg_connect("host=localhost dbname=main user=main password=Soum22");

    // Recuperar datos del formulario de inicio de sesión
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Obtener el hash de la contraseña desde la base de datos
    $query = "SELECT password_hash FROM usuarios WHERE username='$username'";
    $resultado = pg_query($conexion, $query);
    $registro = pg_fetch_assoc($resultado);
    $hashed_password = $registro['password_hash'];

    // Verificar la contraseña
    if (password_verify($password, $hashed_password)) {
        // Inicio de sesión exitoso
        // Establecer la variable de sesión 'usuario'
        session_start();
        $_SESSION['usuario'] = $username;

        // Redirigir al usuario a la página deseada
        header("Location: /art-risk3v4_09-02-2024_upo/index.php");
        exit; // Asegura que el script termine aquí para evitar cualquier salida adicional
    } else {
        // Credenciales incorrectas
        echo "Credenciales incorrectas. <a href='login.php'>Intentar de nuevo</a>";
    }
?>
