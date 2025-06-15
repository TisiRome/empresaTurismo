<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $contrasenia = $_POST["contrasenia"];
    $contraseniaCifrada = password_hash($contrasenia, PASSWORD_DEFAULT);
    
    if (strtolower($nombre) === 'administrador') {
        $mensajeErrorCorreo = "Este nombre de usuario está reservado. Elija otro.";
    } else {
        try {
            include('administrador/database/bd.php');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO usuario (nombreUser, emailUser, passUser) 
                    VALUES (:nombre, :correo, :contrasenia)";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':contrasenia', $contraseniaCifrada);
            $stmt->execute();

            header("Location: login.php");
            exit();

        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $mensajeErrorCorreo = "Correo electrónico en uso. Intente con otro.";
            } else {
                $mensaje = "Ocurrió un error: " . $e->getMessage();
            }
        }
    }
}
?>
<?php include('templates/header.php');?>
<main>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md p-0">
        <article id="form">
        <form  id="formularioLogin" method="POST">
          <h4><b>Registro de Usuario</b></h4>
          <?php if (!empty($mensajeErrorCorreo)): ?>
            <div id="mensajeErrorCorreo">
              <?= $mensajeErrorCorreo ?>
            </div>
          <?php endif; ?>
          <input type="text" id="nombre" name="nombre" placeholder="Nombre de usuario" required>
          <input type="email" id="correo" name="correo" placeholder="Correo electrónico" required>
          <input type="password" id="contraseña" name="contrasenia" placeholder="Contraseña" required>

          <div class="text-center">
          <button class="btnLogin" type="submit">Registrarse</button>
          <a class="btnLogin" href="login.php">¿Ya tienes cuenta? Inicia sesión</a>
          </div>
        </form>
        </article>
      </div>
    </div>
  </div>
</main>
<?php include('templates/footer.php');?>