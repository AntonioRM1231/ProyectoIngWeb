<?php
    //Determinar si es un ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
            header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/index.php');
    }
    include "../../includes/templates/header_admin.php";
    //require '../../includes/funciones.php';
    //incluirTemplate('header_admin');
    // Base de datos
    require '../../conexionBD/database.php';
    $db = conectarDB();
    //Obtener los datos del zapato
    $consulta = "SELECT * FROM zapato WHERE ID_Zapato = ${id}";
    $resultado = mysqli_query($db, $consulta);
    if (!$resultado->num_rows) {
        header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/index.php');
    }
    $zapato = mysqli_fetch_assoc($resultado);
?>
<main class="contenedor">
        <section class="contenedor">
            <div class="cuerpo-anuncio">
                <div class="anuncio-izq">
                    <img src="image/<?php echo $zapato['imagenA'] ?>" class="pics" id="<?php echo $zapato['imagenA'] ?>">
                    <img src="image/<?php echo $zapato['imagenB'] ?>" class="pics" id="<?php echo $zapato['imagenB'] ?>">
                    <img src="image/<?php echo $zapato['imagenC'] ?>" class="pics" id="<?php echo $zapato['imagenC'] ?>">
                    <img src="image/<?php echo $zapato['imagenD'] ?>" class="pics" id="<?php echo $zapato['imagenD'] ?>">
                </div>
                <div class="anuncio-der">
                    <h2><?php echo $zapato['Modelo'] ?></h2>
                    <p><?php echo "$".$zapato['PrecioVenta'] ?></p>
                    <p><?php echo $zapato['NumeroDisp'] ?> MX </p>
                </div>
            </div>
        </section>
    </main>
    <?php
    include "../../includes/templates/footer.php";
    ?>
