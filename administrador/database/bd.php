<?php
define("KEY", "turism23");
define("COD", "AES-128-ECB");

$host = "localhost";
$usuario = "root";
$contrasenia = "";
$bd = "agenciaturismo";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd;charset=utf8", $usuario, $contrasenia);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo "Error de conexión: " . $ex->getMessage();
    exit;
}
?>
