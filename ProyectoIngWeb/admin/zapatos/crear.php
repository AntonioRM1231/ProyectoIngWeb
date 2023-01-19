<?php
  require '../../conexionBD/database.php';
  include "../../includes/templates/header_admin.php";
  //require '../../includes/funciones.php';
  //incluirTemplate('header_admin');
  $db = conectarDB();
  $errores = [];
  $color = "";
  $numeroD = "";
  $stock = "";
  $marca = "";
  $modelo = "";
  $pcompra = "";
  $pventa = "";
    if($_SERVER['REQUEST_METHOD']==='POST'){
    //     echo "<pre>";
    //     var_dump($_POST);
    //     echo "</pre>";
    //     echo "<pre>";
    //     var_dump($_FILES);
    //     echo "</pre>";
    //     exit;
        $color = $_POST['color'];
        $numeroD = $_POST['numeroD'];
        $stock = $_POST['stock'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $pcompra = $_POST['pcompra'];
        $pventa = $_POST['pventa'];
        //Para las imagenes 
        $imagen1 = $_FILES['img1'];
        $imagen2 = $_FILES['img2'];
        $imagen3 = $_FILES['img3'];
        $imagen4 = $_FILES['img4'];
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
        if (!$imagen1['name'] || $imagen1['error'] ) {
            $errores[] = "La imagen 1 es obligatoria";
        }
        if (!$imagen2['name'] || $imagen2['error'] ) {
            $errores[] = "La imagen 2 es obligatoria";
        }
        if (!$imagen3['name'] || $imagen3['error'] ) {
            $errores[] = "La imagen 3 es obligatoria";
        }
        if (!$imagen4['name'] || $imagen4['error'] ) {
            $errores[] = "La imagen 4 es obligatoria";
        }
        //Insertar en la base de datos
        if (empty($errores)) {
             /*SUBIDA DE ARCHIVOS */
             //Crear carpetas 
             $carpetaImagenes ='image/';

             if (!is_dir($carpetaImagenes)) {
                 mkdir($carpetaImagenes);
             }
             //Generar un nombre unico
            $nombreImagen1 = md5(uniqid(rand(),true)).".jpg";
            $nombreImagen2 = md5(uniqid(rand(),true)).".jpg";
            $nombreImagen3 = md5(uniqid(rand(),true)).".jpg";
            $nombreImagen4 = md5(uniqid(rand(),true)).".jpg";
             //Subir la imagen
             move_uploaded_file($imagen1['tmp_name'], $carpetaImagenes.$nombreImagen1);
             move_uploaded_file($imagen2['tmp_name'], $carpetaImagenes.$nombreImagen2);
             move_uploaded_file($imagen3['tmp_name'], $carpetaImagenes.$nombreImagen3);
             move_uploaded_file($imagen4['tmp_name'], $carpetaImagenes.$nombreImagen4);

            $query = " INSERT INTO zapato (Color,NumeroDisp, Disponibilidad, Marca, Modelo, PrecioCompra, PrecioVenta, imagenA, imagenB, imagenC, imagenD)
             VALUES ('$color','$numeroD','$stock','$marca','$modelo','$pcompra','$pventa','$nombreImagen1','$nombreImagen2','$nombreImagen3','$nombreImagen4')";
            //echo $query
            $resultado = mysqli_query($db,$query); 
            
            if ($resultado) {
                //Redireccionando al usuario
                header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/index.php?result=1');
            }


         }
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
                <form action="crear.php" method="POST" class="formulario" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Zapato</legend>
                        <div class="campo">
                            <label class="label" for="color">Color</label>
                            <input class="field" type="text" id="color" name="color" placeholder="Color" value="<?php echo $color; ?>">
                        </div>
                        <div class="campo">
                            <label class="label" for="numeroD">Numero</label>
                            <input class="field" type="number" id="numeroD" name="numeroD" placeholder="Numero" value="<?php echo $numeroD; ?>">
                        </div>
                        <div class="campo">
                            <label class="label" for="stock">Stock</label>
                            <input class="field" type="number" id="stock" name="stock" placeholder="Stock" value="<?php echo $stock; ?>">
                        </div>
                        <div class="campo">
                            <label class="label" for="marca">Marca</label>
                            <input class="field" type="text" id="marca" name="marca" placeholder="Marca" value="<?php echo $marca; ?>">
                        </div>
                        <div class="campo">
                            <label class="label" for="modelo">Modelo</label>
                            <input class="field" type="text" id="modelo" name="modelo" placeholder="Modelo" value="<?php echo $modelo; ?>">
                        </div>
                        <div class="campo">
                            <label class="label" for="pcompra">Precio de compra</label>
                            <input class="field" type="number" id="pcompra" name="pcompra" placeholder="Precio de compra" value="<?php echo $pcompra; ?>">
                        </div>
                        <div class="campo">
                            <label class="label" for="pventa">Precio de venta</label>
                            <input class="field" type="numeber" id="pventa" name="pventa" placeholder="Precio de venta" value="<?php echo $pventa; ?>">
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