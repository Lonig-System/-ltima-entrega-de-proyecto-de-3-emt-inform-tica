<?php
//Definición de las constantes para la conexión con la BD
define('SERVIDOR', "localhost");
define('USUARIO', "usuario");
define('CONTRA',"usuario" );
define('BD', "seguridadcorporal");

function abrirConexion( ){


	//Crear la conexión con MariaDB
	$conexion = @new mysqli(SERVIDOR, USUARIO, CONTRA, BD);

	//Verificar el estado de la conexión
	if ($conexion->connect_error){
		die("Error en la conexión con la BD: " . $conexion->connect_error);
	}else{
		return $conexion;
		echo "Conexión existosa!";
	}
}

function cerrarConexion($conexion){
	$conexion->close();
}



function verificarUsuario($conexion, $usuario, $contra){
	//SQL: SELECT * FROM nombreTabla
	$sql = "SELECT * FROM usuario  ";
	$sql .= "WHERE Nombre = '" . $usuario ."'  ";
	$sql .= "AND Contra = PASSWORD('" . $contra ."')";
	
	$resultado = $conexion->query("$sql");
	if (($resultado->num_rows) > 0){ 
	//hay más de una fila en el resultado?
		$fila = $resultado->fetch_assoc();
		//avanzar a la primer fila
		return $fila['NumUsuario'];	
	}else{
		return "false";
	}
}


