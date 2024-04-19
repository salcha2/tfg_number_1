<?php
// Conexión a la base de datos PostgreSQL
$conexion = pg_connect("host=localhost dbname=Colombia user=main password=Soum22");

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error en la conexión a la base de datos: " . pg_last_error());
}

session_start();

// Verificar si se han enviado datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar y sanitizar los datos del formulario de registro
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
    $email = htmlspecialchars($_POST['email']);
    $telefono = htmlspecialchars($_POST['telefono']); // Teléfono
    $institucion = htmlspecialchars($_POST['institucion']); // Institución/Empresa
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Verificar si todos los campos obligatorios están completos
    if (!empty($nombre) && !empty($apellido) && !empty($email) && !empty($username) && !empty($password)) {
        // Generar el hash de la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insertar datos en la base de datos utilizando una consulta preparada
        $query = "INSERT INTO admin_users (name, lastname, email, telefono, institucion, username, password) VALUES ($1, $2, $3, $4, $5, $6, $7)";
        $resultado = pg_query_params($conexion, $query, array($nombre, $apellido, $email, $telefono, $institucion, $username, $hashed_password));

        if ($resultado) {
            echo "Registro exitoso. <a href='login.html'>Iniciar Sesión</a>";
        } else {
            echo "Error en el registro: " . pg_last_error($conexion);
        }
    } else {
        echo "Por favor, complete todos los campos del formulario.";
    }
} else {
    echo "El formulario no ha sido enviado correctamente.";
}

// Cerrar la conexión a la base de datos al final del script
pg_close($conexion);
?>
