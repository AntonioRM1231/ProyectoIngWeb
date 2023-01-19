<?php
  $result=$_GET['result'] ?? null;
  require '../conexionBD/database.php';
  include "../includes/templates/header_admin.php";
  //incluirTemplate('header_admin');
?>
<hr>
<main class="contenedor">
  <?php if(intval($result)===1):?>
    <div class="alerta exito">Creado correctamente </div>
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
    <tbody>
      <tr>
        <td>1</td>
        <td>Blanco</td>
        <td>7</td>
        <td>12</td>
        <td>ADIDAS</td>
        <td>FORUM LOW EXHIBIT</td>
        <td>900</td>
        <td>2000</td>
        <th><img src="../imagenes/forum1.png" class="imagen-table"></th>
        <th><img src="../imagenes/forum2.png" class="imagen-table"></th>
        <th><img src="../imagenes/forum3.png" class="imagen-table"></th>
        <th><img src="../imagenes/forum4.png" class="imagen-table"></th>
        <td>
          <a href="#" class="boton-verde">Actualizar</a>
          <a href="#" class="boton-rojo">Eliminar</a>
        </td>

      </tr>
    </tbody>
  </table>
</main>
<hr>
        <footer  class="site-footer">
            <p><b>CUIDADO CON EL MICHI</b></p>
            <p>TODOS LOS DERECHOS RESERVADOS</p>
        </footer>
        <script src="build/js/app.js"></script>
    </body>
</html>