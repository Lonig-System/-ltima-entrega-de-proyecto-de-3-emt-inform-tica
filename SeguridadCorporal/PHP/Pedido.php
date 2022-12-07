<?php
include("Conexion.php");
session_start();
if(isset($_SESSION['Nusu'])){
    $nombre=$_SESSION['nombre'] ;
    $apellido=$_SESSION['apellido'];
    $tipo=$_SESSION['rol'] ;
    $usuario=$_SESSION['Nusu'];


    if(  !($tipo==4) || (isset($_SESSION['Verificacion']) && $_SESSION['Verificacion']==1)   ){

        if(isset($_SESSION['carrito'])&& !($_SESSION['carrito']==false)){
            $i=count($_SESSION['carrito']);
            $i--;
            $total=0;
        

            for( ; $i >= 0; $i--){

                if(isset($_SESSION['carrito'][$i])){
                    $idp=$_SESSION['carrito'][$i];

                    $can=$_SESSION['carritoCan'][$i];

                    $conexion=abrirConexion();
                    $sentencia = $conexion->prepare("SELECT IDProducto, Nombre, Descripcion, Precio, Stock, Foto FROM producto where IDProducto=?");
                    $sentencia->bind_param("i",$idp);
                    $sentencia->execute();
                    $sentencia->store_result();
                    $sentencia->bind_result( $IDProducto, $Nombre, $Descripcion, $Precio, $Stock, $Foto); //obtener los datos de cada columna
                    $sentencia->fetch();
                    if(isset( $Productos)){
                        $Productos=$Productos. ":".$IDProducto;
                        $cantidad=$cantidad.":".$can;
                    }else{
                        $Productos=$IDProducto;
                        $cantidad=$can;
                    }
                  

                
                }
            }
           
           
            
        }
        if(isset($_SESSION['paq'])&&!($_SESSION['paq']==false)){
            $i=count($_SESSION['paq']);
          
            $i--;

            for( ; $i >= 0; $i--){
                
                $idpq=$_SESSION['paq'][$i];
                $canq=$_SESSION['paqCan'][$i];
                
                if(isset($PQ)){
                    $PQ=$PQ. ":".$idpq;
                    $cantidadq=$cantidadq.":".$canq;
                }else{
                    $PQ=$idpq;
                    $cantidadq=$canq;
                }
                    
                
            }
        }#IDPedido, IDProducto, IDPaquete, NumUsuarioCl, Estado, Fecha_Realizado, Verificacion, Precio, CantidadProducto
        


        if(isset($cantidad) and isset($cantidadq)){
            $catt=$cantidad."-".$cantidadq;
        }elseif(isset($cantidad)){
            $catt=$cantidad;
        }else{
            $catt=$cantidadq;
        }
        


        $Total=$_POST['Total'];
        $e="pago pendiente";
        $date=date('Y-m-d');
        $ver=0;
        echo"$Productos,$PQ,$usuario, $e,$date,$ver,$Total,$catt";
        $conexion=abrirConexion();
        $sentencia = $conexion->prepare(
        "INSERT INTO pedido(
            IDProducto, IDPaquete, NumUsuarioCl, Estado, Fecha_Realizado, Verificacion, Precio, CantidadProducto
        )  VALUES ( ?,?,?,?,?,?,?,? );");
        $sentencia->bind_param('ssissiis',$Productos,$PQ,$usuario, $e,$date,$ver,$Total,$catt );	
        $sentencia->execute();
        cerrarConexion($conexion);
        header("Location: ../Index.php");

    }else{
        header("Location: ../carrito.php");
    }
}else{
  header("Location: ../carrito.php");

}header("Location: ../carrito.php");





   