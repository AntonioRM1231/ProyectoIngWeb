  <?php
  require 'conexionBD/database.php';
  require 'includes/funciones.php';
  incluirTemplate('header_admin');
  $errores = [];
  $db = conectarDB();
//   $db = new connection();
//   $conexion = $db->get_connection();
    if($_SERVER['REQUEST_METHOD']==='POST'){
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        $color = $_POST['color'];
        $numeroD = $_POST['numeroD'];
        $stock = $_POST['stock'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $pcompra = $_POST['pcompra'];
        $pventa = $_POST['pventa'];
        //Errores
        if (!$color) {
            $errores[] = "Debes añadir un color";
        }
        if (!$numeroD) {
            $errores[] = "Debes añadir el numero";
        }
        if (!$stock) {
            $errores[] = "Debes añadir el stcok";
        }
        if (!$marca) {
            $errores[] = "Debes añadir la marca";
        }
        if (!$modelo) {
            $errores[] = "Debes añadir el modelo";
        }
        if (!$pcompra) {
            $errores[] = "Debes añadir el precio de compra";
        }
        if (!$pventa) {
            $errores[] = "Debes añadir el precio de venta";
        }
        //Insertar en la base de datos
        if (empty($errores)) {
           $query = " INSERT INTO zapato (Color,NumeroDisp, Disponibilidad, Marca, Modelo, PrecioCompra, PrecioVenta, imagenA, imagenB, imagenC, imagenD)
            VALUES ('$color','$numeroD','$stock','$marca','$modelo','$pcompra','$pventa','','','','')";
           //echo $query
           $resultado = mysqli_query($db,$query); 
        } 
        

        // if($resultado){
        //     echo "Insertado correctamente";
        // }
        // $statement = $conexion->prepare('CALL ingresarZapato(?,?,?,?,?,?,?,?,?,?,?)');
        // echo 'prueba';
        // $statement->bind_param('siissddssss',
        //     $color,
        //     $numeroD,
        //     $stock,
        //     $marca,
        //     $modelo,
        //     $pcompra,
        //     $pventa,
        //     ' ',
        //     ' ',
        //     ' ',
        //     ' '
        // );
        // echo 'hi';
        // $statement->execute();
        // echo 'hi3';
        // $statement->close();
        // echo 'hi4';
        // $conexion->close();
        // echo 'hi5';
    }
   ?>
        <hr>
        <section id="#crear">
            <h2>Crear</h2>
            <div class="contenedor">
                <?php foreach ($errores as $error): ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
                <?php endforeach; ?>
                <form action="admin.php" method="POST" class="formulario">
                    <fieldset>
                        <legend>Zapato</legend>
                        <div class="campo">
                            <label class="label" for="color">Color</label>
                            <input class="field" type="text" id="color" name="color" placeholder="Color">
                        </div>
                        <div class="campo">
                            <label class="label" for="numeroD">Numero</label>
                            <input class="field" type="number" id="numeroD" name="numeroD" placeholder="Color">
                        </div>
                        <div class="campo">
                            <label class="label" for="stock">Stock</label>
                            <input class="field" type="number" id="stock" name="stock" placeholder="Color">
                        </div>
                        <div class="campo">
                            <label class="label" for="marca">Marca</label>
                            <input class="field" type="text" id="marca" name="marca" placeholder="Marca">
                        </div>
                        <div class="campo">
                            <label class="label" for="modelo">Modelo</label>
                            <input class="field" type="text" id="modelo" name="modelo" placeholder="Modelo">
                        </div>
                        <div class="campo">
                            <label class="label" for="pcompra">Precio de compra</label>
                            <input class="field" type="number" id="pcompra" name="pcompra" placeholder="Precio de compra">
                        </div>
                        <div class="campo">
                            <label class="label" for="pventa">Precio de venta</label>
                            <input class="field" type="numeber" id="pventa" name="pventa" placeholder="Precio de venta">
                        </div>
                        <div class="campo">
                            <label class="label" for="img1">Imagen 1</label>
                            <input class="field" type="file" id="img1" name="img1" accept="image/jpeg, image/png">
                        </div>
                        <div class="campo">
                            <label class="label" for="img2">Imagen 2</label>
                            <input class="field" type="file" id="img2" name="img2" accept="image/jpeg, image/png">
                        </div>
                        <div class="campo">
                            <label class="label" for="img3">Imagen 3</label>
                            <input class="field" type="file" id="img3" name="img3" accept="image/jpeg, image/png">
                        </div>
                        <div class="campo">
                            <label class="label" for="img4">Imagen 4</label>
                            <input class="field" type="file" id="img4" name="img4" accept="image/jpeg, image/png">
                        </div>
                    </fieldset>
                    <input type="submit" value="Crear Zapato" class="boton-marron">
                </form>
            </div>
        </section>
        <hr>
        <footer  class="site-footer">
            <p><b>CUIDADO CON EL MICHI</b></p>
            <p>TODOS LOS DERECHOS RESERVADOS</p>
        </footer>
        <script src="build/js/app.js"></script>
    </body>
</html>