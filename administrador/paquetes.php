<?php include('templates/header.php'); ?>
<?php
include('database/bd.php');

$txtIDPack = (isset($_POST['txtIDPack'])) ? $_POST['txtIDPack'] : "";
$txtNombrePack = (isset($_POST['txtNombrePack'])) ? $_POST['txtNombrePack'] : "";
$txtTipoPack = (isset($_POST['txtTipoPack'])) ? $_POST['txtTipoPack'] : "";
$txtPrecioPack = (isset($_POST['txtPrecioPack'])) ? $_POST['txtPrecioPack'] : "";
$accionBtn = (isset($_POST['accion'])) ? $_POST['accion'] : "";

switch ($accionBtn) {
    case "Agregar":
        $tiposSeleccionados = $_POST['txtTipoPack'] ?? [];
        $txtTipoPack = $_POST['txtTipoPack'] ?? '';
        $sentenciaSQL = $conexion->prepare("INSERT INTO paquetes (nombrePack, tipoPack, precioBase) VALUES (:nombrePack, :tipoPack, :precioBase)");
        $sentenciaSQL->bindParam(':nombrePack', $txtNombrePack);
        $sentenciaSQL->bindParam(':tipoPack', $txtTipoPack);
        $sentenciaSQL->bindParam(':precioBase', $txtPrecioPack);
        $sentenciaSQL->execute();
        header('Location:paquetes.php');
        exit();
    case "Modificar":
        $tiposSeleccionados = $_POST['txtTipoPack'] ?? [];
        $txtTipoPack = $_POST['txtTipoPack'] ?? '';
        $sentenciaSQL = $conexion->prepare("UPDATE paquetes SET nombrePack= :nombrePack, tipoPack= :tipoPack, precioBase= :precioBase WHERE idPack= :idPack");
        $sentenciaSQL->bindParam(':nombrePack', $txtNombrePack);
        $sentenciaSQL->bindParam(':tipoPack', $txtTipoPack);
        $sentenciaSQL->bindParam(':precioBase', $txtPrecioPack);
        $sentenciaSQL->bindParam(':idPack', $txtIDPack);
        $sentenciaSQL->execute();
        header('Location:paquetes.php');
        exit();
    case "Cancelar";
        header('Location:paquetes.php');
        exit();
    case "Seleccionar";
        $sentenciaSQL = $conexion->prepare("SELECT * FROM paquetes WHERE idPack= :idPack");
        $sentenciaSQL->bindParam(':idPack', $txtIDPack);
        $sentenciaSQL->execute();
        $paquete = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtNombrePack = $paquete['nombrePack'];
        $txtTipoPack = $paquete['tipoPack'];
        $txtPrecioPack = $paquete['precioBase'];
        break;
    case "Borrar";
        $sentenciaSQL = $conexion->prepare("DELETE FROM paquetes WHERE idPack= :idPack");
        $sentenciaSQL->bindParam(':idPack', $txtIDPack);
        $sentenciaSQL->execute();
        header('Location:paquetes.php');
        exit();
}
$sentenciaSQL = $conexion->prepare("SELECT * FROM paquetes");
$sentenciaSQL->execute();
$listaPaquetes = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<main id="contenedorPack">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <form method="POST" id="formularioIngresoPack">
                <h4><b>Ingreso de paquetes turísticos</b></h4>
                <hr>
                <div class="form-group">
                    <input type="text" name="txtIDPack" id="txtIDPack" readonly class="form-control" placeholder="ID del paquete" value="<?php echo $txtIDPack; ?>">
                </div>
                <div class="form-group">
                    <input type="text" name="txtNombrePack" id="txtNombrePack" class="form-control" placeholder="Nombre del paquete" value="<?php echo $txtNombrePack; ?>">
                </div>
                <div class="form-group">
                    <?php
                    $tipos = ["Individual", "Familiar", "Grupal", "Corporativo", "Romántico"];
                    $tiposSeleccionados = explode(",", $txtTipoPack);
                    foreach ($tipos as $index => $tipo) {
                        $checked = in_array($tipo, $tiposSeleccionados) ? "checked" : "";
                        $id = "tipo_" . $index;
                        echo "<div class='tiposPack'><label for='$id'>";
                        echo "<input type='radio' name='txtTipoPack' value='$tipo' $checked>";
                        echo $tipo;
                        echo "</label></div>";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <input type="text" name="txtPrecioPack" id="txtPrecioPack" class="form-control" placeholder="Costo del paquete" value="<?php echo $txtPrecioPack; ?>">
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
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($listaPaquetes as $paquete){ ?>
                    <tr>
                    <td><?php echo $paquete["idPack"]; ?></td>
                    <td><?php echo $paquete["nombrePack"]; ?></td>
                    <td><?php echo $paquete["tipoPack"]; ?></td>
                    <td><?php echo $paquete["precioBase"]; ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="txtIDPack" value="<?php echo $paquete["idPack"]; ?>">
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
