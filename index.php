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
    <a href="#" id="btnAgregarPersona"><button>Agregar Nueva Persona</button></a>
    <div id="tablaAgregarPersona" style="display: none;">
        <h2>Agregar Nueva Persona a la Reunión</h2>
        <form id="formAgregarPersona" action="#" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required><br><br>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono"><br><br>

            <label for="fecha_registro">Fecha_Registro:</label>
            <input type="text" id="fecha_registro" name="fecha_registro"><br><br>
            
            <label for="estado_asistencia">Estado_Asistencia:</label>
            <input type="text" id="estado_asistencia" name="estado_asistencia"><br><br>

            <input type="submit" value="Registrar Persona">
        </form>
    </div>

    <table>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Estado</th>
            <th>Acciones</th>
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
                    <button class="eliminarPersona" data-id="<?php echo $persona['id']; ?>">Eliminar</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>
        // Función para mostrar u ocultar la tabla de agregar persona al hacer clic en el botón correspondiente
        document.getElementById('btnAgregarPersona').addEventListener('click', function() {
            var tablaAgregarPersona = document.getElementById('tablaAgregarPersona');
            tablaAgregarPersona.style.display = tablaAgregarPersona.style.display === 'none' ? 'block' : 'none';
        });

        // Función para manejar la eliminación de personas
        var botonesEliminar = document.querySelectorAll('.eliminarPersona');
        botonesEliminar.forEach(function(boton) {
            boton.addEventListener('click', function() {
                var idPersona = this.getAttribute('data-id');
                if (confirm('¿Estás seguro de eliminar esta persona?')) {
                    // Aquí podrías enviar una petición AJAX para eliminar la persona con el ID correspondiente
                    // Por simplicidad, en este ejemplo solo mostramos un mensaje de confirmación
                    alert('Persona eliminada con éxito');
                    // Aquí podrías recargar la lista de personas para reflejar los cambios
                }
            });
        });
    </script>
</body>
</html>
