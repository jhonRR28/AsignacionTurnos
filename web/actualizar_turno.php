// actualizar_turno.php

<?php
require 'db.php'; // Incluye tu archivo de conexión a la base de datos

// Obtener el ID del cajero desde la solicitud POST
$cajero_id = $_POST['cajero_id'];

// Actualizar el turno en la base de datos
$stmt = $conn->prepare("UPDATE turnos SET estado = 'atendido' WHERE cajero_id = ? AND estado = 'atendiendo' ORDER BY id ASC LIMIT 1");
$stmt->execute([$cajero_id]);

// Obtener el nuevo turno actualizado
$stmt = $conn->prepare("SELECT numero FROM turnos WHERE cajero_id = ? AND estado = 'atendiendo' ORDER BY id ASC LIMIT 1");
$stmt->execute([$cajero_id]);
if ($stmt->rowCount() > 0) {
    $turno = $stmt->fetch();
    $nuevoNumero = $turno['numero'];
    // Devolver el nuevo número de turno como respuesta JSON
    echo json_encode(['nuevoNumero' => $nuevoNumero]);
} else {
    // Si no hay más turnos pendientes, devolver un mensaje de error o manejarlo según tu lógica de negocio
    echo json_encode(['error' => 'No hay más turnos pendientes']);
}
?>
