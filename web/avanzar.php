<?php
require 'db.php';

session_start(); 

if (!isset($_SESSION['rol'])) {
    header("location: login.php");
    exit;
}

if ($_SESSION['rol'] != 'admin') {
    header("location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnos Actuales y Administración</title>
    <link rel="stylesheet" href="stylesm.css">
    <link rel="shortcut icon" href="../img/disponibilidad.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<div class="navbar">
        <div class="user-container">
            <button class="user-btn" onclick="window.location.href='index.php'">Solicitar Turno</button>
            <button class="user-btn" onclick="window.location.href='mostrar.php'">Mostrar Turno</button>
            <button class="user-btn" onclick="window.location.href='#'">Iniciar Sesión</button>
        </div>
    </div>
    <div class="container">
        <h1>Turnos Actuales y Administración</h1>
        <i class="fa fa-user-secret fa-5x icon"></i>
        <div class="main-content">
            <div class="left-column">
                <h2>Turnos por Cajero</h2>
                <table class="turnos-table">
                    <tr>
                        <th>Cajero</th>
                        <th>Empleado</th>
                        <th>Turno</th>
                    </tr>
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM cajeros");
                    $stmt->execute();
                    $cajeros = $stmt->fetchAll();
                    foreach ($cajeros as $caja):
                    $id_caja = $caja['id'];
                    $nombre_caja = $caja['nombre'];
                    $nombre_atiende = $caja['empleado'];
                    $stmt = $conn->prepare("SELECT * FROM turnos WHERE cajero_id = ? AND estado = 'atendiendo' ORDER BY id ASC LIMIT 1");
                $stmt->execute([$id_caja]);
                if($stmt->rowCount() > 0) {
                    $turno = $stmt->fetch();
                    ?>
                    <tr>
                        <td><?php echo $nombre_caja ?></td>
                        <td><?php echo $nombre_atiende ?></td>
                        <td><?php echo $turno['numero']; ?></td>
                    </tr>
                    <?php }else {?>
                    <tr>
                        <td><?php echo $nombre_caja ?></td>
                        <td><?php echo $nombre_atiende ?></td>
                        <td>En espera</td>
                    </tr>
                    <?php }
                endforeach;?>
                </table>
            </div>
            <div class="right-column">
                <h2>Administrar Turnos</h2>
                <?php
                    $stmt = $conn->prepare("SELECT * FROM cajeros");
                    $stmt->execute();
                    $cajeros2 = $stmt->fetchAll();
                    foreach ($cajeros2 as $cajero):
                    $id_cajero = $cajero['id'];
                    $nombre_cajero = $cajero['nombre'];
                    ?>
                        <div class="turno-admin">
                            <h3><?php echo $nombre_cajero ?></h3>
                            <button onclick="avanzarTurno('<?php echo $id_cajero ?>')">Avanzar Turno</button>
                        </div>
                    <?php 
                    endforeach;
                ?>
            </div>
        </div>
    </div>
</body>
<script>
    function avanzarTurno(idCajero) {
        console.log("entro");
        console.log(idCajero);
        $.ajax({
            url: 'actualizar_turno.php',
            type: 'POST',
            data: {
                cajero_id: idCajero
            },
            success: function(response) {
                var data = JSON.parse(response);
                alert(data.message);
                // Disparar el evento de almacenamiento local para notificar la actualización
                localStorage.setItem('turno_avanzado', JSON.stringify({
                    timestamp: new Date().getTime(),
                    nuevo_turno: data.nuevo_turno
                }));
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
        }
</script>
</html>
