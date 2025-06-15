<?php
    include('../administrador/database/bd.php');
    include('carrito.php');
    include('../www/templates/header.php');
?>
<main>
<div class="container-fluid">
    <div class="row">
        <div class="col-md p-2">
            <h4>Carrito</h4>
            <?php if(!empty($_SESSION['CARRITO'])) { ?>
                <table id="tablaPaquetes">
                    <tbody>
                    <tr>
                        <th width="60%">Descripción</th>
                        <th width="15%" class="text-center">Precio</th>
                        <th width="5%" class="text-center">--</th>
                    </tr>
                    <?php $total = 0; ?>
                    <?php foreach ($_SESSION['CARRITO'] as $indice => $item) { ?>
                    <tr>
                        <td width="60%">
                            <?php
                            if (isset($item['NombServ'])) {
                                echo "Servicio: ".$item['NombServ']." (".$item['CalidServ'].") ";
                            } elseif (isset($item['NombPack'])) {
                                echo "Paquete: ".$item['NombPack']." (".$item['TipoPack'].") ";
                            }
                            ?>
                        </td>
                            <td width="15%" class="text-center">
                                $<?php
                                if (isset($item['PrecioServ'])) {
                                    echo number_format($item['PrecioServ'], 2);
                                } elseif (isset($item['PrecioPack'])) {
                                    echo number_format($item['PrecioPack'], 2);
                                }
                                ?>
                            </td>
                            <td width="5%" class="text-center">
                                <form action="" method="POST">
                                    <?php if (isset($item['IDServ'])): ?>
                                        <input type="hidden" name="txtIDServ" value="<?php echo openssl_encrypt($item['IDServ'],COD,KEY); ?>">
                                    <?php elseif (isset($item['IDPack'])): ?>
                                        <input type="hidden" name="txtIDPack" value="<?php echo openssl_encrypt($item['IDPack'],COD,KEY); ?>">
                                    <?php endif; ?>
                                    <button class="btn btn-danger" type="submit" name="accion" value="Eliminar">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                        if (isset($item['PrecioServ'])) {
                            $total += $item['PrecioServ'];
                        } elseif (isset($item['PrecioPack'])) {
                            $total += $item['PrecioPack'];
                        }
                        ?>
                    <?php } ?>
                    <tr>
                        <td colspan="1" align="right"><h4>Total</h4></td>
                        <td class="text-center"><h4>$<?php echo number_format($total, 2); ?></h4></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <form action="pagar.php" method="POST">
                                <div class="alert">
                                    <div class="form-group">
                                        <label for="" style="color: black;">Correo de contacto:</label>
                                        <input type="email" name="correoCont" id="correoCont" class="form-control" placeholder="Escribe tu correo aquí..." required>
                                    </div>
                                    <small id="emailHelp" class="form-text text-muted">
                                        Los productos se enviarán a este correo.
                                    </small>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-success btn-lg btn-block" type="submit" value="proceder" name="accion">Proceder a pagar</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            <?php }else{ ?>
                <div class="alert alert-success">
                    No hay encargos.
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</main>
<?php
    include('../www/templates/footer.php')
?>