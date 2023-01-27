<?php
  //Importar la conexion
  // //Escribir el Query
  // $query = "SELECT * FROM zapato";
  // //Consultar la BD 
  // $consulta = mysqli_query($db, $query);
  //Muestra mensaje condicional
  $result=$_GET['result'] ?? null;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      require '../../conexionBD/database.php';
      $db = conectarDB();
      $id = $_POST['id'];
      $id = filter_var($id, FILTER_VALIDATE_INT);
      if($id){
        //Eliminar el archivo
        $query = "SELECT imagenA, imagenB, imagenC, imagenD FROM zapato WHERE ID_Zapato = ${id}";
        $resultado = mysqli_query($db, $query);
        echo "prueba";
        $zapato = mysqli_fetch_assoc($resultado);

        unlink('image/'.$zapato['imagenA']);
        unlink('image/'.$zapato['imagenB']);
        unlink('image/'.$zapato['imagenC']);
        unlink('image/'.$zapato['imagenD']);
        //Eliminar zapato
        $query = "DELETE FROM zapato WHERE ID_Zapato = ${id}";
        $resultado = mysqli_query($db, $query);
        
        if ($resultado) {
            header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/editar.php?result=3');
        }

      }
      
  }
  //Incluye un template
  include "../../includes/templates/header_admin.php";
  //incluirTemplate('header_admin');
?>
<main class="contenedor">
  <a href="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/crear.php" class="boton-agua">CREAR</a>
  <?php if(intval($result)===1):?>
    <div class="alerta exito">Creado correctamente </div>
  <?php elseif(intval($result)===2):?>
    <div class="alerta exito">Actualizado correctamente </div>
  <?php elseif(intval($result)===3):?>
    <div class="alerta exito">Eminado correctamente </div>
  <?php endif;?>

  <!-- CARDS -->
  <?php
  //Incluye un template
  
  include "../../includes/templates/anuncios_g.php";
  
  ?>
  <!-- <div class="contenedor-anuncio"> -->
  <?php //while($zapato = mysqli_fetch_assoc($consulta)):?>
    <!-- <div class="anuncio">
      <div id="<?php //echo "carousel".$zapato['ID_Zapato'] ?>" class="carousel slide">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="image/<?php //echo $zapato['imagenA'] ?>" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="image/<?php //echo $zapato['imagenB'] ?>" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="image/<?php //echo $zapato['imagenC'] ?>" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="image/<?php //echo $zapato['imagenD'] ?>" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="<?php //echo "#carousel".$zapato['ID_Zapato'] ?>" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="<?php //echo "#carousel".$zapato['ID_Zapato'] ?>" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <div class="contenido-anuncio">
        <h3><?php //echo $zapato['Modelo'] ?></h3>
        <p><?php //echo $zapato['Categoria'] ?>--<?php //echo $zapato['Marca'] ?><p>
        <p>ID: <?php //echo $zapato['ID_Zapato'] ?> Color: <?php //echo $zapato['Color'] ?><p>
        <p>Sz: <?php //echo $zapato['NumeroDisp']."MX" ?> Stock: <?php //echo $zapato['Disponibilidad'] ?><p>
        <p><?php //echo "$".$zapato['PrecioCompra'] ?>-<?php //echo "$".$zapato['PrecioVenta'] ?><p>
        <a href="zapato.php?id=<?php //echo $zapato['ID_Zapato'] ?>" class="boton-agua">Ver</a>
        <a href="actualizar.php?id=<?php //echo $zapato['ID_Zapato'] ?>" class="boton-verde">Actualizar</a>
        <form method='POST'>
          <input type="hidden" name="id" value="<?php //echo $zapato['ID_Zapato'] ?>">
          <input type="submit" class="boton-rojo" value="Eliminar">
        </form>
      </div>
    </div> -->
  <?php //endwhile;?>
  <!-- </div> -->
</main>
<hr>
<?php 
//Cerrar la conexion 
?>
        <footer  class="site-footer">
            <p><b>CUIDADO CON EL MICHI</b></p>
            <p>TODOS LOS DERECHOS RESERVADOS</p>
        </footer>
        <script src="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/build/js/app.js"></script>
    </body>
</html>