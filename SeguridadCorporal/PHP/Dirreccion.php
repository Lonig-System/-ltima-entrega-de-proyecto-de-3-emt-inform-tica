<?php
session_start();

$nombre=$_SESSION['nombre'] ;
$apellido=$_SESSION['apellido'];
$tipo=$_SESSION['rol'] ;
$usuario=$_SESSION['Nusu'];


$numeroP=$_POST['NP'];
$calle=$_POST['calle'];
$barrio=$_POST['barrio'];


include("Conexio.php");
$conexion=abrirConexion();
$sentencia = $conexion->prepare("INSERT INTO dirrecion  VALUES ( ? , ? , ? , ?  )");
$sentencia->bind_param('iiss',$usuario,$numeroP,$calle,$barrio);	
$sentencia->execute();
cerrarConexion($conexion);
header("../index.php");
