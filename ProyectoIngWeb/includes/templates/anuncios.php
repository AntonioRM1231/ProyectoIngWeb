<?php 
//Logica de usuario
switch ($usr) {
  case 1:
    $urlDB = 'conexionBD/database.php';
    $ver = '/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/zapato2.php?id=';
    break;
  case 2:
    $urlDB = '../conexionBD/database.php';
    $ver = '/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/zapato.php?id=';
    break;
  case 3:
    $urlDB = 'conexionBD/database.php';
    $ver = '/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/zapato2.php?id=';
    break;
  default:
    # code...
    break;
}
// Base de datos
require $urlDB;
$db = conectarDB();
//Obtener los datos del zapato
if ($cat==='HOMBRE') {
  $query = "SELECT * FROM zapato WHERE Categoria='HOMBRE' ";
}elseif ($cat==='MUJER') {
  $query = "SELECT * FROM zapato WHERE Categoria='MUJER' ";
}elseif ($cat==='NIÑO') {
  $query = "SELECT * FROM zapato WHERE Categoria='NIÑO' ";
}elseif($cat==='NIÑA'){
  $query = "SELECT * FROM zapato WHERE Categoria='NIÑA' ";
}else {
  $query = "SELECT * FROM zapato";
} 
$consulta = mysqli_query($db, $query);
?>
<div class="contenedor-anuncio">
<?php while($zapato = mysqli_fetch_assoc($consulta)):?>
  <?php if ($zapato['Disponibilidad']>0): ?>
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
        <a href="<?php echo $ver.$zapato['ID_Zapato'] ?>" class="boton-agua">Ver</a>
      </div>
    </div>
    <?php endif; ?>
  <?php endwhile;?>
  </div>
<?php
//Cerrando la conexion a la base de datos
?>