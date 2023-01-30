<?php
    include "includes/templates/header_registro.php";
    require 'includes/funciones.php';
    require 'conexionBD/connection.php';

    $auth = estaAutenticado();
    if(!$auth){
        header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/index.php');
    }

    $mysql = new connection();
    $conexion = $mysql->get_connection();
    $band = 0;
    $band = $_GET['band'] ?? 0;
    if($band == 1){
        $ID_Direccion = $_GET['dir'];
        $_SESSION['ID_Direccion'] = $ID_Direccion;
    }else if($band == 0){
        $ID_Direccion = $_SESSION['ID_Direccion'];
    }
    
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
    $CategoriaZ = '';

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
    $CategoriaZ = $zapato['Categoria'];
    $imagenA = $zapato['imagenA'];

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

        $statement = $conexion->prepare('CALL ingresarPedido(?,?,?)');
        $statement->bind_param('iis',  
            $ID_Zapato,
            $ID_Direccion,
            $CorreoE
        );
        $statement->execute(); 
        $statement->close();

        $statement = $conexion->prepare('CALL actualizarStock(?)');
        $statement->bind_param('i',  
            $ID_Zapato
        );
        $statement->execute(); 
        $statement->close();

        $consulta = "SELECT MAX(ID_Pedido) AS ID_Ped FROM pedido";  
        $resultado = mysqli_query($conexion,$consulta);
        $id_ped = mysqli_fetch_assoc($resultado);
        $ID_Pedido = $id_ped['ID_Ped'];
        $conexion->close();
        header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/final.php?id='.strval($ID_Pedido));
    }
      
?>
    <hr>
        <section id="#crear">
            <h1>
                Datos sobre tu pedido
            </h1>
            <div class="contenedor">
            <form class="formulario" method="POST" action="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/infoPedido.php">
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
                <label class="label">Categoría</label>   
                <input class="field" type="text" value="<?php echo $CategoriaZ?>" readonly>
            </div>
            <div class="campo">
                <label class="label">Precio</label>
                <input class="field" type="text" value="<?php echo $PrecioZ?>" readonly>
            </div>
            <div class="pedido-img">
                <img src="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/image/<?php echo $imagenA ?>" class="imagen-zapato">
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
        <?php
        include "includes/templates/footer.php";
        ?>
</html>