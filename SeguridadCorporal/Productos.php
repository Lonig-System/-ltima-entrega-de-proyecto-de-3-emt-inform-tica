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
include("PHP/Conexion.php");


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seguridad Corporal</title>
  <link rel="icon" type="image/svg+xml" href="IMG/logo2.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="CSS/Productos.css" />
  <link rel="stylesheet" href="CSS/NavNFooter.css" />
  <link rel="stylesheet" href="CSS/usu.css" />
</head>
<body>
  <nav>
    <?php
      include("PHP/menuUsuario.php");
      menu($tipo, $nombre, $apellido);
    ?>
    <div class="icono">
      <a href="Index.php">
        <img id="isotipo" src="IMG/Isotipo.png" title="SeguridadCorporal" />
      </a>
    </div>
    <!--/Inicio de sesion, registro, logotipo e isotipo-->
    <!--Navegacion-->
    <div class="topnav" id="myTopnav">
    <a href="Index.php" class="active">Inicio</a>
      <div class="dropdown">
        <button class="dropbtn">Productos 
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
        <a href="Productos.php?Tipo=0">Productos</a>
          <a href="Productos.php?Tipo=1">Cascos</a>
          <a href="Productos.php?Tipo=2">Gafas</a>
          <a href="Productos.php?Tipo=3">Auriculares</a>
          <a href="Productos.php?Tipo=4">Guantes</a>
          <a href="Productos.php?Tipo=5">Buzos</a>
          <a href="Productos.php?Tipo=6">Pantalones</a>
          <a href="Productos.php?Tipo=7">Calzado</a>
          <a href="Productos.php?Tipo=8">Trajes</a>
          <a href="Productos.php?Tipo=9">Otros</a>
          <a href="Productos.php?Tipo=10">Paquetes</a>
        </div>
      </div> 
      <a href="Contacto.php">Contacto</a>
      <a href="carrito.php">Carrito</a>
      <!-- Responsive-->
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">Menu</a>
    </div>
    <!--/Navegacion-->
  </nav>

  <!--Catalogo de productos-->

  <?php


    $tipoP=$_GET['Tipo'];
    if($tipoP==0){
      $conexion=abrirConexion();
      $sentencia = $conexion->prepare("SELECT IDProducto, Nombre, Precio, Foto FROM producto");
      $sentencia->execute();
      $sentencia->store_result();	//almacenar el resultado
    }else{
      $conexion=abrirConexion();
      $sentencia = $conexion->prepare("SELECT IDProducto, Nombre, Precio, Foto FROM producto where Tipo = ?");
      $sentencia->bind_param("i",$tipoP);
      $sentencia->execute();
      $sentencia->store_result();	//almacenar el resultado
    }   
  ?>
  <section >
    <div class="page-content">
      <div class="flex ">
        <?php
        if(!($tipoP==10)){
          if ($sentencia->num_rows != 0){
            $sentencia->bind_result( $idP, $NombreP, $Precio, $img); //obtener los datos de cada columna
            while ($sentencia->fetch()){
              ?>
                <div class="product-container">
                  <h3><?php echo $NombreP ; ?></h3>
                  <hr>
                  <img class="producto" src="IMG/Productos/<?php echo $img ; ?>" />
                  <hr>


                  <div class="block">
                    <p>USD$<?php echo $Precio ; ?></p>
                    <a href="PHP/Carrito.php?idp=<?php echo $idP; ?>&t=<?php echo $tipoP; ?>"><img class="carrito" src="IMG/Carrito.png" alt=""></a>
                  </div>
                </div>
              <?php
            }
          }
        }else{
          $conexion=abrirConexion();
          $sentencia = $conexion->prepare("SELECT IDPaquete, IDProducto, Nombre, Descuento, Cantidad_Producto FROM paquete ");
          $sentencia->execute();
          $sentencia->store_result();
          if ($sentencia->num_rows != 0){
            $sentencia->bind_result( $IDPaquete, $IDProducto, $Nombre, $Descuento, $Cantidad_Producto); //obtener los datos de cada columna
            cerrarConexion($conexion);
            while ($sentencia->fetch()){
              $idp = explode(":", $IDProducto);
              $cap = explode(":", $Cantidad_Producto);
              $i=count($idp);                           
              $t=0;
              $total=0;
              $i--;     
            
              for( ; $i >= 0; $i--){
                

                $pid=$idp[$i];
                $can=$cap[$i];
                
                $conexion2=abrirConexion();
                $sql = "SELECT IDProducto, Precio FROM producto where IDProducto= '" . $pid ."'  ";
	              $resultado = $conexion2->query("$sql");

                if (($resultado->num_rows) > 0){ 
                  $fila = $resultado->fetch_assoc();

                  $t=$fila['Precio']*$can;
                  $total=$total+$t;
                  

                
                  $x=$total*$Descuento;
                  $Total=$x/100;
                }
              }
         

                
              
              
                ?>
 <div class="product-container">
                  <h3><?php echo $Nombre ; ?></h3>
                  <hr>
                  <img class="producto" src="IMG/Paquete.png" />
                  <hr>


                  <div class="block">
                    <p>USD $<?php echo $Total ; ?></p>
                    <a href="PHP/Carrito.php?idp=<?php echo $IDPaquete; ?>&t=10&paq=1"><img class="carrito" src="IMG/Carrito.png" alt=""></a>
                  </div>
                </div>


<?php
}

              
            }
          }
        
        ?>
      </div>
    </div>
  </section>
 <footer>
    <div class="footerp1">
      <p>© 2022 - Todos los derechos reservados.</p>
      <p>Desarrollado por Lonig System</p>
    </div>
    <div class="footerp2">
      <p>Contacto:</p>
      <p>Teléfono: 092 065 001</p>
      <p>Correo: seguridadcorporal@gmail.com</p>
    </div>
  </footer>
  <script>
    function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    }

    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;
    for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }
  </script>
</body>

</html>