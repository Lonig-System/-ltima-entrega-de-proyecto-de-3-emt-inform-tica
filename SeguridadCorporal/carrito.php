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
    <link rel="stylesheet" href="CSS/form.css">
    
    <link rel="stylesheet" href="CSS/carrito.css">
    <link rel="stylesheet" href="CSS/usu.css" />
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
                <x class="fa fa-caret-down"></x>
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

    <?php
        $total=0;


        include("PHP/Conexion.php");
        if(isset($_SESSION['carrito'])&&!($_SESSION['carrito']==false)){
            $i=count($_SESSION['carrito']);
            

            echo "<div class='mar'><table  class='table  table-striped ' >";
            echo "<tr>";
            echo "<th scope='col'>Nombre</th><th scope='col'>Cantidad</th><th scope='col'>Precio</th>";
            echo "</tr>";
            for($x=0 ; true; $x++){

                if($x >$i){
                    break;
                }
                if(isset($_SESSION['carrito'][$x])){

                    $idp=$_SESSION['carrito'][$x];
                    if(isset($_GET['idpp']) and isset($_GET['cann'])){
                        if($_GET['idpp']==$idp){
                            $_SESSION['carritoCan'][$x]=$_GET['cann'];
                        } 
                    }
                    $can=$_SESSION['carritoCan'][$x];

                    $conexion=abrirConexion();
                    $sentencia = $conexion->prepare("SELECT IDProducto, Nombre, Descripcion, Precio, Stock, Foto FROM producto where IDProducto=?");
                    $sentencia->bind_param("i",$idp);
                    $sentencia->execute();
                    $sentencia->store_result();
                    $sentencia->bind_result( $IDProducto, $Nombre, $Descripcion, $Precio, $Stock, $Foto); //obtener los datos de cada columna
                    $sentencia->fetch();

                    

                    $tot=$Precio*$can;
                    $total=$total+$tot;
                    echo"<tr>";
                    echo"<td>$Nombre</td>"; 
                    echo"<td>$can</td >"; 
                    echo"<td>$tot</td>"; 
                    echo" </tr> "; 
                }
            }

            
        }if(isset($_SESSION['paq'])&&!($_SESSION['paq']==false)){
            $i=count($_SESSION['paq']);
            $i--;
            
          
            for( ; $i >= 0; $i--){
                
                $idpq=$_SESSION['paq'][$i];
                if(isset($_GET['idpq']) and isset($_GET['canq'])){
                    if($_GET['idpq']==$idpq){
                        $_SESSION['paqCan'][$i]=$_GET['canq'];
                    } 
                }
                $canq= $_SESSION['paqCan'][$i];
                $conexion=abrirConexion();
                $sentencia = $conexion->prepare("SELECT IDPaquete, IDProducto, Nombre, Descuento, Cantidad_Producto FROM paquete where IDPaquete=?  ");
                $sentencia->bind_param("i",$idpq);
                $sentencia->execute();
                $sentencia->store_result();
                if ($sentencia->num_rows != 0){
                    $sentencia->bind_result( $IDPaquete, $IDProducto, $Nombre, $Descuento, $Cantidad_Producto); //obtener los datos de cada columna
                    cerrarConexion($conexion);
                    while ($sentencia->fetch()){
                        $idp = explode(":", $IDProducto);
                        $cap = explode(":", $Cantidad_Producto);
                        $f=count($idp);                           
                        $t=0;
                        $totalq=0;
                        $f--;     
                        for( ; $f >= 0; $f--){
                            $pid=$idp[$f];
                            $cant=$cap[$f];
                
                            $conexion2=abrirConexion();
                            $sql = "SELECT IDProducto, Precio FROM producto where IDProducto= '" . $pid ."'  ";
	                        $resultado = $conexion2->query("$sql");
                            if (($resultado->num_rows) > 0){ 
                                $fila = $resultado->fetch_assoc();
                                $t=$fila['Precio']*$cant;
                                $totalq=$totalq+$t;
                                $x=$totalq*$Descuento;
                                $Totalq=$x/100;
                            }
                        }
                    }
                    
                    $total=$total+$tot;
                    echo"<tr>";
                    echo"<td>$Nombre</td>"; 
                    echo"<td>$canq</td >"; 
                    echo"<td>$tot</td>"; 
                    echo" </tr> "; 


                }
            }
        }
        echo"</table> </div>"; 
        
    ?>
    <?php
        if((isset($_SESSION['carrito'])&&!($_SESSION['carrito']==false))||(isset($_SESSION['paq'])&&!($_SESSION['paq']==false)) ){


    ?>
    <section>
        <div class="tal mar">
            <h2> Total:<?php echo $total ?></h2>
            <button id="myBtn" >Pagar</button>
        </div>
        
        <!-- Modal -->
        <div id="myModal" class="modal" >
            <!-- Modal contenido -->
            <div class="modal-content" >
                <span class="close">&times;</span>
                <h1>Realizacion de pago</h1>
                <br><br>
                <form action="PHP/Pedido.php" method="post" >
                    <label for="MPago">Metodo de pago:</label>
                    <select id="Mpago" name="MPago" class="controls">
                        <option value="PayPal">PayPal</option>
                        <option value="Master">Master Card</option>
                        <option value="Oca">Oca</option>
                        <option value="Visa">Visa</option>
                    </select><br><br>
                    <label for="" >Numero de tajeta:</label>
                    <input type="number" value="NTar" required class="controls"><br><br>
                    <label for="">Fecha de caducidad:</label>
                    <input type="date" value="FC" required class="controls"><br><br>
                    <label for="">Codigo de verificacion:</label>
                    <input type="number" value="cver" required class="controls"><br><br>

                    <input type="hidden" name="Total" value="<?php echo $total ?>">

                    <button type="reset" class="btn" class="controls">Borrar</button>
                    
                        <br><br>
                     <div class="tal">
                   <h2>Total: <?php echo $total ?></h2>
                <button type="submit" class=" btn" >Pagar</button> 
                </div> 
                </form>
            </div>
        </div>
    </section>
    <?php
        }
            if(isset($_SESSION['carrito'])&&!($_SESSION['carrito']==false)){
                $i=count($_SESSION['carrito']);
                $i--;

                for( ; $i >= 0; $i--){
    
                    if(isset($_SESSION['carrito'][$i])){
    
                        $idp=$_SESSION['carrito'][$i];
                        if(isset($_GET['idpp'])){
                            if($_GET['idpp']==$idp){
                                $_SESSION['carritoCan'][$i]=$_GET['cann'];
                            } 
                        }
                        $can=$_SESSION['carritoCan'][$i];
    
                        $conexion=abrirConexion();
                        $sentencia = $conexion->prepare("SELECT IDProducto, Nombre, Descripcion,  Precio, Stock, Foto FROM producto where IDProducto=?");
                        $sentencia->bind_param("i",$idp);
                        $sentencia->execute();
                        $sentencia->store_result();
                        $sentencia->bind_result( $IDProducto, $Nombre, $Descripcion,  $Precio, $Stock, $Foto); //obtener los datos de cada columna
                        $sentencia->fetch();

                       

        ?>
        <section class="mar" >
            <div class="fas">      
                <div class="producto">
                    <img class="imagen" src="IMG/Productos/<?php echo $Foto; ?>" />
                    <div class="po">
                        <h3><?php echo $Nombre; ?></h3>
                        <p><?php echo $Descripcion; ?></p>
                        <p><?php echo "USD $ ". $Precio; ?></p>
                    </div>
                    <div class="can">
                        <h4>Cantidad</h4>
                        <form action="carrito.php" method="get">
                            <input type="number" name="cann" value="<?php echo $can; ?>" min="1" max="<?php echo $Stock; ?>" >
                            <input type="hidden" name="idpp"  value="<?php echo $IDProducto; ?>" >
                            <button type='submit'>listo</button>

                        </form>
                        
                        <a href="Carrito.php?accion=borrar&idp=<?php echo $IDProducto; ?>"></a>
                        <br>
                        <!--eliminar-->
                        <a href="PHP/Carrito.php?accion=borrar&idp=<?php echo $IDProducto; ?>">Quitar producto</a>
                 </div>
                </div>
            </div>
        </section>
        <?php
                }
            }
            
        }
        
        if(isset($_SESSION['paq'])&&!($_SESSION['paq']==false)){
            $i=count($_SESSION['paq']);
            $i--;
            
          
            for( ; $i >= 0; $i--){
                $idpq=$_SESSION['paq'][$i];

                if(isset($_GET['idpq']) and isset($_GET['canq'])){
                    if($_GET['idpq']==$idpq){
                        $_SESSION['paqCan'][$i]=$_GET['canq'];
                    } 
                }
                $canq= $_SESSION['paqCan'][$i];
                
                $conexion=abrirConexion();
                $sentencia = $conexion->prepare("SELECT IDPaquete, IDProducto, Nombre, Descuento, Cantidad_Producto FROM paquete where IDPaquete=?  ");
                $sentencia->bind_param("i",$idpq);
                $sentencia->execute();
                $sentencia->store_result();
                if ($sentencia->num_rows != 0){
                    $sentencia->bind_result( $IDPaquete, $IDProducto, $Nombre, $Descuento, $Cantidad_Producto); //obtener los datos de cada columna
                    cerrarConexion($conexion);
                    while ($sentencia->fetch()){
                        $idp = explode(":", $IDProducto);
                        $cap = explode(":", $Cantidad_Producto);
                        $f=count($idp);                           
                        $t=0;
                        $totalq=0;
                        $f--;  
                        $des="-";   
                        for( ; $f >= 0; $f--){
                            $pid=$idp[$f];
                            $cant=$cap[$f];
                
                            $conexion2=abrirConexion();
                            $sql = "SELECT * FROM producto where IDProducto= '" . $pid ."'  ";
	                        $resultado = $conexion2->query("$sql");
                            if (($resultado->num_rows) > 0){ 
                                $fila = $resultado->fetch_assoc();
                                $t=$fila['Precio']*$cant;
                                $totalq=$totalq+$t;
                                $x=$totalq*$Descuento;
                                $Totalq=$x/100;

                                $des=$des."-".$fila['Nombre']."x".$cant;
                            }
                        }
                    }
                    ?>
                    <section class="mar" >
            <div class="fas">      
                <div class="producto">
                    <img class="imagen" src="IMG/Paquete.png ?>" />
                    <div class="po">
                        <h3><?php echo $Nombre; ?></h3>
                        <p><?php echo $des; ?></p>
                        <p><?php echo "USD $ ". $Totalq; ?></p>
                    </div>
                    <div class="can">
                        <h4>Cantidad</h4>
                        <form action="carrito.php" method="get">
                            <input type="number" name="canq" value="<?php echo $canq; ?>" min="1" max="4" >
                            <input type="hidden" name="idpq"  value="<?php echo $IDPaquete; ?>" >
                            <button type='submit'>listo</button>

                        </form>
                        
                        
                        <!--eliminar-->
                        <a href="PHP/Carrito.php?accion=borrar2&idp=<?php echo $IDPaquete ?>">Quitar producto</a>
                 </div>
                </div>
            </div>
        </section> 

<?php
                }
            }
        }
        ?>
  

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

        //  modal
        var modal = document.getElementById("myModal");

        // abrir modal
        var btn = document.getElementById("myBtn");

        var span = document.getElementsByClassName("close")[0];
        var spann = document.getElementsByClassName("close2")[0];
    
        btn.onclick = function () {
            modal.style.display = "block";
        }
        span.onclick = function () {
            modal.style.display = "none";
        }
        spann.onclick = function () {
            modal.style.display = "none";
        }
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>