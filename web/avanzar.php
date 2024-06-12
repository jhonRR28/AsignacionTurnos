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
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Turnos</title>
    <link rel="stylesheet" href="stylesa.css">
    <script src="admin.js" defer></script>
</head>

<body>
    <div class="navbar">
        <div class="user-container">
            <button class="user-btn">Administrador</button>
        </div>
    </div>
    <div class="container">
        <h1>Administrar Turnos</h1>
        <div class="turnos-admin">
            <div class="cajero-turnos" id="cajero1Turnos">
                <h3>Cajero 1</h3>
                <h3><img src="icono1.png" alt="Cajero 1" class="cajero-icon"> Cajero 1</h3>
                <p id="cajero1Numero">A: 1</p>
                <button onclick="avanzarTurno('cajero1')">Avanzar Turno</button>
            </div>
            <div class="cajero-turnos" id="cajero2Turnos">
                <h3>Cajero 2</h3>
                <h3><img src="icono1.png" alt="Cajero 2" class="cajero-icon"> Cajero 2</h3>
                <p id="cajero2Numero">B: 1</p>
                <button onclick="avanzarTurno('cajero2')">Avanzar Turno</button>
            </div>
            <div class="cajero-turnos" id="cajero3Turnos">
                <h3>Cajero 3</h3>
                <h3><img src="icono1.png" alt="Cajero 3" class="cajero-icon"> Cajero 3</h3>
                <p id="cajero3Numero">C: 1</p>
                <button onclick="avanzarTurno('cajero3')">Avanzar Turno</button>
            </div>
        </div>
    </div>
</body>

</html>
