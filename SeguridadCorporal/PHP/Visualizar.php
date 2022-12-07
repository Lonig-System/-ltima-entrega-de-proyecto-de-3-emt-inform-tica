<?php
$que=$_GET['que'];
include("Conexion.php");

switch($que){
    case 'cliente' :
        $t=0;
      $conexion=abrirConexion();
      $sentencia = $conexion->prepare("SELECT  usuario.NumUsuario, usuario.Nombre, usuario.Apellido, usuario.Correo, usuario.Telefono, usuario.FNacimiento, cliente.Verificacion FROM usuario inner join cliente on 
      usuario.NumUsuario=cliente.NumUsuarioCl where Verificacion=?");
      $sentencia->bind_param("i",$t);
      $sentencia->execute();
      $sentencia->store_result();	//almacenar el resultado
    
      if ($sentencia->num_rows != 0){
        
        $sentencia->bind_result( $id, $Nombre, $Apellido, $Correo, $telefono, $FN, $v); //obtener los datos de cada columna
        echo "<table  class='table  table-striped' >";
        echo "<tr>";
        echo "<th scope='col'>id</th><th scope='col'>Nombre</th><th scope='col'>Apellido</th><th scope='col'>
        Correo</th><th scope='col'>Telefono</th><th scope='col'>FNacimiento</th>
        <th scope='col'>Verificar</th><th scope='col'>Eliminar</th>";
        echo "</tr>";
        
        while ($sentencia->fetch()){
          echo "<tr>";
          echo "<th scope='row'>$id </th><td>$Nombre</td><td>$Apellido</td><td>$Correo</td><td>$telefono</td><td>$FN</td>
          <td><a href='PHP/autenticar.php?id=$id&t=1'>Autenticar</a></td>
          <td><a href='PHP/autenticar.php?id=$id&t=0'>X</a></td>";
          echo "</tr>"; 
        }
        echo "</table><br><br><br><hr><br><br><br> ";  
      }
      cerrarConexion($conexion);
      $t=1;

      $conexion=abrirConexion();
      $sentencia = $conexion->prepare("SELECT  usuario.NumUsuario, usuario.Nombre, usuario.Apellido, usuario.Correo, usuario.Telefono, usuario.FNacimiento FROM usuario inner join cliente on 
      usuario.NumUsuario=cliente.NumUsuarioCl where Verificacion=?");
      $sentencia->bind_param("i",$t);
      $sentencia->execute();
      $sentencia->store_result();	//almacenar el resultado
    
      if ($sentencia->num_rows != 0){
        
        $sentencia->bind_result( $id, $Nombre, $Apellido, $Correo, $telefono, $FN); //obtener los datos de cada columna
        echo "<table  class='table  table-striped' >";
        echo "<tr>";
        echo "<th scope='col'>id</th><th scope='col'>Nombre</th><th scope='col'>Apellido</th><th scope='col'>
        Correo</th><th scope='col'>Telefono</th><th scope='col'>FNacimiento</th>";
        echo "</tr>";
        
        while ($sentencia->fetch()){
          echo "<tr>";
          echo "<th scope='row'>$id </th><td>$Nombre</td><td>$Apellido</td>
          <td>$Correo</td><td>$telefono</td><td>$FN</td>";
          echo "</tr>"; 
        }
        echo "</table><br><br><br><hr><br><br><br> ";  
      }
      cerrarConexion($conexion);
    break;
    case 'usuario':
      $t=3;
      $conexion=abrirConexion();
      $sentencia = $conexion->prepare("SELECT NumUsuario, Nombre, Apellido, 
      Correo, Telefono, FNacimiento, Tipo FROM usuario where Tipo<?");
      $sentencia->bind_param("i",$t);
      $sentencia->execute();
      $sentencia->store_result();	//almacenar el resultado
    
      if ($sentencia->num_rows != 0){
        
        $sentencia->bind_result( $id, $Nombre, $Apellido, $Correo, $telefono, $FN, $Tipo); //obtener los datos de cada columna
        echo "<table  class='table  table-striped' >";
        echo "<tr>";
        echo "<th scope='col'>id</th><th scope='col'>Nombre</th><th scope='col'>Apellido</th><th scope='col'>
        Correo</th><th scope='col'>Telefono</th><th scope='col'>FNacimiento</th><th scope='col'>Tipo</th>
       <th scope='col'>Eliminar</th>
      
       ";
        echo "</tr>";
        
        while ($sentencia->fetch()){

          switch($Tipo){
            case 0:
              $tip="Jefe";
            break;
            case 1:
              $tip="Vendedor";
            break;
            case 2:
              $tip="Comprador";
            break;
          }
          
          echo "<tr>";
          echo "<th scope='row'>$id </th>
          <td>$Nombre</td>
          <td>$Apellido</td>
          <td>$Correo</td>
          <td>$telefono</td>
          <td>$FN</td>
          <td>$tip</td>
          
          <td><a href='PHP/Eliminar.php?id=$id&ti=usuario'>Eliminar</a></td>
          ";
          echo "</tr>"; 
         
        }
        echo "</table><br><br>";  
      }


    break;
    case 'producto':

      $conexion=abrirConexion();
      $sentencia = $conexion->prepare("SELECT IDProducto, Nombre, 
      Descripcion, Precio, Stock, IDProveedor, Foto FROM producto");
      $sentencia->execute();
      $sentencia->store_result();	//almacenar el resultado
   
      
    
      if ($sentencia->num_rows != 0){
        
        $sentencia->bind_result( $id, $Nombre, $Decripcion, $Precio, $Stock, $IDProveedor, $img); //obtener los datos de cada columna
        echo "<table  class='table  table-striped' >";
        echo "<tr>";
        echo "<th scope='col'>id</th><th scope='col'>Nombre</th><th scope='col'>Decripcion</th><th scope='col'>
        Precio</th><th scope='col'>Stock</th><th scope='col'>IDProveedor</th><th scope='col'>Imagen</th>
       <th scope='col'>Eliminar</th>
       <th scope='col'>Editar</th>";
        echo "</tr>";
        
        while ($sentencia->fetch()){
          echo "<tr>";
          echo "<th scope='row'>$id </th><td>$Nombre</td><td>$Decripcion</td>
          <td>$$Precio</td><td>$Stock</td><td>$IDProveedor</td><td><img src='IMG/Productos/$img'width='300px' ></td>
          
          <td><a href='PHP/Eliminar.php?id=$id&ti=producto'&img=$img>X</a></td> 
          <td><a href='EdiPro.php?id=$id'>Editar</a></td>";
         
          
          echo "</tr>"; 
        }
        echo "</table><br><br><br><hr><br><br><br> ";  
      }


    break;
    case 'paquete':
      
      $conexion=abrirConexion();
      $sentencia = $conexion->prepare("SELECT IDPaquete, IDProducto, Nombre, Descuento, Cantidad_Producto FROM paquete ");
      $sentencia->execute();
      $sentencia->store_result();
      if ($sentencia->num_rows != 0){
        $sentencia->bind_result( $IDPaquete, $IDProducto, $Nombre, $Descuento, $Cantidad_Producto); //obtener los datos de cada columna
        cerrarConexion($conexion);
        echo "<table  class='table  table-striped' >";
        echo "<tr>";
        echo "
        <th scope='col'>id</th>
        <th scope='col'>Nombre</th>
        <th scope='col'>Descuento</th>
        <th scope='col'>Contenido</th>
        <th scope='col'>Precio Total</th>
    

        <th scope='col'>Eliminar</th>";
        echo "</tr>";
        while ($sentencia->fetch()){
          $idp = explode(":", $IDProducto);
          $cap = explode(":", $Cantidad_Producto);
          $i=count($idp);                           
          $t=0;
          $total=0;
          $i--;
          $des="-";

        
          for( ; $i >= 0; $i--){
            

            $pid=$idp[$i];
            $can=$cap[$i];
            
            $conexion2=abrirConexion();
            $sql = "SELECT * FROM producto where IDProducto= '" . $pid ."'  ";
            $resultado = $conexion2->query("$sql");

            if (($resultado->num_rows) > 0){ 
              $fila = $resultado->fetch_assoc();

              $t=$fila['Precio']*$can;
              
              $total=$total+$t;
              

            
              $x=$total*$Descuento;
              $Total=$x/100;

              $des=$des."-".$fila['Nombre']."x".$can;
            }

          }
          echo "<tr>";
          echo "
          <th scope='row'> $IDPaquete</th>
          <td>$Nombre</td>
          <td>$Descuento%</td>
          <td>$des</td>
          <td>USD$Total</td>
         
    
          
          <td><a href='PHP/Eliminar.php?id=$IDPaquete&ti=paquete'>X</a></td>";
          echo "</tr>"; 
        }}

    break;
    case 'pedidos':
      
      $t=0;
      $conexion=abrirConexion();
      $sentencia = $conexion->prepare("SELECT * FROM pedido where Verificacion=?");
      $sentencia->bind_param("i",$t);
      $sentencia->execute();
      $sentencia->store_result();	//almacenar el resultado

      
    
      if ($sentencia->num_rows != 0){
        
        $sentencia->bind_result( $IDPedido, $IDProducto, $IDPaquete, $NumUsuarioCl, $Estado, $Fecha_Realizado, $Verificacion, $Precio, $CantidadProducto); //obtener los datos de cada columna
        echo "<table  class='table  table-striped' >";
        echo "<tr>";
        echo "
        <th scope='col'>id</th>
        <th scope='col'>Usuario</th>
        <th scope='col'>Estado</th>
        <th scope='col'>Fecha</th>
        <th scope='col'>Precio</th>
        <th scope='col'>Verificar</th>
        <th scope='col'>Eliminar</th>";
        echo "</tr>";
        
        while ($sentencia->fetch()){
          echo "<tr>";
          echo "
          <th scope='row'>$IDPedido </th>
          <td>$NumUsuarioCl</td>
          <td>$Estado</td>
          <td>$Fecha_Realizado</td>
          <td>$Precio</td>
          <td><a href='PHP/AutenticarPed.php?id=$IDPedido&t=1'>Autenticar</a></td>
          <td><a href='PHP/AutenticarPed.php?id=$IDPedido&t=0'>X</a></td>";
          echo "</tr>"; 
        }
        echo "</table><br><br><br><hr><br><br><br> ";  
      }
      cerrarConexion($conexion);
      $t=1;
      $conexion=abrirConexion();
      $sentencia = $conexion->prepare("SELECT * FROM pedido where Verificacion=?");
      $sentencia->bind_param("i",$t);
      $sentencia->execute();
      $sentencia->store_result();


      if ($sentencia->num_rows != 0){
      $sentencia->bind_result( $IDPedido, $IDProducto, $IDPaquete, $NumUsuarioCl, $Estado, $Fecha_Realizado, $Verificacion, $Precio, $CantidadProducto); //obtener los datos de cada columna
      echo "<table  class='table  table-striped' >";
      echo "<tr>";
      echo "
      <th scope='col'>id</th>
      <th scope='col'>Usuario</th>
      <th scope='col'>Estado</th>
      <th scope='col'>Fecha</th>
      <th scope='col'>Precio</th>";
      echo "</tr>";
      
      while ($sentencia->fetch()){
        echo "<tr>";
        echo "
        <th scope='row'>$IDPedido </th>
        <td>$NumUsuarioCl</td>
        <td>$Estado</td>
        <td>$Fecha_Realizado</td>
        <td>$Precio</td>";
        echo "</tr>"; 
      }
      echo "</table><br><br><br><hr><br><br><br> ";  
    }

     
      cerrarConexion($conexion);
    break;

    default:
      echo "<h1 style='text-aling=center'>Seleccione opcion</h1>";
      

    break;


}


      