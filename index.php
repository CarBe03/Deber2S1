<?php
require 'config/conex.php';
$db = new Database();
$con = $db->conectar();
$sql = $con->prepare("SELECT id, nombre, correo, telefono, fecha_registro, estado_asistencia, comentarios FROM registro_reunion");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
// Incluye el archivo que contiene la clase de base de datos
require_once 'config/conex.php';

// Instancia la clase de base de datos
$database = new Database();
$pdo = $database->conectar();

// Consulta SQL para seleccionar los registros de personas interesadas en registrarse
$sql = "SELECT * FROM registro_reunion";

// Prepara y ejecuta la consulta
$stmt = $pdo->prepare($sql);
$stmt->execute();

// Obtiene todos los resultados como un array asociativo
$personas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Registro para Reunión</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .green {
            background-color: green;
            color: white;
        }
        .yellow {
            background-color: yellow;
        }
        .red {
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Lista de Personas Registradas para la Reunión</h1>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Estado</th>
        </tr>
        <?php foreach ($personas as $persona): ?>
            <tr>
                <td><?php echo $persona['nombre']; ?></td>
                <td><?php echo $persona['correo']; ?></td>
                <td>
                    <?php
                    // Determina el color del botón según el estado (ejemplo)
                    $estado_asistencia = strtolower($persona['estado_asistencia']);
                    if ($estado_asistencia == 'asistirá') {
                        echo '<button class="green">Asistirá</button>';
                    } elseif ($estado_asistencia == 'pendiente') {
                        echo '<button class="yellow">Pendiente</button>';
                    } elseif ($estado_asistencia == 'no asistirá') {
                        echo '<button class="red">No Asistirá</button>';
                    } else {
                        echo 'Desconocido';
                    }
                    ?>
                </td>
                <td>
                <a href="eliminar_persona.php?id=<?php echo $persona['id']; ?>"><button>Eliminar</button></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="agregar_persona.php"><button>Agregar Nueva Persona</button></a>
</body>
</html>
