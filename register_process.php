<?php
// Conexión a la base de datos PostgreSQL
$conexion = pg_connect("host=localhost dbname=main user=main password=Soum22");

session_start();

// Verificar si la variable de sesión está configurada
if(isset($_SESSION['usuario'])) {
    // Mostrar el valor de la variable de sesión
    echo "El usuario actual es: " . $_SESSION['usuario'];
} else {
    // La variable de sesión no está configurada
    echo "La variable de sesión 'usuario' no está configurada.";
}

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
        $query = "INSERT INTO usuarios (nombre, apellido, email, telefono, institucion, username, password_hash) VALUES ($1, $2, $3, $4, $5, $6, $7)";
        $resultado = pg_query_params($conexion, $query, array($nombre, $apellido, $email, $telefono, $institucion, $username, $hashed_password));

        if ($resultado) {
            echo "Registro exitoso. <a href='login.html'>Iniciar Sesión</a>";
        } else {
            echo "Error en el registro.";
        }
    } else {
        echo "Por favor, complete todos los campos del formulario.";
    }
} else {
    echo "El formulario no ha sido enviado correctamente.";
}
?>
