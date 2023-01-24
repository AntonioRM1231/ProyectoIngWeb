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

<html> 
    <body>
        <main class="contenedor">
        <?php if(intval($resultado) === 1):?>
            <div class="alerta exito">¡El registro se llevó a cabo exitosamente!</div>  
        <?php endif;?>   
        <h2>NUESTROS PRODUCTOS</h2>
            <section class="seccion contenedor">
                <div class="contenedor-anuncio">
                    <a href="anuncio.html" class="anuncio">
                        <picture>
                            <source srcset="imagenes/forum1.png" type="image/jpg">
                            <img loading="lazy" src="imagenes/forum1.png" alt="anuncio">
                        </picture>
                        <div class="contenido-anuncio">
                            <h3>ADIDAS FORUM LOW EXHIBIT</h3>
                            <p class="precio"><b> $1,200.00</b></p>
                        </div>
                    </a>
                </div>
            </section>
        </main>
        <footer  class="site-footer">
            <p><b>CUIDADO CON EL MICHI</b></p>
            <p>TODOS LOS DERECHOS RESERVADOS</p>
        </footer>
        <script src="build/js/app.js"></script>
    </body>
</html>
