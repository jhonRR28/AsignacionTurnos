<?php
require 'db.php'; // Incluye tu archivo de conexión a la base de datos

session_start(); 

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cajero_id'])) {
    try {
        // Obtener el ID del cajero desde la solicitud POST
        $cajero_id = $_POST['cajero_id'];

        // Actualizar el turno en la base de datos
        $stmt = $conn->prepare("UPDATE turnos SET estado = 'atendido' WHERE cajero_id = ? AND estado = 'atendiendo' ORDER BY id ASC LIMIT 1");
        $stmt->execute([$cajero_id]);

        // Obtener el nuevo turno actualizado
        // $stmt = $conn->prepare("SELECT numero FROM turnos WHERE cajero_id = ? AND estado = 'pendiente' ORDER BY id ASC LIMIT 1");
        $stmt = $conn->prepare("SELECT id,numero FROM turnos WHERE estado = 'pendiente' ORDER BY id ASC LIMIT 1");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $turno = $stmt->fetch();
            $nuevo_turno = $turno['numero'];
            $id_turno = $turno['id'];
            $stmt = $conn->prepare("UPDATE turnos SET estado = 'atendiendo', cajero_id = ? WHERE id = ?");
            $stmt->execute([$cajero_id, $id_turno]);
            // Devolver el nuevo número de turno como respuesta JSON
            echo json_encode([
                "message" => "El turno ha sido avanzado.",
                'nuevo_turno' => $nuevo_turno
            ]);
        } else {
            // Si no hay más turnos pendientes, devolver un mensaje de error o manejarlo según tu lógica de negocio
            echo json_encode([
                'message' => 'No hay más turnos pendientes'
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            "message" => "Error: " . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        "message" => "Solicitud inválida."
    ]);
}
