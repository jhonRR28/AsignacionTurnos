<?php
require 'db.php';

session_start();

if (isset($_SESSION['turno']) && $_SESSION['turno'] != "") {
    $mi_turno = $_SESSION['turno'];
}else {
    $mi_turno = "Ningun turno asignado";
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar de Turnos</title>
    <link rel="stylesheet" href="stylesa.css">
    <style>
        .alert {
            padding: 20px;
            background-color: #006db2;
            color: white;
            margin-bottom: 15px;
        }
    </style>
    <link rel="shortcut icon" href="../img/disponibilidad.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function actualizarTurnos() {
            $.ajax({
                url: 'obtener_turnos.php',
                type: 'GET',
                success: function(data) {
                    $('#turnos').html(data);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        $(document).ready(function() {
            // Cargar turnos inicialmente
            actualizarTurnos();

            // Escuchar eventos de almacenamiento local
            window.addEventListener('storage', function(event) {
                if (event.key === 'turno_avanzado') {
                    actualizarTurnos();

                    var data = JSON.parse(event.newValue);
                    var nuevo_turno = data.nuevo_turno;

                    // Mostrar alerta con el siguiente turno
                    $('#alerta_turno').html(
                        `<div class="alert">
                            <strong>Próximo turno:</strong> ${nuevo_turno}
                        </div>`
                    );
                }
            });
        });
    </script>
</head>

<body>
    <div class="navbar">
        <div class="user-container">
            <button class="user-btn" onclick="window.location.href='index.php'">Solicitar Turno</button>
            <button class="user-btn" onclick="window.location.href='mostrar.php'">Mostrar Turno</button>
            <button class="user-btn" onclick="window.location.href='avanzar.php'">Iniciar Sesión</button>
        </div>
    </div>
    <div class="container">
        <div id="alerta_turno"></div>
        <div class="left-column">
            <h1>Mostrar Turnos</h1>
            <table id="turnos">
            </table><br>
            <i class="fa fa-list fa-5x icon"></i><br>
        </div>
        <div class="right-column">
            <h1>Mi Turno</h1>
            <p id="miTurno"><?php echo $mi_turno?> </p>
        </div>
    </div>
</body>

</html>
