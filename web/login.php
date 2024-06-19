<?php

session_start();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="styleslogin.css">
    <link rel="shortcut icon" href="../img/disponibilidad.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="navbar">
        <div class="user-container">
            <button class="user-btn" onclick="window.location.href='index.php'">Solicitar Turno</button>
            <button class="user-btn" onclick="window.location.href='mostrar.php'">Mostrar Turno</button>
            <button class="user-btn" onclick="window.location.href='login.php'">Iniciar Sesión</button>
        </div>
    </div>
    <div class="container">
        <h1>Iniciar Sesión</h1>
        <div class="main-content">
            <div class="center-column">
                <i class="fa fa-user-circle fa-5x icon"></i>
                <form id="loginForm" action="sesion.php" method="post">
                    <div class="form-group">
                        <label for="loginCode">Código</label>
                        <input type="text" id="codigo" name="codigo" required>
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Contraseña</label>
                        <input type="password" id="password" name="password" required>
                    </div><br>
                    <button class="bien" type="submit">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </div>
</body>