<?php
    $resultado = $_GET['res'];
    $id_cliente = $_GET['id'];
    $id_cliente = filter_var($id_cliente,FILTER_VALIDATE_INT);
    //echo "resulta es:";
    //var_dump($_GET['resultado']);
    //exit;
    require 'includes/funciones.php';
    //require 'Cliente.php';
    //require 'conexionBD/connection.php';
    //incluirTemplate('header');  
    include "includes/templates/header_productos.php";
?>
        <main class="contenedor">
            <?php if(intval($resultado) === 1):?>
                <div class="alerta exito">¡El registro se llevó a cabo exitosamente!</div>  
            <?php endif;?>   
            <h2>NUESTROS PRODUCTOS</h2>
            <?php
                $usr = 1;
                $cat = '';
                include "includes/templates/anuncios.php";
            ?>
        </main>
        <?php 
            include "includes/templates/nosotros.php";
            include "includes/templates/footer.php"; 
        ?>

