

<?php
$nombre=$_POST['nombre'];
$web=$_POST['web'];

include("Conexion.php");
$conexion=abrirConexion();
$sentencia = $conexion->prepare("INSERT INTO proveedor (`Nombre`, `PaginaWeb`) VALUES ( ? , ? )");
$sentencia->bind_param('ss',$nombre,$web);	
$sentencia->execute();
cerrarConexion($conexion);
header('location:../index.php');

