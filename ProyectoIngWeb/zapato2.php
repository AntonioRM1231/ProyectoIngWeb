<?php
    echo "hola1";
    echo "<br>";
    include "includes/templates/header_cat.php";
    require 'conexionBD/database.php';
    require 'conexionBD/connection.php';
    require 'includes/funciones.php';
    $auth = estaAutenticado();
    
    $bandera = 0;
    $bandera = $_GET['b'] ?? 0;
    if($bandera == 0){
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        //echo "id original: ".strval($id);
        $_SESSION['ID_Zapato'] = $id;
        echo "valor de session id: ".strval($_SESSION['ID_Zapato']);
    }else if($bandera == 1){
        $id = $_SESSION['ID_Zapato'];
        //echo "valor del id con session: ".strval($id);
    }
    
    $db = conectarDB();
    //Obtener los datos del zapato
    $consulta = "SELECT * FROM zapato WHERE ID_Zapato = ${id}";
    $resultado = mysqli_query($db, $consulta);
    if (!$resultado->num_rows) {
        header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/index.php');
    }
    $zapato = mysqli_fetch_assoc($resultado);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $mysql = new connection();
        $conexion = $mysql->get_connection();  

        if(!$auth){
            echo "en auth";
            echo "<br>";
            header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/iniSesionCat.php?var=1');
        }else{ 
            $consulta = "SELECT NumeroTarjeta FROM cliente WHERE CorreoE = '".$_SESSION['CorreoE']."';";
            $resultado = mysqli_query($conexion,$consulta);
            $NumeroTarjeta = mysqli_fetch_assoc($resultado);
            $NumTarjeta = $NumeroTarjeta['NumeroTarjeta'];
            $conexion->close();
            if($NumTarjeta == NULL){
                header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/regTarjeta.php');
            }else{  
                header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/regDireccion.php');
            }
        }
    }
?>
<main class="contenedor">
        <section class="contenedor">
            <div class="cuerpo-anuncio">
                <div class="anuncio-izq">
                    <img src="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/image/<?php echo $zapato['imagenA'] ?>" class="pics" id="<?php echo $zapato['imagenA'] ?>">
                    <img src="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/image/<?php echo $zapato['imagenB'] ?>" class="pics" id="<?php echo $zapato['imagenB'] ?>">
                    <img src="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/image/<?php echo $zapato['imagenC'] ?>" class="pics" id="<?php echo $zapato['imagenC'] ?>">
                    <img src="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/image/<?php echo $zapato['imagenD'] ?>" class="pics" id="<?php echo $zapato['imagenD'] ?>">
                </div>
                <div class="anuncio-der">  
                    <h2><?php echo $zapato['Modelo'] ?></h2>
                    <p><?php echo "$".$zapato['PrecioVenta'] ?></p> 
                    <p><?php echo $zapato['NumeroDisp'] ?> MX </p>
                    <form class="formulario" method="POST" action="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/zapato2.php?b=1">
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
