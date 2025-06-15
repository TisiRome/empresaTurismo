<?php
session_start();
include('templates/header.php');
try {
    $conexion = new PDO("mysql:host=localhost;dbname=agenciaturismo", "root", "");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $correo = $_POST['correo'];
      $contrasenia = $_POST['contrasenia'];
      if ($correo === "Administrador" && $contrasenia === "turismo") {
          $_SESSION['nombreAdmin'] = "OK";
          $_SESSION['nombreUsuario'] = "Administrador";
          header("Location: ../administrador/inicio.php");
          exit();
      }
      $consulta = $conexion->prepare("SELECT * FROM usuario WHERE emailUser = :correo");
      $consulta->bindParam(':correo', $correo);
      $consulta->execute();
      $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
      if($usuario && password_verify($contrasenia, $usuario['passUser'])) {
          $_SESSION['usuario'] = "cliente";
          $_SESSION['nombreUsuario'] = $usuario['nombreUser'];
          header('Location: index.php');
          exit();
      }else{
          echo "<script>alert('Error. Correo electrónico o contraseña incorrectos.')</script>";
          $mensaje="";
      }
  }
} catch (PDOException $e) {
    $mensaje = "Error de conexión: " . $e->getMessage();
}
?>
<main>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md p-0">
        <article id="form">
          <form id="formularioLogin" method="POST">
            <h4><b>Iniciar sesión</b></h4>
            <input type="text" id="correo" name="correo" placeholder="Correo electrónico" required>
            <input type="password" id="contraseña" name="contrasenia" placeholder="Contraseña" required>
            <div class="text-center">
              <button class="btnLogin" type="submit">Iniciar sesión</button>
              <a class="btnLogin" href="register.php">¿No tienes cuenta? Regístrate</a>
            </div>
          </form>
        </article>
      </div>
    </div>
  </div>
</main>
<?php include('templates/footer.php');?>