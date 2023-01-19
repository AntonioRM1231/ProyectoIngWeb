<?php
  $result=$_GET['result'] ?? null;
  require '../conexionBD/database.php';
  include "../includes/templates/header_admin.php";
  //incluirTemplate('header_admin');
?>
<main class="contenedor">
  <?php if(intval($result)===1):?>
    <div class="alerta exito">Creado correctamente </div>
  <?php endif;?> 
</main>
<hr>
        <footer  class="site-footer">
            <p><b>CUIDADO CON EL MICHI</b></p>
            <p>TODOS LOS DERECHOS RESERVADOS</p>
        </footer>
        <script src="build/js/app.js"></script>
    </body>
</html>