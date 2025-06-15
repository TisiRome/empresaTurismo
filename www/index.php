<?php
include('../administrador/database/bd.php');
include('carrito.php');

$sentencia = $conexion->prepare("SELECT idPack, nombrePack, tipoPack, precioBase FROM paquetes");
$sentencia->execute();
$listaPaquetes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include('templates/header.php');?>
<main id="contenedorForm"> <!--Formulario-->
    <div class="container-fluid">
        <div class="row">
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
                      <input type="text" name="txtNombrePack" id="txtNombrePack" class="form-control" placeholder="Nombre del paquete" readonly>
                  </div>
                  <div class="form-group">
                      <input type="text" name="txtTipoPack" id="txtTipoPack" class="form-control" placeholder="Tipo de paquete" readonly>
                  </div>
                  <div class="form-group">
                      <input type="text" name="txtPrecioPack" id="txtPrecioPack" class="form-control" placeholder="Precio" readonly>
                  </div>
                  <div class="text-center" role="group">
                      <button type="submit" name="accion" value="Agregar" class="btn btn-success">Reservar</button>
                      <a class="btn btn-link" href="servicios.php">¿Agregar servicios adicionales?</a>
                  </div>
              </form>
            </div>
        </div>
    </div>
</main>
<script>
document.getElementById('txtIDPack').addEventListener('change', function () {
    const selected = this.options[this.selectedIndex];
    document.getElementById('txtNombrePack').value = selected.getAttribute('data-nombre');
    document.getElementById('txtTipoPack').value = selected.getAttribute('data-tipo');
    document.getElementById('txtPrecioPack').value = selected.getAttribute('data-precio');
});
</script>
<?php include('templates/footer.php');?>