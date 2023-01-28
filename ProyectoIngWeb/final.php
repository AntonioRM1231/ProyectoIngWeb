<?php
    require 'includes/funciones.php';
    require 'conexionBD/connection.php';
    include "includes/templates/header_cat.php";
    //******************************************************/
    $auth = estaAutenticado();
    
    /*
    if(!$auth){
        // echo 'dentro del if';
        header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/index.php');
    }*/
    //******************************************************/

    $ID_Pedido = $_GET['id'];
    $ID_Pedido = filter_var($ID_Pedido,FILTER_VALIDATE_INT);

    $mysql = new connection();
    $conexion = $mysql->get_connection();
    $consulta = "SELECT * FROM pedido WHERE ID_Pedido = ".strval($ID_Pedido).";";  
    $resultado = mysqli_query($conexion,$consulta);
    $pedido = mysqli_fetch_assoc($resultado);
    $ID_Pedido = $pedido['ID_Pedido'];
    $ID_Zapato = $pedido['ID_Zapato'];
    $ID_Direccion = $pedido['ID_Direccion'];
    $CorreoE = $pedido['CorreoE'];
    $FechaPedido = $pedido['FechaPedido'];
    $conexion->close();

?>
        <main class="contenedor">
            
                <div class="alerta exito">
                    <h2>¡Muchas Gracias por su compra!</h2>
                    <h2>
                        Informacion sobre su pedido
                    </h2>
                    <h3>
                        ID de pedido: <?php echo $ID_Pedido ?>
                    </h3>
                    <h3>
                        Correo electrónico: <?php echo $CorreoE ?>
                    </h3>
                    <h3>
                        ID de zapato: <?php echo $ID_Zapato ?>
                    </h3>
                    <h3>
                        ID de dirección: <?php echo $ID_Direccion ?>
                    </h3>
                    <h3>
                        Fecha: <?php echo $FechaPedido ?>
                    </h3>
                    <br>
                    <br>
                    <h4>
                        En breve le enviaremos un correo con la información sobre el envio :)
                    </h4>
                </div>  
            
        </main>
        <?php 
            include "includes/templates/footer.php"; 
        ?>