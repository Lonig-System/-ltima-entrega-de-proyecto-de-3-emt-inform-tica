<?php

session_start();
if(isset($_SESSION['Nusu'])){
$nombre=$_SESSION['nombre'] ;
$apellido=$_SESSION['apellido'];
$tipo=$_SESSION['rol'] ;
$usuario=$_SESSION['Nusu'];
}else{
  $tipo=9;
  $nombre=null;
  $apellido=null;
}
if(isset($_GET['i'])){
   unset($_SESSION['carrito']);
   $_SESSION['carrito']=false;

}
#if($tipo==4 && $_SESSION['Verificacion']==0 ){

if(isset($_GET['t'])){
    $ti=$_GET['t'];
    if( isset($_GET['idp']) ){
        $idp=$_GET['idp'];
        if(isset($_GET['paq'])){
            if(!($_SESSION['paq']==false)){
                $e=0;
               
                while( array_key_exists($e, $_SESSION['paq'] )){
                    $e++;
                }
        
                $_SESSION['paq'][$e]=$idp;
                $_SESSION['paq'][$e]=1;
            }else{
                $_SESSION['paq'][0]=$idp;
                $_SESSION['paqCan'][0]=1;
            }
        }else{
            if(!($_SESSION['carrito']==false)){
                $e=0;
               
                while( array_key_exists($e, $_SESSION['carrito'] )){
                    $e++;
                }
        
                $_SESSION['carrito'][$e]=$idp;
                $_SESSION['carritoCan'][$e]=1;
            }else{
                $_SESSION['carrito'][0]=$idp;
                $_SESSION['carritoCan'][0]=1;
            }


        }
        
       
    }header("Location:../Productos.php?Tipo=$ti");
    
}



if(isset($_GET['accion'])){
    $ac=$_GET['accion'];
    if($ac=='borrar'){

        $idp=$_GET['idp'];
        $clave = array_search("$idp", $_SESSION['carrito']);
        unset($_SESSION['carrito'][$clave]);

    }elseif($ac=='borrar2'){
        $idp=$_GET['idp'];

      
        $clave = array_search("$idp", $_SESSION['paq']);
        
        unset($_SESSION['paq'][$clave]);


    }header("Location:../carrito.php");
}




