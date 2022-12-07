<?php

$nombre=$_POST['nom'];
$descuento=$_POST['des'];

include("Conexion.php");
$conexion=abrirConexion();
$sentencia = $conexion->prepare("SELECT IDProducto, Nombre FROM producto");
$sentencia->execute();
$sentencia->store_result();	//almacenar el resultado



if ($sentencia->num_rows != 0){
  
  $sentencia->bind_result( $idp, $Nombre); //obtener los datos de cada columna



    while ($sentencia->fetch()){

        if(isset($_POST[$idp])){
            $id= $idp;

            if(isset($idpp)){
                $idpp=$idpp.":".$id;
               
            }else{
                $idpp=$id;
            }
            $c="n".$idp;
            if(isset($can)){
                $can=$can.":".$_POST[$c];
            }else{
                $can=$_POST[$c];
                
            }
        }
    }

}
cerrarConexion($conexion);

$conexion=abrirConexion();
$sentencia = $conexion->prepare("INSERT INTO paquete 
( IDProducto, Nombre, Descuento, Cantidad_Producto) 
VALUES ( ? , ? , ? , ?  )");
$sentencia->bind_param('ssss',$idpp,$nombre,$descuento,$can);	
$sentencia->execute();
cerrarConexion($conexion);
header("Location:../Paquete.php");
