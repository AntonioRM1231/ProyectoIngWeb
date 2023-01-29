<?php
    include "includes/templates/header_registro.php";
    require 'includes/funciones.php';
    require 'conexionBD/connection.php';
    $mysql = new connection();
    $conexion = $mysql->get_connection();
    
    $CorreoE = $_SESSION['CorreoE'];

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

    //Arreglo con mensajes de errores
    $errores = [];

    //Ejecutar el código después de que el usuario envie el formulario
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $NombreUsuario = $_POST['NombreUsuariof'];
        $Nombre = strtoupper(filter_var($_POST['Nombref'],FILTER_SANITIZE_STRING));
        $ApPaterno = strtoupper(filter_var($_POST['ApPaternof'],FILTER_SANITIZE_STRING));
        $ApMaterno = strtoupper(filter_var($_POST['ApMaternof'],FILTER_SANITIZE_STRING));
        $Edad = $_POST['Edadf'];
        $NumTelefono = filter_var($_POST['NumTelefonof'],FILTER_SANITIZE_NUMBER_INT);
        
        if(!$_POST['NombreUsuariof']){
          $errores[] = 'El nombre de usuario es obligatorio';
        }
        if(strlen($_POST['NombreUsuariof']) < 5 || strlen($_POST['NombreUsuariof']) > 50){
          $errores[] = 'El nombre de usuario debe tener mínimo 5 caracteres y máximo 50';
        }
        $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_";
        for ($i=0; $i<strlen($_POST['NombreUsuariof']); $i++){
          if (strpos($permitidos, substr($_POST['NombreUsuariof'],$i,1)) === false){
            $errores[] = 'El nombre de usuario no permite caracteres especiales'; 
            break; 
          }
        }
        if(!$_POST['Nombref']){
          $errores[] = 'El nombre es obligatorio';
        }
        if(!$_POST['ApPaternof']){
          $errores[] = 'El apellido paterno es obligatorio';
        }
        if(!$_POST['ApMaternof']){
          $errores[] = 'El apellido materno es obligatorio';
        }
        if(!$_POST['Edadf']){
          $errores[] = 'La edad es obligatoria';
        }
        if(!$_POST['NumTelefonof']){
          $errores[] = 'El número telefónico es obligatorio';
        } 
        //Fin de los posibles errores      
      
        if(empty($errores)){
          $statement = $conexion->prepare('CALL editarCliente(?,?,?,?,?,?,?)');
          $statement->bind_param('sssssis',  
            $CorreoE,
            $NombreUsuario,
            $Nombre,
            $ApPaterno,
            $ApMaterno,
            $Edad,
            $NumTelefono
          );
          $statement->execute(); 
          $statement->close();
          $conexion->close();

          header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/index.php');
        }
    }
      
?>
    <hr>
        <section id="#crear">
            <h1>
                Editar Perfil
            </h1>
            <div class="contenedor">
                <!-- Código para ver errores en el registro -->
            <?php foreach($errores as $error): ?>
                <div class = "alerta error"> 
                    <?php echo '*'.$error; ?>
                </div>
            <?php endforeach; ?>  

            <form class="formulario" method="POST" action="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/editarPerfil.php">
            <div class="campo">
                <label class="label">Nombre de Usuario</label>
                <input class="field" type="text" name="NombreUsuariof" value="<?php echo $NombreUsuario?>" required>
            </div>
            <div class="campo">
                <label class="label">Nombre</label>
                <input class="field" type="text" name="Nombref" value="<?php echo $Nombre?>" required>
            </div>
            <div class="campo">
                <label class="label">Apellido Paterno</label>
                <input class="field" type="text" name="ApPaternof" value="<?php echo $ApPaterno?>" required>
            </div>
            <div class="campo">
                <label class="label">Apellido Materno</label>
                <input class="field" type="text" name="ApMaternof" value="<?php echo $ApMaterno?>" required>
            </div>
            <div class="campo">
                <label class="label">Edad</label>
                <input class="field" type="number" name="Edadf" min="0" value="<?php echo $Edad?>" required>
            </div>
            <div class="campo"> 
                <label class="label">NumTelefono</label>
                <input class="field" type="text" name="NumTelefonof" minlength="10" value="<?php echo $NumTelefono?>" required>
            </div>
            <div class="campo">
                <input type="submit" value="Confirmar cambios" class="boton-marron">
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