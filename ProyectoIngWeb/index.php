   <?php
      require 'includes/funciones.php';
      require 'Cliente.php';
      require 'conexionBD/connection.php';
      incluirTemplate('header');
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
            header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/productos.php?idIS='.strval($id_Cliente));
          }else{
            $erroresIS[] = "La contraseña es incorrecta, por favor intente de nuevo";
          }
        }else{
          $erroresIS[] = "El usuario no existe, por favor intente nuevamente";
        }
        //var_dump($erroresIS);
      }
    ?>

    <div class="offcanvas offcanvas-end" id="demo">
        <div class="offcanvas-header">
            <h1>
                Iniciar sesión
            </h1>
            <button class="btn-close" type="button" data-bs-dismiss="offcanvas"></button>  
        </div>
        <div class="offcanvas-body">

          <!-- Código para ver errores en el inicio de sesión -->
          <?php foreach($erroresIS as $error): ?>
            <div class = "alerta error"> <!-- ...error-->
              <?php echo '*'.$error; ?>
            </div>
          <?php endforeach; ?> 
          <form class="formulario" method="POST" action="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/index.php">
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
      </div>
      <div class="offcanvas offcanvas-end" id="demo2">
        <div class="offcanvas-header">
          <h1>
            ¡Regístrate!
          </h1>
          <button class="btn-close" type="button" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">

          <!-- Código para ver errores en el registro -->
          <?php foreach($errores as $error): ?>
            <div class = "alerta error"> <!-- ...error-->
              <?php echo '*'.$error; ?>
            </div>
          <?php endforeach; ?>  

          <form class="formulario" method="POST" action="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/index.php">
            <div class="campo">
                <label class="label">Correo Electrónico</label>
                <input class="field" type="email" name="CorreoEf" placeholder="email@ejemplo.com" value="<?php echo $CorreoE?>" required>
            </div>
            <div class="campo">
                <label class="label">Nombre de Usuario</label>
                <input class="field" type="text" name="NombreUsuariof" placeholder="Usuario" value="<?php echo $NombreUsuario?>" required>
            </div>
            <div class="campo">
                <label class="label">Contraseña</label>
                <input class="field" type="password" name="Contraseniaf" placeholder="**********" required>
            </div>
            <div class="campo">
                <label class="label">Nombre</label>
                <input class="field" type="text" name="Nombref" placeholder="Nombre" value="<?php echo $Nombre?>" required>
            </div>
            <div class="campo">
                <label class="label">Apellido Paterno</label>
                <input class="field" type="text" name="ApPaternof" placeholder="Apellido Paterno" value="<?php echo $ApPaterno?>" required>
            </div>
            <div class="campo">
                <label class="label">Apellido Materno</label>
                <input class="field" type="text" name="ApMaternof" placeholder="Apellido Materno" value="<?php echo $ApMaterno?>" required>
            </div>
            <div class="campo">
                <label class="label">Edad</label>
                <input class="field" type="number" name="Edadf" placeholder="00" min="0" value="<?php echo $Edad?>" required>
            </div>
            <div class="campo">
                <label class="label">NumTelefono</label>
                <input class="field" type="text" name="NumTelefonof" minlength="10" placeholder="1234567890" value="<?php echo $NumTelefono?>" required>
            </div>
            <div class="campo">
                <input type="submit" value="Enviar" class="boton-marron">
            </div>
          </form>
        </div>
    </div>
    <hr>
    
    <main class="contenedor">
        <h2>NUESTROS PRODUCTOS</h2>
        <section class="seccion contenedor">
          <div class="contenedor-anuncio">
              <a href="anuncio.html" class="anuncio">
                  <picture>
                      <source srcset="imagenes/forum1.png" type="image/jpg">
                      <img loading="lazy" src="imagenes/forum1.png" alt="anuncio">
                  </picture>
                  <div class="contenido-anuncio">
                      <h3>ADIDAS FORUM LOW EXHIBIT</h3>
                      <p class="precio"><b> $1,200.00</b></p>
                  </div>
              </a>
          </div>
        </section>
    </main>
    
    <hr>
    <section id="nosotros">
      <div class="contenedor-nosotros">
        <div class="img-nosotros">
          <picture>
            <source srcset="imagenes/catsnk.jpg" type="image/jpg">
            <img loading="lazy" src="imagenes/catsnk.jpg" alt="anuncio">
          </picture>
        </div>
        <div class="desc-nosotros">
          <h3>NOSOTROS</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus mauris nisl, 
            cursus feugiat sapien ac, facilisis mollis enim. Aenean bibendum urna id ante varius 
            interdum. In vulputate lacus in pulvinar suscipit. Pellentesque posuere varius 
            vestibulum. Pellentesque sapien nisl, malesuada non sapien at, mattis elementum 
            diam. Donec nisi quam, ultrices ut pharetra eget, pharetra in mauris. Nullam ullamcorper, 
            nunc ac dignissim luctus, ante massa tempor nunc, non aliquet tellus quam sed eros. Quisque gravida, 
            diam a molestie ultrices, ex neque pretium felis, a tempor diam leo sed orci. Pellentesque 
            id metus quis neque laoreet placerat. Quisque commodo, diam ac accumsan sollicitudin, 
            odio libero eleifend enim, in pretium odio felis eu elit.</p>
        </div>
      </div>
    </section>
    <hr>
    <footer  class="site-footer">
        <p><b>CUIDADO CON EL MICHI</b></p>
        <p>TODOS LOS DERECHOS RESERVADOS</p>
    </footer>
    <script src="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/build/js/app.js"></script>
</body>
</html>