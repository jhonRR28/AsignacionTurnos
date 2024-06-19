<?php
require 'db.php';

session_start();

try {
    echo '<thead>
        <tr>
            <th>Cajero</th>
            <th>Empleado</th>
            <th>Turno Actual</th>
        </tr>
    </thead>
    <tbody>'; 
    $stmt = $conn->query("SELECT * FROM cajeros");
    $cajeros = $stmt->fetchAll(); 
    foreach ($cajeros as $caja):
        $id_caja = $caja['id'];
        $nombre_caja = htmlspecialchars($caja['nombre']);
        $nombre_atiende = htmlspecialchars($caja['empleado']);
        $stmt = $conn->prepare("SELECT * FROM turnos WHERE cajero_id = ? AND estado = 'atendiendo' ORDER BY id ASC LIMIT 1");
        $stmt->execute([$id_caja]);
        if($stmt->rowCount() > 0) {
            $turno = $stmt->fetch();
            $turno_numero = htmlspecialchars($turno['numero']);
            echo '<tr>
                    <td>' . $nombre_caja . '</td>
                    <td>' . $nombre_atiende . '</td>
                    <td>' . $turno_numero . '</td>
                </tr>';
        }else {
        echo '<tr>
                <td>' . $nombre_caja . '</td>
                <td>No asignado</td>
                <td>En espera</td>
            </tr>';
        }
    endforeach;
    echo '</tbody>';
} catch (PDOException $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
}