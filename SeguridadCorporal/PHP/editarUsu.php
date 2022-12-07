<?php

session_start();

$nombre=$_SESSION['nombre'] ;
$apellido=$_SESSION['apellido'];
$tipo=$_SESSION['rol'] ;
$usuario=$_SESSION['Nusu'];


$nombree=$_POST['nombre'];
$apellidoo =$_POST['apellido'];
$correo=$_POST['correo'];
$tel=$_POST['tel'];
$fn=$_POST['FNac'];
$con=$_POST['con'];
$contra=$_POST['contra'];#Nueva
$eliminar=$_POST['el'];

include("Conexion.php");
$conexion=abrirConexion();
$id=verificarUsuario($conexion, $nombre, $con);
cerrarConexion($conexion);

if($id == $usuario){
    if($eliminar== "false"){

        $conexion=abrirConexion();
        $sentencia = $conexion->prepare("UPDATE usuario SET 
        Nombre=?, Apellido=?, Correo=?, Telefono=?, FNacimiento=? WHERE `NumUsuario`=? ");
        $sentencia->bind_param('sssisi',$nombree,$apellidoo,$correo,$tel,$fn, $usuario);	
        $sentencia->execute();
        cerrarConexion($conexion);

        if($contra=="***"){
            $conexion=abrirConexion();
            $sentencia = $conexion->prepare("UPDATE usuario SET Contra=PASSWORD(?) WHERE `NumUsuario`=?  ");
            $sentencia->bind_param('si',$contra, $usuario);	
            $sentencia->execute();
            cerrarConexion($conexion);
            header("Location: ../index.php");
        }
    }else{
        
        header("Location: ../index.php");
    }
}


