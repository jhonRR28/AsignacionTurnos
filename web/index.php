<?php
require 'db.php';

$stmt = $conn->query("SELECT * FROM servicios");
$cajas = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Turnos</title>
    <link rel="stylesheet" href="styles.css">
    <script src="validation.js" defer></script>
</head>

<body>
    <div class="navbar">
        <div class="user-container">
            <button class="user-btn">Administrador</button>
        </div>
    </div>
    <div class="margen"></div>
    <div class="container">
        <h1>Sistema de Turnos</h1>
        <form id="turnoForm" action="asignar-turno.php" method="post" novalidate>
            <div class="form-group">
                <label for="cajero">Cajero:</label>
                <select id="cajero" name="ventanilla" required>
                <?php foreach ($cajas as $caja): ?>
                  <option value="<?= $caja['id'] ?>"><?= $caja['nombre'] ?></option>
                <?php endforeach; ?>
                </select>
                <span class="error" id="cajeroError"></span>
            </div>
            <div class="form-group">
                <label for="cedula">Cédula:</label>
                <input type="text" id="cedula" name="cedula" required>
                <span class="error" id="cedulaError"></span>
            </div>
            <div class="form-group">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" id="username" name="username" required>
                <span class="error" id="usernameError"></span>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <span class="error" id="emailError"></span>
            </div><br>

            <button type="submit">Solicitar Turno</button>
        </form>
    </div>
</body>

</html>
