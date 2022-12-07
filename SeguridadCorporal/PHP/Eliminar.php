<?php
$id=$_GET['id'];
$tipo=$_GET['ti'];

include("Conexion.php");


switch ($tipo) {
  case 'usuario':
    $conexion=abrirConexion();
    $sentencia = $conexion->prepare("DELETE FROM usuario WHERE NumUsuario=?");
    $sentencia->bind_param('i',$id);	
    $sentencia->execute();
    cerrarConexion($conexion);

    session_start();
    if($id==$_SESSION["Nusu"]){
      unset($_SESSION["nombre"]); 
      unset($_SESSION["apellido"]);
      unset($_SESSION["rol"]);
      unset($_SESSION["Nusu"]);
      session_destroy();  
    }
    break;
  
  case 'producto':
    $conexion=abrirConexion();
    $sentencia = $conexion->prepare("DELETE FROM producto WHERE IDProducto=?");
    $sentencia->bind_param('i',$id);	
    $sentencia->execute();
    cerrarConexion($conexion);
    $img=$_GET['img'];

    unlink("../IMG/Productos/$img");
    break;
    case 'paquete':
      $conexion=abrirConexion();
      $sentencia = $conexion->prepare("DELETE FROM paquete WHERE IDPaquete=?");
      $sentencia->bind_param('i',$id);	
      $sentencia->execute();
      cerrarConexion($conexion);
  
      break;
}



header("Location: ../index.php");