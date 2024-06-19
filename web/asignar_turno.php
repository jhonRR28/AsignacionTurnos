<?php
require 'db.php';
echo "entro a asignar";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servicio = $_POST['servicio'];
    $cedula = $_POST['cedula'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
  
    $stmt = $conn->prepare("SELECT MAX(numero) AS max_numero FROM turnos WHERE servicio_id = ?");
    $stmt->execute([$servicio]);
    $result = $stmt->fetch();
    $nuevo_turno = $result['max_numero'] + 1;

    if (buscarRepetido($cedula, $conn) == 0) {
      $stmt = $conn->prepare("INSERT INTO usuarios (cedula, nombre, correo, telefono) VALUES (?, ?, ?, ?)");
      $stmt->execute([$cedula, $username, $email, $telefono]);
    }

    $_SESSION['codigo'] = $cedula;
    $_SESSION['username'] = $username;
    $_SESSION['rol'] = 'user';
    $_SESSION['turno'] = $nuevo_turno;
  
    $stmt = $conn->prepare("INSERT INTO turnos (servicio_id, usuario_cedula, numero) VALUES (?, ?, ?)");
    $stmt->execute([$servicio, $cedula, $nuevo_turno]);

    echo $nuevo_turno;
  
    echo "<script>window.location.href = 'mostrar.php?dato=" . $nuevo_turno . "';</script>";
  } else {
    echo "Error al llenar formulario";
  }

  function buscarRepetido($cedula, $conn) {
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE cedula = ?");
    $stmt->execute([$cedula]);

    if($stmt->rowCount() > 0) {
      return 1;
    }else {
      return 0;
    }
  }
?>
