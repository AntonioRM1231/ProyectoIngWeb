<?php
  
  //Determinar si es un ID valido
  $id = $_GET['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);

  if (!$id) {
        header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/editar.php');
  }
  include "../../includes/templates/header_admin.php";
  //require '../../includes/funciones.php';
  //incluirTemplate('header_admin');
  // Base de datos
  require '../../conexionBD/database.php';
  $db = conectarDB();
  //Obtener los datos del zapato
  $consulta = "SELECT * FROM zapato WHERE ID_Zapato = ${id}";
  $resultado = mysqli_query($db, $consulta);
  $zapato = mysqli_fetch_assoc($resultado);

  $errores = [];
  //Asignacion de valores inciales
  $color = $zapato['Color'];
  $numeroD = $zapato['NumeroDisp'];
  $stock = $zapato['Disponibilidad'];
  $marca = $zapato['Marca'];
  $modelo = $zapato['Modelo'];
  $pcompra = $zapato['PrecioCompra'];
  $pventa = $zapato['PrecioVenta'];
  $imagenA = $zapato['imagenA'];
  $imagenB = $zapato['imagenB'];
  $imagenC = $zapato['imagenC'];
  $imagenD = $zapato['imagenD'];
  $categoria = $zapato['Categoria'];
    if($_SERVER['REQUEST_METHOD']==='POST'){
    //     echo "<pre>";
    //     var_dump($_POST);
    //     echo "</pre>";
    //     echo "<pre>";
    //     var_dump($_FILES);
    //     echo "</pre>";
    //     exit;
        $color = strtoupper(filter_var($_POST['color'], FILTER_SANITIZE_STRING));
        $numeroD = filter_var($_POST['numeroD'], FILTER_SANITIZE_NUMBER_INT);
        $stock = filter_var($_POST['stock'], FILTER_SANITIZE_NUMBER_INT);
        $marca = strtoupper(filter_var($_POST['marca'], FILTER_SANITIZE_STRING));
        $modelo = strtoupper(filter_var($_POST['modelo'], FILTER_SANITIZE_STRING));
        $pcompra = $_POST['pcompra'];
        $pventa = $_POST['pventa'];
        $categoria = strtoupper(filter_var($_POST['categoria'],FILTER_SANITIZE_STRING));
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
        if (!$categoria) {
            $errores[] = "Debes añadir la categoria";
        }
        //Insertar en la base de datos
        if (empty($errores)) {
             /*SUBIDA DE ARCHIVOS */

             //Crear carpetas 
             $carpetaImagenes ='image/';

             if (!is_dir($carpetaImagenes)) {
                 mkdir($carpetaImagenes);
             }
             $nombreImagen1 = '';
             $nombreImagen2 = '';
             $nombreImagen3 = '';
             $nombreImagen4 = '';

             if ($imagen1['name']) {
                //Eliminar la imagen previa 
                unlink($carpetaImagenes.$zapato['imagenA']);
                //Generar un nombre unico
                $nombreImagen1 = md5(uniqid(rand(),true)).".jpg";
                //Subir la imagen
                move_uploaded_file($imagen1['tmp_name'], $carpetaImagenes.$nombreImagen1);
            }else{
                $nombreImagen1 = $zapato['imagenA'];
            }
            if ($imagen2['name']) {
                //Eliminar la imagen previa 
                unlink($carpetaImagenes.$zapato['imagenB']);
                $nombreImagen2 = md5(uniqid(rand(),true)).".jpg";
                move_uploaded_file($imagen2['tmp_name'], $carpetaImagenes.$nombreImagen2);
            }else{
                $nombreImagen2 = $zapato['imagenB'];
            }
            if ($imagen3['name']) {
                //Eliminar la imagen previa 
                unlink($carpetaImagenes.$zapato['imagenC']);
                $nombreImagen3 = md5(uniqid(rand(),true)).".jpg";
                move_uploaded_file($imagen3['tmp_name'], $carpetaImagenes.$nombreImagen3);
            }else{
                $nombreImagen3 = $zapato['imagenC'];
            }
            if ($imagen4['name']) {
                //Eliminar la imagen previa 
                unlink($carpetaImagenes.$zapato['imagenD']);
                $nombreImagen4 = md5(uniqid(rand(),true)).".jpg";
                move_uploaded_file($imagen4['tmp_name'], $carpetaImagenes.$nombreImagen4);

            }else{
                $nombreImagen4 = $zapato['imagenD'];
            }
             
            $query = " UPDATE zapato SET Color='${color}',NumeroDisp=${numeroD}, Disponibilidad=${stock}, 
            Marca='${marca}', Modelo='${modelo}', PrecioCompra=${pcompra}, PrecioVenta=${pventa},
            imagenA='${nombreImagen1}', imagenB='${nombreImagen2}', imagenC='${nombreImagen3}', imagenD='${nombreImagen4}', Categoria='${categoria}' WHERE ID_Zapato=${id}";
            echo $query;
            $resultado = mysqli_query($db,$query);
            
            if ($resultado) {
                //Redireccionando al usuario
                header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/editar.php?result=2');
            }
         }
    }
   ?>
        <hr>
        <section id="#crear">
            <h2>Actualizar</h2>
            <div class="contenedor">
                <?php foreach ($errores as $error): ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
                <?php endforeach; ?>
                <form method="POST" class="formulario" enctype="multipart/form-data">
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
                            <label class="label" for="categoria">Categoria</label>
                            <input class="field" type="text" id="categoria" name="categoria" placeholder="Categoria" value="<?php echo $categoria; ?>">
                        </div>
                        <div class="campo">
                            <label class="label" for="img1">Imagen 1</label>
                            <input class="field" type="file" id="img1" name="img1" accept="image/jpeg, image/png">
                            <img src="image/<?php echo $imagenA ?>" class="imagen-campo">
                        </div>
                        <div class="campo">
                            <label class="label" for="img2">Imagen 2</label>
                            <input class="field" type="file" id="img2" name="img2" accept="image/jpeg, image/png">
                            <img src="image/<?php echo $imagenB ?>" class="imagen-campo">
                        </div>
                        <div class="campo">
                            <label class="label" for="img3">Imagen 3</label>
                            <input class="field" type="file" id="img3" name="img3" accept="image/jpeg, image/png">
                            <img src="image/<?php echo $imagenC ?>" class="imagen-campo">
                        </div>
                        <div class="campo">
                            <label class="label" for="img4">Imagen 4</label>
                            <input class="field" type="file" id="img4" name="img4" accept="image/jpeg, image/png">
                            <img src="image/<?php echo $imagenD ?>" class="imagen-campo">
                        </div>
                    </fieldset>
                    <input type="submit" value="Actualizar" class="boton-marron">
                </form>
            </div>
        </section>
        <hr>
        <footer  class="site-footer">
            <p><b>CUIDADO CON EL MICHI</b></p>
            <p>TODOS LOS DERECHOS RESERVADOS</p>
        </footer>
        <script src="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/build/js/app.js"></script>
    </body>
</html>