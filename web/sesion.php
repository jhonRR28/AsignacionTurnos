<?php 
session_start();

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //obtencion de datos
    $codigo = $_POST['codigo'];
    $password = md5($_POST['password']);

    //buscar el usuario en la base de datos
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE cedula = ? AND password = ? AND rol = 'admin' LIMIT 1");
    $stmt->execute([$codigo, $password]);

    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch();
        $clave = $usuario['password'];
        $nombre = $usuario['nombre'];
        $_SESSION['codigo'] = $codigo;
        $_SESSION['username'] = $nombre;
        $_SESSION['rol'] = 'admin';
        header("location: avanzar.php");
        exit;
    } else {
        // header("location: login.php");
        echo $password;
    }
}