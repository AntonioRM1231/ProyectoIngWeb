<?php
    include "includes/templates/header_cat.php";
    require 'includes/funciones.php';
    require 'conexionBD/connection.php';

    $auth = estaAutenticado();
    if(!$auth){
        header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/index.php');
    }

    $mysql = new connection();
    $conexion = $mysql->get_connection();
    $CorreoE = $_SESSION['CorreoE'];
    $NombreUsuario = '';
    $Nombre = '';
    $ApPaterno = '';
    $ApMaterno = '';
    $Edad = '';
    $NumTelefono = '';
    
    //Consulta datos del cliente
    $consulta = "SELECT * FROM cliente WHERE CorreoE = '".$CorreoE."';";
    $resultado = mysqli_query($conexion,$consulta);
    $cliente = mysqli_fetch_assoc($resultado);

    $NombreUsuario = $cliente['NombreUsuario'];
    $Nombre = $cliente['Nombre'];
    $ApPaterno = $cliente['ApPaterno'];
    $ApMaterno = $cliente['ApMaterno'];
    $Edad = $cliente['Edad'];
    $NumTelefono = $cliente['NumTelefono'];

    //Ejecutar el código después de que el usuario envie el formulario
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/editarPerfil.php');
    }
      
?>
        <section id="#crear">
            <h1>
                Información sobre tu perfil
            </h1>
        <div class="contenedor">   
            <form class="formulario" method="POST" action="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/verPerfil.php">
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
                <label class="label">Edad</label>
                <input class="field" type="text" value="<?php echo $Edad?>" readonly>
            </div>
            <div class="campo"> 
                <label class="label">NumTelefono</label>
                <input class="field" type="text" value="<?php echo $NumTelefono?>" readonly>
            </div>
            <div class="campo">
                <input type="submit" value="Editar Perfil" class="boton-marron">
            </div>
          </form>
        </div>
        </section>
        <?php
        include "includes/templates/footer.php";
        ?>