<?php
    
    $usuario=$_POST['nombre'];
    $con=$_POST['con'];
    
    include("Conexion.php");
    
    $conexion=abrirConexion();
    $id=verificarUsuario($conexion, $usuario, $con);


    if($id=="false"){

        $u=$_POST['ubicacion'];
        header("Location: ../$u");

    }else{
        $conexion=abrirConexion();
        $sql="SELECT * FROM usuario WHERE NumUsuario= $id";
        $resultado = $conexion->query($sql);
        $contenido = $resultado->fetch_assoc();
        cerrarConexion($conexion);

        


        
        session_start();
        $_SESSION['nombre'] =  $contenido['Nombre'];
        $_SESSION['apellido'] = $contenido['Apellido'];
		$_SESSION['rol'] = $contenido['Tipo'];
        $_SESSION['Nusu'] = $contenido['NumUsuario'];
        $_SESSION['carrito']=false;
        $_SESSION['paq']=false;
        if($contenido['Tipo']==4){
            $conexion=abrirConexion();
            $sql="SELECT * FROM cliente WHERE NumUsuarioCl=$id";
            $resultado = $conexion->query($sql);
            $contenido = $resultado->fetch_assoc();

            if(isset($contenido['Verificacion'])){
                $_SESSION['Verificacion'] = $contenido['Verificacion'];

            }else{
                $_SESSION['Verificacion']=0;
            }

            
        }
        header("Location: ../index.php");


    }
