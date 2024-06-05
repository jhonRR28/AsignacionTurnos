<?php
require 'db.php';
$turno_actual = $_GET['dato'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnos Actuales</title>
    <link rel="stylesheet" href="stylesm.css">
</head>

<body>
    <div class="navbar">
        <div class="user-container">
            <button class="user-btn">Administrador</button>
        </div>
    </div>
    <div class="container">
        <h1>Turnos Actuales</h1>
        <div class="turnos-lista">
            <h2>Turno Actual</h2>
            <div class="turno-actual">
                <p>Turno actual: <span id="turnoActual"><?php echo $turno_actual ?></span></p>
            </div>
            <h2>Turnos por Cajero</h2>
            <div class="turnos-cajero">
                <?php
                $stmt = $conn->query("SELECT * FROM servicios");
                $cajas = $stmt->fetchAll(); 
                foreach ($cajas as $caja):
                    $id_caja = $caja['id'];
                    $nombre_caja = $caja['nombre'];
                    $stmt = $conn->prepare("SELECT MAX(numero) AS max_numero FROM turnos WHERE servicio_id = ? ORDER BY id ASC LIMIT 1");
                    $stmt->execute([$id_caja]);
                    $turno = $stmt->fetch();
                ?>
                <div class="cajero-turnos" id="cajero1Turnos">
                <h3><?php echo $nombre_caja?></h3>
                <p id="cajero1Numero"><?php echo $turno['max_numero']?></p>
                <ul id="cajero1Lista"></ul>
                </div>
                <?php 
                endforeach; ?>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="turnos.js"></script>
</body>

</html>