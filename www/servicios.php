<?php
    include('../administrador/database/bd.php');
    include('carrito.php');
    include('../www/templates/header.php');
?>
<?php
    $sentencia=$conexion->prepare("SELECT * FROM servicios");
    $sentencia->execute();
    $listaServicios=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<main id="contenedorServ">
    <div class="container-fluid">
        <?php if($mensaje!=""){?>
        <div class="alert alert-success">
            <?php echo $mensaje; ?>
            <a href="mostrarCarrito.php" class="badge badge-success">Ver carrito</a>
        </div>
        <?php }?>
        <div class="row">
            <?php foreach($listaServicios as $servicio){ ?>
            <div class="col-md-3 p-2">
                <div class="card cardServ">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo $servicio['nombreServ']; ?></h5>
                        <p class="card-text"><?php echo $servicio['calidadServ']; ?></p>
                        <p class="card-text">$<?php echo $servicio['precioServ']; ?></p>
                        <form method="POST" action="" class="mt-auto">
                            <input type="hidden" name="txtIDServ" id="txtIDServ" value="<?php echo openssl_encrypt( $servicio['idServ'],COD,KEY) ;?>">
                            <input type="hidden" name="txtNombreServ" id="txtNombreServ" value="<?php echo openssl_encrypt($servicio['nombreServ'],COD,KEY) ;?>">
                            <input type="hidden" name="txtCalidadServ" id="txtCalidadServ" value="<?php echo openssl_encrypt($servicio['calidadServ'],COD,KEY) ;?>">
                            <input type="hidden" name="txtPrecioServ" id="txtPrecioServ" value="<?php echo openssl_encrypt($servicio['precioServ'],COD,KEY) ;?>">
                            <div>
                                <button type="submit" class="btn btn-success" name="accion" value="Agregar">Agregar al carrito</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</main>
<?php include('../www/templates/footer.php'); ?>
