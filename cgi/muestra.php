<?php
// Verifica si se han recibido datos del formulario mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    // Verifica si se han recibido todos los campos esperados y que no están vacíos
    $expectedFields = array(
        'result_vulnerability', 'result_risk', 'result_functionality',
        'id_v11', 'id_v21', 'id_v31', 'id_v41', 'id_v51', 'id_v61', 'id_v71', 'id_v81', 'id_v91', 'id_v101', 'id_v111', 'id_v121', 'id_v131', 'id_v141', 'id_v151', 'id_v161', 'id_v171', 'id_v181', 'id_v191', 'id_v201', 'id_v211',
        'latinput', 'loninput'
    );

    $error = false; // Variable para controlar si ha ocurrido un error

    foreach ($expectedFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            // Si falta un campo o está vacío, establece la bandera de error y detiene la ejecución del script
            $error = true;
            break;
        }
    }

    if (!$error) {
        // Obtiene los valores de los campos
        $result_vulnerability = $_POST['result_vulnerability'];
        $result_risk = $_POST['result_risk'];
        $result_functionality = $_POST['result_functionality'];
        $id_v1 = $_POST['id_v11'];
        $id_v2 = $_POST['id_v21'];
        $id_v3 = $_POST['id_v31'];
        $id_v4 = $_POST['id_v41'];
        $id_v5 = $_POST['id_v51'];
        $id_v6 = $_POST['id_v61'];
        $id_v7 = $_POST['id_v71'];
        $id_v8 = $_POST['id_v81'];
        $id_v9 = $_POST['id_v91'];
        $id_v10 = $_POST['id_v101'];
        $id_v11 = $_POST['id_v111'];
        $id_v12 = $_POST['id_v121'];
        $id_v13 = $_POST['id_v131'];
        $id_v14 = $_POST['id_v141'];
        $id_v15 = $_POST['id_v151'];
        $id_v16 = $_POST['id_v161'];
        $id_v17 = $_POST['id_v171'];
        $id_v18 = $_POST['id_v181'];
        $id_v19 = $_POST['id_v191'];
        $id_v20 = $_POST['id_v201'];
        $id_v21 = $_POST['id_v211'];
        $latitud = $_POST['latinput'];
        $longitud = $_POST['loninput'];
        $usuario = $_SESSION['usuario']; // Cambiado a $usuario

        // Configuración de la conexión a la base de datos PostgreSQL
        $dsn = "pgsql:host=localhost;port=5432;dbname=Colombia;user=main;password=Soum22";

        try {
            // Se establece la conexión a la base de datos
            $dbh = new PDO($dsn);
            // Habilitar el manejo de errores
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Prepara la consulta SQL para insertar los datos en la tabla correspondiente
            // Prepara la consulta SQL para insertar los datos en la tabla correspondiente
// Obtener el número de registros que ha hecho el usuario
$stmt_count = $dbh->prepare("SELECT COUNT(*) FROM spots WHERE usuario = ?");
$stmt_count->execute([$usuario]);
$registro_usuario = $stmt_count->fetchColumn();

// Construir el valor del slug
$slug = $usuario . $registro_usuario;

// Prepara la consulta SQL para insertar los datos en la tabla correspondiente
$stmt = $dbh->prepare("INSERT INTO spots 
                    (result_vulnerability, result_risk, result_functionality, id_v1, id_v2,id_v3,id_v4,id_v5,id_v6,id_v7,id_v8,id_v9,id_v10,id_v11,id_v12,id_v13,id_v14,id_v15,id_v16,id_v17,id_v18,id_v19,id_v20,id_v21, coordinates, usuario, slug) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,? )");

// Concatena latitud y longitud con una coma entre ellas
$coordinates = $latitud . ',' . $longitud;

// Ejecuta la consulta con los valores de los campos del formulario
$stmt->execute([$result_vulnerability, $result_risk, $result_functionality, $id_v1, $id_v2, $id_v3,$id_v4,$id_v5,$id_v6,$id_v7,$id_v8,$id_v9,$id_v10,$id_v11,$id_v12,$id_v13,$id_v14,$id_v15,$id_v16,$id_v17,$id_v18,$id_v19,$id_v20,$id_v21, $coordinates, $usuario, $slug]);
          
            echo "Los datos se han insertado correctamente en la base de datos";
        } catch (PDOException $e) {
            // Si ocurre un error en la conexión o en la consulta, mostrar el mensaje de error
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    // Si la solicitud no es de tipo POST, muestra un mensaje de error
    echo json_encode('Error: La solicitud no es de tipo POST');
}
?>
