<?php
session_start();

if (!isset($_SESSION['nombreAdmin']) || $_SESSION['nombreAdmin'] !== "OK") {
    header("Location: login.php");
    exit();
}
?>
<?php include('templates/header.php'); ?>
<main>
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col-md-6">
                <div id="splitCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner rounded shadow-sm">
                    <div class="carousel-item active">
                        <img src="../img/USH-6.avif" class="d-block w-100" alt="Slide 1">
                    </div>
                    <div class="carousel-item">
                        <img src="../img/PUJ-5.avif" class="d-block w-100" alt="Slide 2">
                    </div>
                    <div class="carousel-item">
                        <img src="../img/IST-2.avif" class="d-block w-100" alt="Slide 3">
                    </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#splitCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#splitCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
            <div id="bienvenidoContent" class="col-md-6">
                <h4 id="h4Bienvenido" class="display-4">Bienvenido, <?= htmlspecialchars($_SESSION['nombreUsuario']) ?></h4>
                <p class="text-center">Este es el panel de administrador, desde aquí puedes gestionar los paquetes turísticos y servicios adicionales.</p>
                <ul>
                    <li>Ve a <a href="paquetes.php">Gestor de Paquetes</a> para editar los paquetes turísticos disponibles.</li>
                    <li>Ve a <a href="servicios.php">Gestor de Servicios</a> para editar los servicios adicionales disponibles.</li>
                </ul>
            </div>
        </div>
    </div>
</main>
<?php include('templates/footer.php'); ?>
