<?php
      require '../includes/funciones.php';
      //require 'Cliente.php';
      require '../conexionBD/connection.php';
      include "../includes/templates/header_registro.php";
      //incluirTemplate('header');
      $mysql = new connection();
      $conexion = $mysql->get_connection();
      $statement = $conexion->prepare('CALL ingresarAdmin(?,?)');

      //Este codigo es solo para si aún no hay un administrador registrado en el sistema
      $consulta = "SELECT * FROM administrador;";
      $resultado = mysqli_query($conexion,$consulta);
      if(!$resultado->num_rows){
        echo "<br>";
        echo "no hay results";
        $primerAdmin = 'yoSoyAdminUwU';
        $primerContrasenia = 'anahi123#admin';
        $primerContrasenia = password_hash($primerContrasenia,PASSWORD_BCRYPT);
        $consulta = "INSERT INTO administrador (UsuarioAdmin, ContraseniaAdmin) VALUES ('".$primerAdmin."','".$primerContrasenia."')";
        $resultado = mysqli_query($conexion,$consulta);
      }//Fin :D 
      // echo "Despues de verificar si no hay usuarios";
      // echo "<br>";
      $UsuarioAdmin = '';
      $ContraseniaAdmin = '';

      //Arreglo con mensajes de errores
      $errores = [];
      //Ejecutar el código después de que el usuario envie el formulario
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "Dentro del if de POST";
        echo "<br>";
        $UsuarioAdmin = $_POST['UsuarioAdmin'];
        $ContraseniaAdmin = $_POST['ContraseniaAdmin'];
        
        //Posibles errores al registrar un nuevo usuario
        //Verificar si el usuario que desea registrar ya existe en la base de datos
        $consulta = "SELECT * FROM administrador WHERE UsuarioAdmin = '".$UsuarioAdmin."';";
        $resultado = mysqli_query($conexion,$consulta);
        echo "Después de la var resutado";
        echo "<br>";
        //Verifica que haya al menos una fila en el resultado de la consulta
        if($resultado->num_rows){
          $errores[] = 'El Nombre de Usuario que desea registrar ya ha sido asignado';
        }
        if(!$_POST['UsuarioAdmin']){
          $errores[] = 'El nombre de usuario es obligatorio';
        }
        if(!$_POST['ContraseniaAdmin']){
          $errores[] = 'La contraseña es obligatoria';
        }
        if(strlen($_POST['ContraseniaAdmin']) < 8){
            $errores[] = 'La contraseña debe tener una longitud mínima de 8';
        }
        $ContraseniaAdmin = password_hash($ContraseniaAdmin,PASSWORD_BCRYPT);
        if(empty($errores)){
            echo "En el if de empty";
            echo "<br>";
            $statement->bind_param('ss',  
              $UsuarioAdmin,
              $ContraseniaAdmin
            );
            $statement->execute(); 
            echo "Después del execute";
            $statement->close();
            $conexion->close();
  
            session_start();
            $_SESSION['UsuarioAdmin'] = $UsuarioAdmin;
            $_SESSION['loginAdmin'] = true;
  
            header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/index.php');
        //var_dump($erroresIS);
        }
      }
    ?>

<hr>
        <section id="#crear">
            <h1>
                ¡Registra a un Nuevo Administrador! 
            </h1>
            <div class="contenedor">
                <!-- Código para ver errores en el registro -->
            <?php foreach($errores as $error): ?>
                <div class = "alerta error"> <!-- ...error-->
                    <?php echo '*'.$error; ?>
                </div>
            <?php endforeach; ?>  

            <form class="formulario" method="POST" action="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/registroAdmin.php"> 
            <div class="campo">
                <label class="label">Nombre de Usuario</label>
                <input class="field" type="text" name="UsuarioAdmin" placeholder="Nombre de Usuario" value="<?php echo $UsuarioAdmin?>" required>
            </div>
            <div class="campo">
                <label class="label">Contraseña</label>
                <input class="field" type="password" name="ContraseniaAdmin" placeholder="***************" required>
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