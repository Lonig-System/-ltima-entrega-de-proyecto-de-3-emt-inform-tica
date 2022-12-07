<?php

session_start();

$nombre=$_SESSION['nombre'] ;
$apellido=$_SESSION['apellido'];
$tipo=$_SESSION['rol'] ;
$usuario=$_SESSION['Nusu'];

$nombre=$_POST['nombre'];

$pre=explode( ",",$_POST['pre']);



$stock=$_POST['st'];
$des=$_POST['des'];
$tipo=$_POST['tipo'];

$proveedor=$_POST['pr'];


$edi=$_POST['edi'];
include("Conexion.php");

if($edi=="false"){

  $ruta = "../IMG/Productos/";
  $ruta = $ruta . basename( $_FILES['img']['name']); 
  if(move_uploaded_file($_FILES['img']['tmp_name'], $ruta)) {
    echo "El archivo ".  basename( $_FILES['img']['name']). 
    " ha sido subido";
  } else{
   
  }

  $imgn=basename( $_FILES['img']['name']);

  


  $conexion=abrirConexion();
	$sentencia = $conexion->prepare("INSERT INTO producto 
  (Nombre, Descripcion, Precio, Stock, IDProveedor,Foto, Tipo) 
  VALUES ( ? , ? , ? , ? , ? , ? , ?  )");
  $sentencia->bind_param('ssiiisi',$nombre,$des,$pre[0],$stock,$proveedor,$imgn,$tipo);	
  $sentencia->execute();
  cerrarConexion($conexion);
  

  $conexion=abrirConexion();
  $sql = "SELECT * FROM producto WHERE Nombre = '" . $nombre ."'";
	$resultado = $conexion->query("$sql");

	if (($resultado->num_rows) > 0){ 
    $producto = $resultado->fetch_assoc();
    $idP=$producto['IDProducto'];
    cerrarConexion($conexion);
	
    $conexion=abrirConexion();
	  $sentencia = $conexion->prepare("INSERT INTO producto_has_proveedor (Producto_IDProducto, Proveedor_IDProveedor) 
    VALUES ( ? , ?  )");
    $sentencia->bind_param('ii',$idP,$proveedor);	
    $sentencia->execute();
    cerrarConexion($conexion);
    cerrarConexion($conexion);
	
    $conexion=abrirConexion();
	  $sentencia = $conexion->prepare("INSERT INTO comprador_compra_producto (NumUsuarioCo, IDProducto) 
    VALUES ( ? , ?  )");
    $sentencia->bind_param('ii',$usuario,$idP);	
    $sentencia->execute();
    cerrarConexion($conexion);

    header("Location: ../Index.php");
		
	}

}else{


  $id=$_POST["id"];
  
 
  
  
  $conexion=abrirConexion();
  $sentencia = $conexion->prepare("UPDATE producto SET 
   Nombre=?, Descripcion=?, Precio=?, Stock=?, IDProveedor=?, Tipo=? WHERE `IDProducto`=? ");
  $sentencia->bind_param('ssiiiii',$nombre,$des,$pre[0],$stock,$proveedor,$tipo,$id);	
  $sentencia->execute();

  cerrarConexion($conexion);
  $conexion=abrirConexion();
  $sentencia = $conexion->prepare("INSERT INTO comprador_gestiona_producto (NumUsuarioCo, IDProducto) 
  VALUES ( ? , ?  )");
  $sentencia->bind_param('ii',$usuario,$idP);	
  $sentencia->execute();
  cerrarConexion($conexion);
  header("Location: ../Index.php");


}