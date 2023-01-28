<?php
    //PRODUCTOS PARA CUANDO YA TIENE UNA CUENTA EL CLIENTE
    require 'includes/funciones.php';
    //require 'conexionBD/connection.php';
    include "includes/templates/header_cat.php";
    //******************************************************/
    $auth = estaAutenticado();
    // var_dump($auth);
    // echo "var session: ";
    // var_dump($_SESSION);
    /*
    if(!$auth){
        // echo 'dentro del if';
        header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/index.php');
    }*/
    //******************************************************/

    $resultado = $_GET['res'];
    $id_cliente = $_GET['id'];
    $id_cliente = filter_var($id_cliente,FILTER_VALIDATE_INT);
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

