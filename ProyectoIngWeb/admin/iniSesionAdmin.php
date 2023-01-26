<?php
    include "../includes/templates/header_admin.php";
    require '../includes/funciones.php';
    require '../conexionBD/connection.php';
    $mysql = new connection();
    $conexion = $mysql->get_connection();


    $contraseniaAdmin = password_hash($_POST['Contraseniaf'],PASSWORD_BCRYPT);
    $usuario = '';
    //Arreglo con mensajes de errores
    $errores = [];

    //Ejecutar el código después de que el usuario envie el formulario
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(!$_POST['UsuarioAdmin']){
          $errores[] = 'El nombre de usuario es obligatorio';
        }
        if(!$_POST['ContraseniaAdmin']){
          $errores[] = 'La contraseña es obligatoria';
        }

        //******************************** */
        $usuario = $_POST['UsuarioAdmin'];
        $consulta = "SELECT * FROM administrador WHERE UsuarioAdmin = '".$usuario."';";
        $resultado = mysqli_query($conexion,$consulta);
        if($resultado->num_rows){
          $admin = mysqli_fetch_assoc($resultado);
          //Verificamos que la contraseña sea la correcta
          $verificación = password_verify($_POST['ContraseniaAdmin'],$admin['ContraseniaAdmin']);
          if($verificación){
            $conexion->close();

            session_start();
            $_SESSION['UsuarioAdmin'] = $usuario;
            $_SESSION['loginAdmin'] = true;
            // echo "<pre>";
            //  var_dump($_SESSION);
            // echo "</pre>";

            header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/index.php');
          }else{
            $errores[] = "La contraseña es incorrecta, por favor intente de nuevo";
          }
        }else{
          $errores[] = "El usuario no existe, por favor intente nuevamente";
        }
        //******************************** */  
    }
    
      
?>
    <hr>
        <section id="#crear">
            <h1>
                Iniciar Sesión
            </h1>
            <div class="contenedor">
                <!-- Código para ver errores en el registro -->
            <?php foreach($errores as $error): ?>
                <div class = "alerta error"> <!-- ...error-->
                    <?php echo '*'.$error; ?>
                </div>
            <?php endforeach; ?>  

            <form class="formulario" method="POST" action="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/iniSesionAdmin.php">
            <div class="campo">
                <label class="label">Nombre de Usuario</label>
                <input class="field" type="text" name="UsuarioAdmin" placeholder="Usuario" value="<?php echo $usuario?>" required>
            </div>
            <div class="campo">
                <label class="label">Contraseña</label>
                <input class="field" type="password" name="ContraseniaAdmin" placeholder="**********" required>
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




    