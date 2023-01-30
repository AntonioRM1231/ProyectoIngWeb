<?php
require '../../conexionBD/database.php';
include "../../includes/templates/header_admin.php";
require "../../includes/funciones.php";
$auth = estaAutenticadoAdmin();
// var_dump($auth);
// echo "var session: ";
// var_dump($_SESSION);
if(!$auth){
    // echo 'dentro del if';
    header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/index.php');
}
$db = conectarDB();
$query = "SELECT * FROM pedido";
$consulta = mysqli_query($db, $query);
?>
<main class="contenedor">
<table class="zapatos">
    <thead>
      <tr>
        <th>ID pedido</th>
        <th>ID zapato</th>
        <th>ID Direccion</th>
        <th>Fecha</th>
        <th>Correo</th>
      </tr>
    </thead>
    <tbody><!--Mostrar los resultados-->
	<?php while($pedido = mysqli_fetch_assoc($consulta)):?>
      <tr>
        <td><?php echo $pedido['ID_Pedido'] ?></td>
        <td><?php echo $pedido['ID_Zapato'] ?></td>
        <td><?php echo $pedido['ID_Direccion'] ?></td>
        <td><?php echo $pedido['FechaPedido'] ?></td>
        <td><?php echo $pedido['CorreoE'] ?></td>
      </tr>
      <?php endwhile;?>
    </tbody>
  </table>
</main>