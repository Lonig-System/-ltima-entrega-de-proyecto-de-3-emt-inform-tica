

        $conexion=abrirConexion();
        $sentencia = $conexion->prepare(
        "SELECT IDPedido FROM pedido WHERE IDProducto=? AND IDPaquete=?");
        $sentencia->bind_param('ss',$Productos,$PQ );	
        $sentencia->execute();
        
 

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
        $sentencia = $conexion->prepare("UPDATE pedido SET Verificacion=? WHERE IDPedido=?");
        $sentencia->bind_param('ii',$t,$id);	
        $sentencia->execute();
        cerrarConexion($conexion);


        $conexion=abrirConexion();
        $sentencia = $conexion->prepare(
        "INSERT INTO factura( Pedido_IDPedido)  VALUES ( ?)");
        $sentencia->bind_param('i',$id );	
        $sentencia->execute();
        cerrarConexion($conexion);

        $conexion=abrirConexion();
        $sentencia = $conexion->prepare(
        "INSERT INTO remito( Pedido_IDPedido)  VALUES ( ?)");
        $sentencia->bind_param('i',$id );	
        $sentencia->execute();
        cerrarConexion($conexion);

  

        header('Location:../Visualizar.php');
    }else{
    
        include("Conexion.php");
        $conexion=abrirConexion();
        $sentencia = $conexion->prepare("DELETE FROM pedido WHERE IDPedido=?");
        $sentencia->bind_param('i',$id);	
        $sentencia->execute();
        cerrarConexion($conexion);
        header('Location:../Visualizar.php');
    } 
