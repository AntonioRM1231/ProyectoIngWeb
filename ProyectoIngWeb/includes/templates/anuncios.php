<?php 

// Base de datos
require '../conexionBD/database.php';
$db = conectarDB();
//Obtener los datos del zapato
$query = "SELECT * FROM zapato";
$consulta = mysqli_query($db, $query);
?>
<div class="contenedor-anuncio">
<?php while($zapato = mysqli_fetch_assoc($consulta)):?>
    <div class="anuncio">
      <div id="<?php echo "carousel".$zapato['ID_Zapato'] ?>" class="carousel slide">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/image/<?php echo $zapato['imagenA'] ?>" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/image/<?php echo $zapato['imagenB'] ?>" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/image/<?php echo $zapato['imagenC'] ?>" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/image/<?php echo $zapato['imagenD'] ?>" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="<?php echo "#carousel".$zapato['ID_Zapato'] ?>" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="<?php echo "#carousel".$zapato['ID_Zapato'] ?>" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <div class="contenido-anuncio">
        <h3><?php echo $zapato['Modelo'] ?></h3>
        <p><?php echo $zapato['Categoria'] ?>--<?php echo $zapato['Marca'] ?><p>
        <p>Color: <?php echo $zapato['Color'] ?><p>
        <p>Sz: <?php echo $zapato['NumeroDisp']."MX" ?><p>
        <p><?php echo "$".$zapato['PrecioVenta'] ?><p>
        <a href="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/zapato.php?id=<?php echo $zapato['ID_Zapato'] ?>" class="boton-agua">Ver</a>
      </div>
    </div>
  <?php endwhile;?>
  </div>
<?php
//Cerrando la conexion a la base de datos

?>