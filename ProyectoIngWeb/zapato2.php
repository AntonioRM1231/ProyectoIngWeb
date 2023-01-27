<?php
    echo "hola1";
    echo "<br>";
    //Determinar si es un ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        echo "no hay id";
        echo "<br>";
            //header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/productos.php');
    }
    include "includes/templates/header_cat.php";
    //require '../../includes/funciones.php';
    //incluirTemplate('header_admin');
    // Base de datos
    require 'conexionBD/database.php';
    $db = conectarDB();
    echo "después de la conexión";
    echo "<br>";
    //Obtener los datos del zapato
    $consulta = "SELECT * FROM zapato WHERE ID_Zapato = ${id}";
    $resultado = mysqli_query($db, $consulta);
    if (!$resultado->num_rows) {
        header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/index.php');
    }
    echo "después del resultado";
    echo "<br>";
    $zapato = mysqli_fetch_assoc($resultado);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "en el if";
        var_dump($auth);
        echo "despues del ivardump";
        sleep(10);
        //header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/index.php');
    }
?>
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
                    <form class="formulario" method="POST" action="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/zapato2.php">
                        <input type="submit" class="boton-marron" value="Comprar">
                    </form>
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
