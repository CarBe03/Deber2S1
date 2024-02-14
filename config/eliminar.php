<?php
require_once 'config/conex.php';

// Verificar si se recibió un ID válido para eliminar
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    // Instancia la clase de base de datos
    $database = new Database();
    $pdo = $database->conectar();

    // Preparar la consulta SQL para eliminar la persona
    $sql = "DELETE FROM registro_reunion WHERE id = :id";

    // Prepara y ejecuta la consulta
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    // Redirigir de vuelta a la página principal
    header('Location: index.php');
    exit;
} else {
    // Si no se recibió un ID válido, redirigir de vuelta a la página principal
    header('Location: index.php');
    exit;
}
?>
