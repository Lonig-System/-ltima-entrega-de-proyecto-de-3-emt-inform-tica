<?php
session_start();

$nombre=$_SESSION['nombre'] ;
$apellido=$_SESSION['apellido'];
$tipo=$_SESSION['rol'] ;
$usuario=$_SESSION['Nusu'];

$id=$_GET['id'];
$t=$_GET['t'];


    if($t == 1 ){
        include("Conexion.php");
        $conexion=abrirConexion();
        $sentencia = $conexion->prepare("UPDATE cliente SET Verificacion=? WHERE NumUsuarioCl=?");
        $sentencia->bind_param('ii',$t,$id);	
        $sentencia->execute();
        cerrarConexion($conexion);

        $conexion=abrirConexion();
        $sentencia = $conexion->prepare("INSERT INTO vendedor_verifica_cliente VALUES (?,?)");
        $sentencia->bind_param('ii',$usuario,$id);	
        $sentencia->execute();
        cerrarConexion($conexion);

        header('Location:../Visualizar.php');
    }else{
    
        include("Conexion.php");
        $conexion=abrirConexion();
        $sentencia = $conexion->prepare("DELETE FROM usuario WHERE NumUsuario=?");
        $sentencia->bind_param('i',$id);	
        $sentencia->execute();
        cerrarConexion($conexion);
        header('Location:../Visualizar.php');
    } 

