<?php
include('administrador/database/bd.php');
include('carrito.php');

$sentencia = $conexion->prepare("SELECT idPack, nombrePack, tipoPack, precioBase FROM paquetes");
$sentencia->execute();
$listaPaquetes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include('templates/header.php');?>

<main id="contenedorCarrusel">
    <div class="container-fluid">
        <div class="row">
            <div class="col p-0">
                <div id="carruselPrincipal" class="carousel slide">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="img/FTE-4.avif" class="carruselImagen" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>¡Bienvenido a VolAR!</h5>
                        <p>Viví experiencias inolvidables, descubrí nuevos destinos y conectá con lo mejor del turismo. En VolAR te acompañamos desde el primer paso para que tu viaje sea único.</p>
                    </div>
                    </div>
                    <div class="carousel-item">
                    <img src="img/MDZ-1.avif" class="carruselImagen" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Paquetes diseñados para vos</h5>
                        <p>Explorá nuestros paquetes turísticos completos: alojamiento, traslados, excursiones y mucho más. Pensados para cada tipo de viajero, al mejor precio y con atención personalizada.</p>
                        <a href="#paquetes" class="btn btn-outline-light btn-md" >Explora nuestro catálogo de paquetes</a>
                    </div>
                    </div>
                    <div class="carousel-item">
                    <img src="img/RIO-1.avif" class="carruselImagen" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Servicios que complementan tu viaje</h5>
                        <p>Desde traslados privados hasta actividades exclusivas, en VolAR te ofrecemos servicios adicionales para que tu viaje sea cómodo, seguro y lleno de momentos especiales.</p>
                        <a href="servicios.php" class="btn btn-outline-light btn-md">Conoce nuestros servicios disponibles</a>
                    </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carruselPrincipal" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carruselPrincipal" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
                </div>
            </div>
        </div>
    </div>
</main>
<article id="contenedorForm" class="mt-4">
    <div class="container-fluid">
        <div id="paquetes" class="row">
            <div class="col-md d-flex justify-content-center">
                <form method="POST" id="formularioIngresoPack">
                  <h4><b>Reserva de paquetes turísticos</b></h4>
                  <hr>
                  <div class="form-group">
                    <select name="txtIDPack" id="txtIDPack" class="form-control" required>
                        <option value="" disabled selected>Seleccione un paquete</option>
                        <?php foreach ($listaPaquetes as $paquete): ?>
                            <option value="<?php echo openssl_encrypt( $paquete['idPack'],COD,KEY) ;?>"
                              data-nombre="<?php echo openssl_encrypt( $paquete['nombrePack'],COD,KEY) ;?>"
                              data-tipo="<?php echo openssl_encrypt( $paquete['tipoPack'],COD,KEY) ;?>"
                              data-precio="<?php echo openssl_encrypt( $paquete['precioBase'],COD,KEY) ;?>">
                                <?php echo $paquete['nombrePack']." ".$paquete['tipoPack']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                      <input hidden type="text" name="txtNombrePack" id="txtNombrePack" class="form-control" placeholder="Nombre del paquete" readonly>
                  </div>
                  <div class="form-group">
                      <input hidden type="text" name="txtTipoPack" id="txtTipoPack" class="form-control" placeholder="Tipo de paquete" readonly>
                  </div>
                  <div class="form-group">
                      <input hidden type="text" name="txtPrecioPack" id="txtPrecioPack" class="form-control" placeholder="Precio" readonly>
                  </div>
                  <div class="text-center" role="group">
                      <button type="submit" name="accion" value="Agregar" class="btn btn-success">Reservar</button>
                      <a class="btn btn-link" href="servicios.php">¿Agregar servicios adicionales?</a>
                  </div>
              </form>
            </div>
        <h1 class="display-6 text-center m-4">Catálogo de paquetes turísticos</h1>
        <div class="row">
            <?php foreach($listaPaquetes as $paquete){ ?>
            <div class="col-md-3 p-2">
                <div class="card cardPack">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo $paquete['nombrePack']; ?></h5>
                        <p class="card-text text-center"><?php echo $paquete['tipoPack']; ?></p>
                        <h4 class="text-center">$<?php echo $paquete['precioBase']; ?></h4>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</article>
<script>
document.getElementById('txtIDPack').addEventListener('change', function () {
    const selected = this.options[this.selectedIndex];
    document.getElementById('txtNombrePack').value = selected.getAttribute('data-nombre');
    document.getElementById('txtTipoPack').value = selected.getAttribute('data-tipo');
    document.getElementById('txtPrecioPack').value = selected.getAttribute('data-precio');
});
</script>
<?php include('templates/footer.php');?>