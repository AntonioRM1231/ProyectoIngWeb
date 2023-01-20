<?php
  //Importar la conexion
  require '../conexionBD/database.php';
  $db = conectarDB();
  //Escribir el Query
  $query = "SELECT * FROM zapato";
  //Consultar la BD 
  $consulta = mysqli_query($db, $query);
  //Muestra mensaje condicional
  $result=$_GET['result'] ?? null;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];
      $id = filter_var($id, FILTER_VALIDATE_INT);
      if($id){
        //Eliminar el archivo
        $query = "SELECT imagenA, imagenB, imagenC, imagenD FROM zapato WHERE ID_Zapato = ${id}";
        $resultado = mysqli_query($db, $query);
        $zapato = mysqli_fetch_assoc($resultado);
        unlink('zapatos/image/'.$zapato['imagenA']);
        unlink('zapatos/image/'.$zapato['imagenB']);
        unlink('zapatos/image/'.$zapato['imagenC']);
        unlink('zapatos/image/'.$zapato['imagenD']);
        //Eliminar zapato
        $query = "DELETE FROM zapato WHERE ID_Zapato = ${id}";
        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/index.php?result=3');
        }

      }
  }
  //Incluye un template
  include "../includes/templates/header_admin.php";
  //incluirTemplate('header_admin');
?>
<hr>
<main class="contenedor">
  <?php if(intval($result)===1):?>
    <div class="alerta exito">Creado correctamente </div>
  <?php elseif(intval($result)===2):?>
    <div class="alerta exito">Actualizado correctamente </div>
  <?php elseif(intval($result)===3):?>
    <div class="alerta exito">Eminado correctamente </div>
  <?php endif;?>

  <table class="zapatos">
    <thead>
      <tr>
        <th>ID</th>
        <th>Color</th>
        <th>Número</th>
        <th>Stock</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Precio de compra</th>
        <th>Precio de venta</th>
        <th>Imagen 1</th>
        <th>Imagen 2</th>
        <th>Imagen 3</th>
        <th>Imagen 4</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody><!--Mostrar los resultados-->
      <?php while($zapato = mysqli_fetch_assoc($consulta)):?>
      <tr>
        <td><?php echo $zapato['ID_Zapato'] ?></td>
        <td><?php echo $zapato['Color'] ?></td>
        <td><?php echo $zapato['NumeroDisp'] ?></td>
        <td><?php echo $zapato['Disponibilidad'] ?></td>
        <td><?php echo $zapato['Marca'] ?></td>
        <td><?php echo $zapato['Modelo'] ?></td>
        <td><?php echo $zapato['PrecioCompra'] ?></td>
        <td><?php echo $zapato['PrecioVenta'] ?></td>
        <th><img src="zapatos/image/<?php echo $zapato['imagenA'] ?>" class="imagen-table"></th>
        <th><img src="zapatos/image/<?php echo $zapato['imagenB'] ?>" class="imagen-table"></th>
        <th><img src="zapatos/image/<?php echo $zapato['imagenC'] ?>" class="imagen-table"></th>
        <th><img src="zapatos/image/<?php echo $zapato['imagenD'] ?>" class="imagen-table"></th>
        <td>
          <a href="zapatos/actualizar.php?id=<?php echo $zapato['ID_Zapato'] ?>" class="boton-verde">Actualizar</a>
          <form method='POST'>
            <input type="hidden" name="id" value="<?php echo $zapato['ID_Zapato'] ?>">
            <input type="submit" class="boton-rojo" value="Eliminar">
          </form>
        </td>
      </tr>
      <?php endwhile;?>
    </tbody>
  </table>
</main>
<hr>
<?php 
//Cerrar la conexion 
?>
        <footer  class="site-footer">
            <p><b>CUIDADO CON EL MICHI</b></p>
            <p>TODOS LOS DERECHOS RESERVADOS</p>
        </footer>
        <script src="build/js/app.js"></script>
    </body>
</html>