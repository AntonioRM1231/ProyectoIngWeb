<?php
    include "includes/templates/header_registro.php";
    require 'includes/funciones.php';
    require 'conexionBD/connection.php';
    $mysql = new connection();
    $conexion = $mysql->get_connection();
    $ID_Direccion = $_GET['dir'];
    
    $ID_Zapato = $_SESSION['ID_Zapato'];
    $CorreoE = $_SESSION['CorreoE'];
    $ID_Pedido = '';
    $FechaPedido = '';
    
    $NombreUC = '';
    $NombreC = '';
    $ApPatC = '';
    $ApMatC = '';
    $NumTelC = '';
    $NumTarjeta = '';

    $ColorZ = '';
    $NumZ = '';
    $MarcaZ = '';
    $ModeloZ = '';
    $PrecioZ = '';

    $Calle = '';
    $NumExt = '';
    $NumInt = '';  
    $CP = '';
    $COLONIA = '';
    $Municipio = '';
    $Estado = '';

    //Consulta datos del cliente
    $consulta = "SELECT * FROM cliente WHERE CorreoE = '".$CorreoE."';";
    $resultado = mysqli_query($conexion,$consulta);
    $cliente = mysqli_fetch_assoc($resultado);
    $NombreUC = $cliente['NombreUsuario'];
    $NombreC = $cliente['Nombre'];
    $ApPatC = $cliente['ApPaterno'];
    $ApMatC = $cliente['ApMaterno'];
    $NumTelC = $cliente['NumTelefono'];
    $NumTarjeta = $cliente['NumeroTarjeta'];

    //Consulta datos del zapato
    $consulta = "SELECT * FROM zapato WHERE CorreoE = '".$ID_Zapato."';";
    $resultado = mysqli_query($conexion,$consulta);
    $cliente = mysqli_fetch_assoc($resultado);


    //Consulta Domicilio




    //Ejecutar el código después de que el usuario envie el formulario
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        
        $statement = $conexion->prepare('CALL ingresarDireccion(?,?,?,?,?,?,?)');
        $statement->bind_param('sssisss',  
        $Calle,
        $NumExt,
        $NumInt,
        $CP,
        $COLONIA,
        $Municipio,
        $Estado
        );
        $statement->execute(); 
        $statement->close();

        $consulta = "SELECT MAX(ID_Direccion) AS ID_Dir FROM direccion";  
        $resultado = mysqli_query($conexion,$consulta);
        $id_res = mysqli_fetch_assoc($resultado);
        $ID_Dir = $id_res['ID_Dir'];
        $conexion->close();
        header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/infoPedido.php?dir='.strval($ID_Dir));
        
    }
      
?>
    <hr>
        <section id="#crear">
            <h1>
                Ingresa los datos de la dirección a donde será enviado tu pedido
            </h1>
            <div class="contenedor">
                <!-- Código para ver errores en el registro -->
            <?php foreach($errores as $error): ?>
                <div class = "alerta error"> <!-- ...error-->
                    <?php echo '*'.$error; ?>
                </div>
            <?php endforeach; ?>  

            <form class="formulario" method="POST" action="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/regDireccion.php">
            <div class="campo">
                <label class="label">Calle</label>
                <input class="field" type="text" name="Calle" placeholder="Nombre de la Calle" value="<?php echo $Calle?>" required>
            </div>
            <div class="campo">
                <label class="label">Num Exterior </label>
                <input class="field" type="text" name="NumExt" placeholder="Número Exterior" value="<?php echo $NumExt?>" required>
            </div>
            <div class="campo">
                <label class="label">Num Interior </label>
                <input class="field" type="text" name="NumInt" placeholder="Número Interior" value="<?php echo $NumInt?>">
            </div>
            <div class="campo">
                <label class="label">CP</label>
                <input class="field" type="number" name="CP" placeholder="Código Postal" value="<?php echo $CP?>" required>
            </div>
            <div class="campo"> 
                <label class="label">Colonia </label>
                <input class="field" type="text" name="COLONIA" placeholder="Colonia" value="<?php echo $COLONIA?>" required>
            </div>
            <div class="campo">
                <label class="label">Municipio</label>
                <input class="field" type="text" name="Municipio" placeholder="Municipio" value="<?php echo $Municipio?>" required>
            </div>
            <div class="campo"> 
                <label class="label">Estado</label>
                <input class="field" type="text" name="Estado" placeholder="Estado" value="<?php echo $Estado?>" required>
            </div>
            <div class="campo">
                <input type="submit" value="Enviar" class="boton-marron">
            </div>
          </form>
            </div>
        </section>
    <hr>
        <footer  class="site-footer">
            <p><b>CUIDADO CON EL MICHI</b></p>
            <p>TODOS LOS DERECHOS RESERVADOS</p>
        </footer>
        <script src="build/js/app.js"></script>
    </body>
</html>