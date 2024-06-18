<?php
require 'db.php';

if (isset($_GET['dato'])) {
    $mi_turno = $_GET['dato'];
} else {
    $mi_turno = "";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar de Turnos</title>
    <link rel="stylesheet" href="stylesa.css">
    <link rel="shortcut icon" href="../img/disponibilidad.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="admin.js" defer></script>
</head>

<body>
    <div class="navbar">
        <div class="user-container">
            <button class="user-btn" onclick="window.location.href='index.php'">Solicitar Turno</button>
            <button class="user-btn" onclick="window.location.href='mostrar.php'">Mostrar Turno</button>
            <button class="user-btn" onclick="window.location.href='login.html'">Iniciar Sesión</button>
        </div>
    </div>
    <div class="container">
        <div class="left-column">
            <h1>Mostrar Turnos</h1>
            <table>
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Cajero</th>
                        <th>Turno Actual</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $stmt = $conn->query("SELECT * FROM cajeros");
                $cajeros = $stmt->fetchAll(); 
                foreach ($cajeros as $caja):
                    $id_caja = $cajeros['id'];
                    $nombre_caja = $cajeros['nombre'];
                    $nombre_atiende = $cajeros['empleado'];
                    $stmt = $conn->prepare("SELECT * FROM turnos WHERE cajero_id = ? AND estado = 'atendiendo' ORDER BY id ASC LIMIT 1");
                    $stmt->execute([$id_caja]);
                    if($stmt->rowCount() > 0) {
                        $turno = $stmt->fetch();
                        ?>
                        <tr>
                        <td><?php echo $nombre_caja;?></td>
                        <td><?php echo $nombre_atiende;?></td>
                        <td id="cajero1Numero"><?php echo $turno['numero'];?></td>
                        </tr>
                        <?php
                    }else {
                        ?>
                        <tr>
                        <td><?php echo $nombre_caja;?></td>
                        <td>No asignado</td>
                        <td id="cajero1Numero">En espera</td>
                        </tr>
                        <?php
                    }
                endforeach; ?>
                <!--<tr>
                        <td>Cajero 1</td>
                        <td id="cajero1Numero">A: 1</td>
                    </tr>
                    <tr>
                        <td>Cajero 2</td>
                        <td id="cajero2Numero">B: 1</td>
                    </tr>
                    <tr>
                        <td>Cajero 3</td>
                        <td id="cajero3Numero">C: 1</td>
                    </tr> -->
                </tbody>
            </table><br>
            <img src="../img/ttt.jpg" alt="turnos"><br>
        </div>
        <div class="right-column">
            <h1>Mi Turno</h1>
            <p id="miTurno"><?php echo $mi_turno?> </p>
        </div>
    </div>
</body>

</html>
