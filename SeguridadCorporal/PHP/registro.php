<?php
$nombre=$_POST['nombre'];
$apellido =$_POST['apellido'];
$correo=$_POST['correo'];
$tel=$_POST['tel'];
$fn=$_POST['FNac'];
$date=date("Y-m-d");
$tipo=$_POST['Tipo'];
$con=$_POST['con'];
$u=$_POST['ubicacion'];

include('Conexion.php');

$conexion=abrirConexion();
$existe=verificarUsuario($conexion, $nombre, $con);
cerrarConexion($conexion);



if($existe == "false"){
    
    $conexion=abrirConexion();
	$sentencia = $conexion->prepare("INSERT INTO usuario 
    (`Nombre`, `Apellido`, `Correo`, `Telefono`, `FNacimiento`, `Contra`, `Tipo`) 
    VALUES ( ? , ? , ? , ? ,  ? ,PASSWORD (?) , ?  )");
    $sentencia->bind_param('sssissi',$nombre,$apellido,$correo,$tel,$fn,$con,$tipo);	
    $sentencia->execute();
    cerrarConexion($conexion);

    $conexion=abrirConexion();
    $Nusu=verificarUsuario($conexion, $nombre, $con);
    cerrarConexion($conexion);
    
    switch($tipo){
        case 1:
            $conexion=abrirConexion();
            $sentencia = $conexion->prepare("INSERT INTO vendedor  VALUES ( ? , ?  );");
            $sentencia->bind_param('is',$Nusu,$date);	
            $sentencia->execute();
            cerrarConexion($conexion);
            header("Location:../index.php"); 
        break;
        case 2:

            $conexion=abrirConexion();
            $sentencia = $conexion->prepare("INSERT INTO comprador  VALUES ( ? , ?  );");
            $sentencia->bind_param('is',$Nusu,$date);	
            $sentencia->execute();
            cerrarConexion($conexion);
            header("Location:../index.php"); 
        break;
        case 4:
           
            $v=0;
            $conexion=abrirConexion();
            $sentencia = $conexion->prepare("INSERT INTO cliente  VALUES ( ? , ?  );");
            $sentencia->bind_param('ii',$Nusu,$v);	
            $sentencia->execute();
            cerrarConexion($conexion);

            
    
            if($u=="regi.html"){
                session_start();
                $_SESSION['nombre'] = $nombre;
                $_SESSION['apellido'] = $apellido;
                $_SESSION['rol'] = $tipo;
                $_SESSION['Nusu'] = $Nusu;
                $_SESSION['carrito']=false;
                $_SESSION['paq']=false;
                header("Location:../index.php"); 
            }
            header("Location:../index.php"); 
        break;
    }
        
}else{
    header("Location:../$u");
}