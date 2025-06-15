<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa de turismo</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>
<body>
<header> <!--Cabecera de página-->
       <nav class="navbar navbar-expand-lg" id="navPrincipal">
        <div class="container-fluid">
            <a class="navbar-brand" href="../www/index.php"><i class="fa-solid fa-plane-departure"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['usuario'])): ?>
                <!-- Si está logueado -->
                <li>
                    <a class="nav-link" href="index.php" id="linkLogin"> Paquetes turísticos</a>
                </li>
                <li>
                    <a class="nav-link" href="servicios.php" id="linkLogin"> Servicios adicionales</a>
                </li>
                <li>
                    <a class="nav-link" href="mostrarCarrito.php" id="linkLogin"><i class="fa-solid fa-cart-shopping"></i> Ver carrito 
                    (<?php 
                        echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']);
                    ?>)
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="usuario/cerrar.php" id="linkLogin"><i class="fa-solid fa-right-to-bracket"></i> Cerrar sesión (<?= htmlspecialchars($_SESSION['nombreUsuario']) ?>)</a>
                </li>
                <?php elseif (!isset($_SESSION['nombreAdmin'])): ?>
                <!-- Si NO hay usuario NI admin logueado -->
                <li>
                    <a class="nav-link iniciar-sesion" href="login.php" id="linkLogin">Iniciar sesión</a>
                </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['nombreAdmin'])): ?>
                <li>
                    <a class="nav-link" href="administrador/inicio.php" id="linkLogin"></i>Volver al editor</a>
                </li>
                <li>
                    <a class="nav-link" href="administrador/cerrar.php" id="linkLogin"><i class="fa-solid fa-right-to-bracket"></i> Cerrar sesión</a>
                </li>
                <?php endif; ?>
            </ul>
            </div>
        </div>
    </nav>
</header>