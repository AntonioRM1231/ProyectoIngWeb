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
    
    $NombreUsuario = '';
    $Nombre = '';
    $ApPaterno = '';
    $ApMaterno = '';
    $NumTelefono = '';
    $NumeroTarjeta = '';

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
    $NombreUsuario = $cliente['NombreUsuario'];
    $Nombre = $cliente['Nombre'];
    $ApPaterno = $cliente['ApPaterno'];
    $ApMaterno = $cliente['ApMaterno'];
    $NumTelefono = $cliente['NumTelefono'];
    $NumeroTarjeta = $cliente['NumeroTarjeta'];

    //Consulta datos del zapato
    $consulta = "SELECT * FROM zapato WHERE ID_Zapato = '".$ID_Zapato."';";
    $resultado = mysqli_query($conexion,$consulta);
    $zapato = mysqli_fetch_assoc($resultado);
    $ColorZ = $zapato['Color'];
    $NumZ = $zapato['NumeroDisp'];
    $MarcaZ = $zapato['Marca'];
    $ModeloZ = $zapato['Modelo'];
    $PrecioZ = $zapato['PrecioVenta'];

    //Consulta Domicilio
    $consulta = "SELECT * FROM direccion WHERE ID_Direccion = '".$ID_Direccion."';";
    $resultado = mysqli_query($conexion,$consulta);
    $direccion = mysqli_fetch_assoc($resultado);
    $Calle = $direccion['Calle'];
    $NumExt = $direccion['NumExt'];
    $NumInt = $direccion['NumInt'];
    $CP = $direccion['CP'];
    $COLONIA = $direccion['COLONIA'];
    $Municipio = $direccion['Municipio'];  
    $Estado = $direccion['Estado'];

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
                Datos sobre tu pedido
            </h1>
            <div class="contenedor">
                <!-- Código para ver errores en el registro -->
            <?php foreach($errores as $error): ?>
                <div class = "alerta error"> <!-- ...error-->
                    <?php echo '*'.$error; ?>
                </div>
            <?php endforeach; ?>  

            <form class="formulario" method="POST" action="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/regDireccion.php">
            <h2>
                ========================== Cliente ==========================
            </h2>
            <div class="campo">
                <label class="label">Correo Electrónico</label>
                <input class="field" type="text" value="<?php echo $CorreoE?>" readonly>
            </div>
            <div class="campo">
                <label class="label">Nombre de Usuario</label>
                <input class="field" type="text" value="<?php echo $NombreUsuario?>" readonly>
            </div>
            <div class="campo">
                <label class="label">Nombre</label>
                <input class="field" type="text" value="<?php echo $Nombre?>" readonly>
            </div>
            <div class="campo">
                <label class="label">Apellido Paterno</label>
                <input class="field" type="text" value="<?php echo $ApPaterno?>" readonly>
            </div>
            <div class="campo">
                <label class="label">Apellido Materno</label>
                <input class="field" type="text" value="<?php echo $ApMaterno?>" readonly>
            </div>
            <div class="campo"> 
                <label class="label">NumTelefono</label>
                <input class="field" type="text" value="<?php echo $NumTelefono?>" readonly>
            </div>
            <h2>
                ========================== Zapato ==========================
            </h2>
            <div class="campo">
                <label class="label">Marca</label>
                <input class="field" type="text" value="<?php echo $MarcaZ?>" readonly>
            </div>
            <div class="campo">
                <label class="label">Modelo</label>
                <input class="field" type="text" value="<?php echo $ModeloZ?>" readonly>
            </div>
            <div class="campo">
                <label class="label">Color</label>
                <input class="field" type="text" value="<?php echo $ColorZ?>" readonly>
            </div>
            <div class="campo">
                <label class="label">Número</label>
                <input class="field" type="text" value="<?php echo $NumZ?>" readonly>
            </div>
            <div class="campo">
                <label class="label">Precio</label>
                <input class="field" type="text" value="<?php echo $PrecioZ?>" readonly>
            </div>
            <h2>
                ========================= Domicilio =========================
            </h2>
            <div class="campo">
                <label class="label">Calle</label>
                <input class="field" type="text" value="<?php echo $Calle?>" readonly>
            </div>
            <div class="campo">
                <label class="label">Num Exterior </label>
                <input class="field" type="text" value="<?php echo $NumExt?>" readonly>
            </div>
            <div class="campo">
                <label class="label">Num Interior </label>
                <input class="field" type="text" value="<?php echo $NumInt?>" readonly>
            </div>
            <div class="campo">
                <label class="label">CP</label>
                <input class="field" type="number" value="<?php echo $CP?>" readonly>
            </div>
            <div class="campo"> 
                <label class="label">Colonia </label>
                <input class="field" type="text" value="<?php echo $COLONIA?>" readonly>
            </div>
            <div class="campo">
                <label class="label">Municipio</label>
                <input class="field" type="text" value="<?php echo $Municipio?>" readonly>
            </div>
            <div class="campo">   
                <label class="label">Estado</label>
                <input class="field" type="text" value="<?php echo $Estado?>" readonly>
            </div>

            <div class="campo">
                <input type="submit" value="Confirmar pedido" class="boton-marron">
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