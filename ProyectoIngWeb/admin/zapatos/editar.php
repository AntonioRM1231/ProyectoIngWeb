<?php
  //Importar la conexion
require "../../includes/funciones.php";
  // //Escribir el Query
  // $query = "SELECT * FROM zapato";
  // //Consultar la BD 
  // $consulta = mysqli_query($db, $query);
  //Muestra mensaje condicional
  $auth = estaAutenticadoAdmin();
    // var_dump($auth);
    // echo "var session: ";
    // var_dump($_SESSION);
    if(!$auth){
        // echo 'dentro del if';
        header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/index.php');
    }
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
  
</main>
<?php
  include "../../includes/templates/footer.php";
?>
        