<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ventanilla = $_POST['ventanilla'];
    $cedula = $_POST['cedula'];
    $username = $_POST['username'];
    $email = $_POST['email'];
  
    $stmt = $conn->prepare("SELECT MAX(numero) AS max_numero FROM turnos WHERE servicio_id = ?");
    $stmt->execute([$ventanilla]);
    $result = $stmt->fetch();
    $nuevo_turno = $result['max_numero'] + 1;

    $stmt = $conn->prepare("INSERT INTO usuarios (cedula, nombre, correo) VALUES (?, ?, ?)");
    $stmt->execute([$cedula, $username, $email]);
  
    $stmt = $conn->prepare("INSERT INTO turnos (servicio_id, usuario_cedula, numero) VALUES (?, ?, ?)");
    $stmt->execute([$ventanilla, $cedula, $nuevo_turno]);
  
    header("Location: mostrar.php?dato=" . urlencode($nuevo_turno));
  } else {
    echo "Error al llenar formulario";
  }
?>
