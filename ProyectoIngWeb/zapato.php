<?php
    //Determinar si es un ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
            header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/productos.php');
    }
    include "includes/templates/header_productos.php";
    //require '../../includes/funciones.php';
    //incluirTemplate('header_admin');
    // Base de datos
    require 'conexionBD/database.php';
    $db = conectarDB();
    //Obtener los datos del zapato
    $consulta = "SELECT * FROM zapato WHERE ID_Zapato = ${id}";
    $resultado = mysqli_query($db, $consulta);
    if (!$resultado->num_rows) {
        header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/index.php');
    }
    $zapato = mysqli_fetch_assoc($resultado);
?>
<hr>
<main class="contenedor">
        <section class="contenedor">
            <div class="cuerpo-anuncio">
                <div class="anuncio-izq">
                    <img src="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/image/<?php echo $zapato['imagenA'] ?>" class="pics">
                    <img src="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/image/<?php echo $zapato['imagenB'] ?>" class="pics">
                    <img src="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/image/<?php echo $zapato['imagenC'] ?>" class="pics">
                    <img src="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/image/<?php echo $zapato['imagenD'] ?>" class="pics">
                </div>
                <div class="anuncio-der">
                    <h2><?php echo $zapato['Modelo'] ?></h2>
                    <p><?php echo "$".$zapato['PrecioVenta'] ?></p>
                    <p><?php echo $zapato['NumeroDisp'] ?> MX </p>
                </div>
            </div>
        </section>
    </main>
        <footer  class="site-footer">
            <p><b>CUIDADO CON EL MICHI</b></p>
            <p>TODOS LOS DERECHOS RESERVADOS</p>
        </footer>
        <script src="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/build/js/app.js"></script>
    </body>
</html>
