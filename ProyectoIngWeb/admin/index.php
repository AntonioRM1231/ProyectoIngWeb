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
          <a href="#" class="boton-rojo">Eliminar</a>
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