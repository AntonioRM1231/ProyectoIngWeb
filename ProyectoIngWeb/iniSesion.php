<?php
      require 'includes/funciones.php';
      require 'Cliente.php';
      require 'conexionBD/connection.php';
      incluirTemplate('header_registro');
      $mysql = new connection();
      $conexion = $mysql->get_connection();
      $correo = '';  

      //Arreglo con mensajes de errores
      $erroresIS = [];
      //Ejecutar el código después de que el usuario envie el formulario
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Posibles errores en el inicio de sesión
        if(!$_POST['CorreoEIS']){
          $erroresIS[] = 'El correo electrónico es obligatorio';
        }
        if(!$_POST['ContraseniaIS']){
          $erroresIS[] = 'La contraseña es obligatoria';
        }
        /**
         * Para iniciar sesión y verificar que el usuario exista, en caso de que sí, 
         * revisa si la contraseña es correcta
         */
        $correo = filter_var($_POST['CorreoEIS'],FILTER_SANITIZE_EMAIL);
        $consulta = "SELECT CorreoE, Contrasenia FROM cliente WHERE CorreoE = '".$correo."';";
        $resultado = mysqli_query($conexion,$consulta);
        if($resultado->num_rows){
          $cliente = mysqli_fetch_assoc($resultado);
          //Verificamos que la contraseña sea la correcta
          $verificación = password_verify($_POST['ContraseniaIS'],$cliente['Contrasenia']);
          if($verificación){
            $consulta = "SELECT ID_Cliente FROM cliente WHERE CorreoE = '".$correo."';";
            $resultado = mysqli_query($conexion,$consulta);
            $id_res = mysqli_fetch_assoc($resultado);
            $id_Cliente = $id_res['ID_Cliente'];
            $conexion->close();

            session_start();
            $_SESSION['CorreoE'] = $correo;
            $_SESSION['login'] = true;
            echo "<pre>";
              var_dump($_SESSION);   
            echo "</pre>";
            $consulta = "SELECT NumeroTarjeta FROM cliente WHERE CorreoE = '".$correo."';";
            $resultado = mysqli_query($conexion,$consulta);
            $NumeroTarjeta = $resultado['NumeroTarjeta'];
            if($NumeroTarjeta == NULL){
              //No tiene una tarjeta vinculada a su cuenta, etonces debe registrar una
              header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/regTarjeta.php');
            }else{
              //Ya tiene una tarjeta vinculada, por la tanto, ya no se le pide una nueva, y se 
              //le pide su dirección 
              header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/regDireccion.php');
            }
          }else{
            $erroresIS[] = "La contraseña es incorrecta, por favor intente de nuevo";
          }
        }else{
          $erroresIS[] = "El usuario no existe, por favor intente nuevamente";
        }
        //var_dump($erroresIS);
      }
      
?>
    <hr>
        <section id="#crear">
            <h1>
                Iniciar Sesión
            </h1>
            <div class="contenedor">
            <!-- Código para ver errores en el inicio de sesión -->
            <?php foreach($erroresIS as $error): ?>
                <div class = "alerta error"> <!-- ...error-->
                    <?php echo '*'.$error; ?>
                </div>
            <?php endforeach; ?> 

            <form class="formulario" method="POST" action="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/iniSesion.php">
                <div class="campo">
                    <label  class="label" for="email">Correo Electrónico </label>
                    <input  class="field" type="email" id="email" name="CorreoEIS" placeholder="email@ejemplo.com" value="<?php echo $correo?>" required>
                </div>
                <div class="campo">
                    <label class="label" for="password">Contraseña </label>
                    <input class="field" type="password" id="password" name="ContraseniaIS" placeholder="**********" required>
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
