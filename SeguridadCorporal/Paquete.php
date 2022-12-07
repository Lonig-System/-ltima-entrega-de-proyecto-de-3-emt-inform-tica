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
 
  <link rel="stylesheet" href="CSS/NavNFooter.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  
  <link rel="stylesheet" href="CSS/usu.css" />
  <link rel="stylesheet" href="CSS/form.css" />
  <link rel="stylesheet" href="CSS/nav.css">

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
      <div class="cascada">
        <button class="dropbtn">Productos 
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="cascada-content">
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

   <!--Slider-->
   <section class="form">

    <form action="PHP/AñadirPaquete.php" method="POST">
      <h4>Paquetes</h4>
      <input type="text"name="nom" class="controls" placeholder="Nombre del paqutes">
      <select  name="des" class="controls">
        <option value="0">Descuento</option>
        <option value="5">5%</option>
        <option value="10">10%</option>
        <option value="15">15%</option>
        <option value="20">20%</option>
        <option value="25">25%</option>
        <option value="30">30%</option>
      </select><br><br>
      <?php
      $conexion=abrirConexion();
      $sentencia = $conexion->prepare("SELECT IDProducto, Nombre, Stock FROM producto");
      $sentencia->execute();
      $sentencia->store_result();	//almacenar el resultado
   
      
    
      if ($sentencia->num_rows != 0){
        
        $sentencia->bind_result( $idp, $Nombre, $Stock); //obtener los datos de cada columna
    
        echo "<table class='table form ' style='color: #ffffff;'>
        <tr>
        
        <th scope='col'>ID</th>
        <th scope='col'>Nombre</th>
        <th scope='col'>Añadir</th>
        <th scope='col'>Cantidad</th>
        
        </tr>";
  
        while ($sentencia->fetch()){
        
          echo "<tr>
          <td>$idp</td>
          <td>$Nombre</td>
          <td><input type='checkbox' name='$idp' value='1'   >Añadir</td>
          <td><input type='number' name='n$idp' min='1' max='$Stock' value='1'   > Cantidad</td>
          </tr>";
           
        }
        echo "</table>"; 
      }
      ?>
      <button type="submit" class="btn">Listo</button>
  
    </form>


</section>


  <!--Footer-->
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

    let slideIndex = 1;
    showSlides(slideIndex);

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("mySlides");
      let dots = document.getElementsByClassName("dot");

      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }

      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";
    }
  </script>

  
</body>

</html>