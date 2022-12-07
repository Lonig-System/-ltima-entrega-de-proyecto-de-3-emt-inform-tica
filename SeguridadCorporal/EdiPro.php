<?php
session_start();

$nombre=$_SESSION['nombre'] ;
$apellido=$_SESSION['apellido'];
$tipo=$_SESSION['rol'] ;
$usuario=$_SESSION['Nusu'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seguridad Corporal</title>
  <link rel="icon" type="image/svg+xml" href="IMG/logo2.png" />
  <link rel="stylesheet" href="CSS/form.css">
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

  
  <?php
    

    include("PHP/Conexion.php");

    $id=$_GET['id'];
      
    $conexion2=abrirConexion();
    $sql = "SELECT * FROM producto where IDProducto= '" . $id ."'  ";
    $resultado = $conexion2->query("$sql");
    if (($resultado->num_rows) > 0){ 
      $fila = $resultado->fetch_assoc();
    
      ?>
  <section class="form">
    <form action="PHP/AñadirP.php" method="post" enctype="multipart/form-data" >
      <h4>Modificar producto</h4>
      <input type="text" name="nombre" placeholder="Nombre del producto" class="controls" value="<?php echo $fila['Nombre'];  ?>" required><br><br>

      <input type="number" name="pre" placeholder="Precio" class="controls" step="0.01" value="<?php echo $fila['Precio'];  ?>" required><br><br>
      <input type="number" name="st" placeholder="stock" class="controls" value="<?php echo $fila['Stock'];  ?>" required><br><br>
      <textarea name="des"  class="controls" ><?php echo $fila['Descripcion'];  ?></textarea><br><br>
      

      <select   name="tipo" class="controls">
        <option value="<?php echo $fila['Tipo'];  ?>">Por defecto</option>
        <option value="1">Cascos</option>
        <option value="2">Gafas</option>
        <option value="3">Auriculares</option>
        <option value="4">Guantes</option>
        <option value="5">Buzos</option>
        <option value="6">Pantalones</option>
        <option value="7">Calzado</option>
        <option value="8">Trajes</option>
        <option value="9">Otros</option>
      </select><br><br>
      <input type="hidden" name="edi" value="true">
      <input type="hidden" name="id" value="<?php echo $fila['IDProducto'];  ?>">
      
      
      <?php
       
        $conexion=abrirConexion();
				$sentencia = $conexion->prepare("SELECT IDProveedor, Nombre FROM proveedor");
				$sentencia->execute();
				$sentencia->store_result();	//almacenar el resultado
				
          if ($sentencia->num_rows != 0){
				
            $sentencia->bind_result($idp,$nombrep); //obtener los datos de cada columna
						echo "<select  name='pr' class='controls'><option value='".$fila['Tipo']."'>Por defecto</option>";
  
            while ($sentencia->fetch()){
						
							echo "<option value='$idp'>$nombrep</option>";
							 
						}
						echo "</select>"; 
					} 
        
      ?>
      
          
      <button type="submit" class="btn">Modificar</button><br><br>
      
    </form>
    <?php
    }
    ?>
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
  </script>
</body>

</html>