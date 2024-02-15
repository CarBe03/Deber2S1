<?php
require_once 'config/conex.php';

// Verificar si se enviaron los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $telefono = $_POST['telefono'] ?? '';

    // Verificar que los campos obligatorios no estén vacíos
    if (!empty($nombre) && !empty($correo)) {
        // Instancia la clase de base de datos
        $database = new Database();
        $pdo = $database->conectar();

        // Preparar la consulta SQL para insertar la nueva persona
        $sql = "INSERT INTO registro_reunion (nombre, correo, telefono) VALUES (:nombre, :correo, :telefono)";

        // Prepara y ejecuta la consulta
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nombre' => $nombre, 'correo' => $correo, 'telefono' => $telefono]);

        // Redirigir de vuelta a la página principal
        header('Location: index.php');
        exit;
    } else {
        // Si no se recibieron los datos necesarios, redirigir de vuelta a la página de agregar persona
        header('Location: agregar_persona.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Persona</title>
</head>
<body>
    <h1>Agregar Persona a la Reunión</h1>
    <form action="" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono"><br><br>

        <label for="fecha_registro">Fecha_Registro:</label>
        <input type="text" id="fecha_registro" name="fecha_registro"><br><br>

        <label for="estado_asistencia">Estado_asistencia:</label>
        <input type="text" id="estado_asistencia" name="estado_asistencia"><br><br>


        <input type="submit" value="Registrar Persona">
    </form>
</body>
</html>
