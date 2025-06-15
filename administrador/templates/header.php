<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa de turismo</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>
<body>
<header> <!--Cabecera de página-->
    <nav class="navbar navbar-expand-lg" id="navPrincipal">
        <div class="container-fluid">
            <a class="navbar-brand" href="inicio.php"><i class="fa-solid fa-user"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="paquetes.php">Gestor de paquetes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="servicios.php">Gestor de servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../www/index.php"><i class="fa-solid fa-eye"></i> Ver sitio web</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['nombreAdmin'])): ?>
                <li>
                    <a class="nav-link" href="cerrar.php" id="linkLogin"><i class="fa-solid fa-right-to-bracket"></i> Cerrar sesión</a>
                </li>
                <?php endif; ?>
            </ul>
            </div>
        </div>
    </nav>
</header>