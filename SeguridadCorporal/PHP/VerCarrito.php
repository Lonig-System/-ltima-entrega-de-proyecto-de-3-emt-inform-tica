<section >
        <div class="fas">      
            <div class="producto">
                <img class="imagen" src="IMG/Productos/<?php echo $Foto; ?>" />
                <div class="po">
                    <h3><?php echo $Nombre; ?></h3>
                    <p><?php echo $Descripcion; ?></p>
                    <p><?php echo $Divisa." $ ". $Precio; ?></p>
                </div>
                <div class="can">
                    <h4>Cantidad</h4>
                    <input type="number" id="can" min="1" max="<?php echo $Stock; ?>" >
                    <a href="Carrito.php?accion=borrar&idp=<?php echo $IDProducto; ?>">listo</a>
                    <br>
                    <!--eliminar-->
                    <a href="PHP/Carrito.php?accion=borrar&idp=<?php echo $IDProducto; ?>">Quitar producto</a>
                </div>
            </div>
    

            
        </div>
    </section>