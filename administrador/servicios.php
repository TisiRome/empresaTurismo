<?php include('templates/header.php'); ?>
<?php 
include('database/bd.php');

$txtIDServ = (isset($_POST['txtIDServ'])) ? $_POST['txtIDServ'] : "";
$txtNombreServ = (isset($_POST['txtNombreServ'])) ? $_POST['txtNombreServ'] : "";
$txtCalidadServ = (isset($_POST['txtCalidadServ'])) ? $_POST['txtCalidadServ'] : "";
$txtPrecioServ = (isset($_POST['txtPrecioServ'])) ? $_POST['txtPrecioServ'] : "";
$accionBtn = (isset($_POST['accion'])) ? $_POST['accion'] : "";

switch ($accionBtn) {
    case "Agregar":
        $tiposSeleccionados = $_POST['txtCalidadServ'] ?? [];
        $txtCalidadServ = $_POST['txtCalidadServ'] ?? '';
        $sentenciaSQL = $conexion->prepare("INSERT INTO servicios (nombreServ, calidadServ, precioServ) VALUES (:nombreServ, :calidadServ, :precioServ)");
        $sentenciaSQL->bindParam(':nombreServ', $txtNombreServ);
        $sentenciaSQL->bindParam(':calidadServ', $txtCalidadServ);
        $sentenciaSQL->bindParam(':precioServ', $txtPrecioServ);
        $sentenciaSQL->execute();
        header('Location:servicios.php');
        exit();
    case "Modificar":
        $tiposSeleccionados = $_POST['txtCalidadServ'] ?? [];
        $txtCalidadServ = $_POST['txtCalidadServ'] ?? '';
        $sentenciaSQL = $conexion->prepare("UPDATE servicios SET nombreServ= :nombreServ, calidadServ= :calidadServ, precioServ= :precioServ WHERE idServ= :idServ");
        $sentenciaSQL->bindParam(':nombreServ', $txtNombreServ);
        $sentenciaSQL->bindParam(':calidadServ', $txtCalidadServ);
        $sentenciaSQL->bindParam(':precioServ', $txtPrecioServ);
        $sentenciaSQL->bindParam(':idServ', $txtIDServ);
        $sentenciaSQL->execute();
        header('Location:servicios.php');
        exit();
    case "Cancelar";
        header('Location:servicios.php');
        exit();
    case "Seleccionar";
        $sentenciaSQL = $conexion->prepare("SELECT * FROM servicios WHERE idServ= :idServ");
        $sentenciaSQL->bindParam(':idServ', $txtIDServ);
        $sentenciaSQL->execute();
        $servicio = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtNombreServ = $servicio['nombreServ'];
        $txtCalidadServ = $servicio['calidadServ'];
        $txtPrecioServ = $servicio['precioServ'];
        break;
    case "Borrar";
        $sentenciaSQL = $conexion->prepare("DELETE FROM servicios WHERE idServ= :idServ");
        $sentenciaSQL->bindParam(':idServ', $txtIDServ);
        $sentenciaSQL->execute();
        header('Location:servicios.php');
        exit();
}
$sentenciaSQL = $conexion->prepare("SELECT * FROM servicios");
$sentenciaSQL->execute();
$listaServicios = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<main id="contenedorPack">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <form method="POST" id="formularioIngresoPack">
                <h4><b>Ingreso de servicios adicionales</b></h4>
                <hr>
                <div class="form-group">
                    <input type="text" name="txtIDServ" id="txtIDServ" readonly class="form-control" placeholder="ID del servicio" value="<?php echo $txtIDServ; ?>">
                </div>
                <div class="form-group">
                    <input type="text" name="txtNombreServ" id="txtNombreServ" class="form-control" placeholder="Descripción del servicio" value="<?php echo $txtNombreServ; ?>">
                </div>
                <div class="form-group">
                    <?php
                    $tipos = ["Económico", "Estándar", "Premium"];
                    $tiposSeleccionados = explode(",", $txtCalidadServ);
                    foreach ($tipos as $index => $tipo) {
                        $checked = in_array($tipo, $tiposSeleccionados) ? "checked" : "";
                        $id = "tipo_" . $index;
                        echo "<div class='tiposServ'><label for='$id'>";
                        echo "<input type='radio' name='txtCalidadServ' value='$tipo' $checked>";
                        echo $tipo;
                        echo "</label></div>";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <input type="text" name="txtPrecioServ" id="txtPrecioServ" class="form-control" placeholder="Costo del servicio" value="<?php echo $txtPrecioServ; ?>">
                </div>
                <br>
                <div class="text-center" role="group">
                    <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" value="Modificar" class="btn btn-info">Modificar</button>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn-warning">Cancelar</button>
                </div>
            </form>
        </div>
        <div class="col-md-8">
            <table id="tablaPaquetes">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Servicio</th>
                    <th>Calidad</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($listaServicios as $servicio){ ?>
                    <tr>
                    <td><?php echo $servicio["idServ"]; ?></td>
                    <td><?php echo $servicio["nombreServ"]; ?></td>
                    <td><?php echo $servicio["calidadServ"]; ?></td>
                    <td><?php echo $servicio["precioServ"]; ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="txtIDServ" value="<?php echo $servicio["idServ"]; ?>">
                            <button type="submit" name="accion" value="Seleccionar" class="btn btn-dark">Seleccionar</button>
                            <button type="submit" name="accion" value="Borrar" class="btn btn-danger">Borrar</button>
                        </form>
                    </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</main>
<?php include('templates/footer.php'); ?>
