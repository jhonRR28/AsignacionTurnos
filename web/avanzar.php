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
    <title>Administrador de Turnos</title>
    <link rel="stylesheet" href="stylesa.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    <div class="cajero-turnos" id="cajero<?php echo $id_caja ?>">
                        <h3><?php echo $nombre_caja ?></h3>
                        <h3><img src="icono1.png" alt="Cajero 1" class="cajero-icon"> Cajero 1</h3>
                        <p><?php echo $nombre_atiende ?></p>
                        <p id="cajero<?php echo $id_caja ?>Numero"><?php echo $turno['numero'] ?></p>
                        <button onclick="avanzarTurno('<?php echo $id_caja ?>')">Avanzar Turno</button>
                    </div>
                    <?php
                }else {
                    ?>
                    <div class="cajero-turnos" id="cajero<?php echo $id_caja ?>">
                        <h3><?php echo $nombre_caja ?></h3>
                        <h3><img src="icono1.png" alt="Cajero 1" class="cajero-icon"> Cajero 1</h3>
                        <p><?php echo $nombre_atiende ?></p>
                        <p id="cajero<?php echo $id_caja ?>Numero">No asignado</p>
                        <button onclick="avanzarTurno('<?php echo $id_caja ?>')">Avanzar Turno</button>
                    </div>
                    <?php
                }
            endforeach;
            ?>
        </div>
    </div>
</body>
<script>
    function avanzarTurno(idCajero) {
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
