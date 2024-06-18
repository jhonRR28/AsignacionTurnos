<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventana Principal</title>
    <link rel="stylesheet" href="stylesp.css">
    <link rel="shortcut icon" href="../img/disponibilidad.png">

</head>

<body>
    <div class="navbar">
        <div class="user-container">
            <button class="user-btn" onclick="window.location.href='index.php'">Solicitar Turno</button>
            <button class="user-btn" onclick="window.location.href='mostrar.php'">Mostrar Turno</button>
            <button class="user-btn" onclick="window.location.href='avanzar.php'">Iniciar Sesión</button>
        </div>
    </div>
    <div class="main-container">
        <h1>Bienvenido al Sistema de Turnos</h1><br>
        <p class="welcome-message">
            Estimado cliente, le damos la más cordial bienvenida a nuestro sistema de turnos en línea. 
            Nos complace tenerle con nosotros y estamos comprometidos en ofrecerle un servicio rápido, 
            eficiente y seguro.
        </p>
        <h2>Seleccione una de las siguientes opciones para continuar:</h2><br><br>
        <div class="icons-container">
            <a href="solicitar_turno.php?dato=1" class="icon-card">
                <h2>- Retiros -</h2><br>
                <img src="../img/retiro.jpg" alt="Retiros"><br>
            </a>
            <a href="solicitar_turno.php?dato=2" class="icon-card">
                <h2>- Consignaciones -</h2><br>
                <img src="../img/consignacion.jpg" alt="Consignaciones"><br>
            </a>
            <a href="solicitar_turno.php?dato=3" class="icon-card">
                <h2>- Atención al Cliente -</h2><br>
                <img src="../img/atencion.png" alt="Atención al Cliente"><br>
            </a>
            </div>
        </div>
    </div>
</body>

</html>
