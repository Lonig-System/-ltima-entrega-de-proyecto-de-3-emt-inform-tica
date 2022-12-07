<?php


$conexion=abrirConexion();
$sentencia = $conexion->prepare("SELECT IDPaquete, IDProducto, Nombre, Descuento, Cantidad_Producto FROM paquete ");
$sentencia->execute();
$sentencia->store_result();
if ($sentencia->num_rows != 0){
    $sentencia->bind_result( $IDPaquete, $IDProducto, $Nombre, $Descuento, $Cantidad_Producto); //obtener los datos de cada columna
    
    while ($sentencia->fetch()){
        $idp = explode(":", $IDProducto);
        $cap = explode(":", $Cantidad_Producto);
        $i=count($idp);
        $t=0;
        $total=0;
        for($x=0 ; true; $x++){
            if($x >$i){
                break;
            }
            $pid=$idp[$x];
            $can=$cap[$x];
            $conexion=abrirConexion();
            $sentencia = $conexion->prepare("SELECT IDProducto, Nombre, Descripcion, Divisa, Precio, Stock, Foto FROM producto where IDProducto=?");
            $sentencia->bind_param("i",$pid);
            $sentencia->execute();
            $sentencia->store_result();
            $sentencia->bind_result( $IDP, $Precio); //obtener los datos de cada columna
        
            while($sentencia->fetch()){

                $t=$Precio*$cap;
                $total=$total+$t;

                $x=$total*$Descuento;
                $Total=$x/100;
            }
        }
    }
  }
