<?php
require 'db.php';

if (isset($_GET['dato'])) {
    $servicio = $_GET['dato'];
} else {
    header("Location: index.html");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Turnos</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="../img/disponibilidad.png">
    <script src="validation.js" defer></script>
</head>

<body>
    <div class="navbar">
        <div class="user-container">
            <button class="user-btn" onclick="window.location.href='index.php'">Solicitar Turno</button>
            <button class="user-btn" onclick="window.location.href='mostrar.php'">Mostrar Turno</button>
            <button class="user-btn" onclick="window.location.href='login.html'">Iniciar Sesión</button>
        </div>
    </div>
    <div class="margen"></div>
    <div class="container">
        <h1>Sistema de Turnos</h1>
        <img src="../img/turnos.png" alt="turnos"><br>
        <form id="turnoForm" action="asignar_turno.php" method="post">
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
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" required>
                <span class="error" id="telefonoError"></span>
            </div><br>
            <input type="hidden" id="servicio" name="servicio" value="<?php echo $servicio ?>">
            <button type="submit">Solicitar Turno</button>
        </form>
    </div>

     <!-- Modal -->
    <div id="turnoModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="turnoMessage">Tu turno fue asignado</p>
        </div>
    </div>

    <script src="modal.js"></script>
</body>

</html>
