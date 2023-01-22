   <?php
      require 'includes/funciones.php';
      require 'Cliente.php';
      require 'conexionBD/connection.php';
      incluirTemplate('header');
      echo 'Hola 1';
      $mysql = new connection();
      echo 'Hola 1';
      $conexion = $mysql->get_connection();
      echo 'Hola 1';
      $statement = $conexion->prepare('CALL ingresarClienteST(?,?,?,?,?,?,?,?,?)');
      echo 'Hola 1';
      $CorreoE = '';
      $NombreUsuario = '';
      $Contrasenia = '';
      $Nombre = '';
      $ApPaterno = '';
      $ApMaterno = '';
      $Edad = '';
      $NumTelefono = '';

      //Arreglo con mensajes de errores
      $errores = [];
      
      //Ejecutar el código después de que el usuario envie el formulario
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $CorreoE = filter_var($_POST['CorreoEf'],FILTER_SANITIZE_EMAIL);
        $NombreUsuario = $_POST['NombreUsuariof'];
        $Contrasenia = $_POST['Contraseniaf'];
        $Nombre = strtoupper(filter_var($_POST['Nombref'],FILTER_SANITIZE_STRING));
        $ApPaterno = strtoupper(filter_var($_POST['ApPaternof'],FILTER_SANITIZE_STRING));
        $ApMaterno = strtoupper(filter_var($_POST['ApMaternof'],FILTER_SANITIZE_STRING));
        $Edad = $_POST['Edadf'];
        $NumTelefono = filter_var($_POST['NumTelefonof'],FILTER_SANITIZE_NUMBER_INT);
        echo "<pre>";
          var_dump($_POST);
        echo "</pre>";
        //Verificar si el correo electrónico ya existe en la base de datos
        $consulta = "SELECT * FROM cliente WHERE CorreoE = '".$CorreoE."';";
        $resultado = mysqli_query($conexion,$consulta);
        $cliente_res = mysqli_fetch_assoc($resultado);
        //Posibles errores al registrar un usuario
        if(!empty($cliente_res)){
          $errores[] = 'El correo electrónico con el que desea registrarse ya se ha asignado a otra cuenta';
        }
        if(!$_POST['CorreoEf']){
          $errores[] = 'El correo electrónico es obligatorio';
        }
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
        if(!$_POST['Contraseniaf']){
          $errores[] = 'La contraseña es obligatoria';
        }

        $mayus = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $contMayus = 0;
        for($i = 0; $i<strlen($mayus); $i++){
          if(str_contains($_POST['Contraseniaf'],substr($mayus,$i,1))) {
            $contMayus++;
          }
        }
        if($contMayus == 0){
          $errores[] = 'La contraseña debe incluir al menos una mayúscula';  
        }

        $nums = "0123456789";
        $contNums = 0;
        for($i = 0; $i<strlen($nums); $i++){
          if(str_contains($_POST['Contraseniaf'],substr($nums,$i,1))) {
            $contNums++;
          }
        }
        if($contNums == 0){
          $errores[] = 'La contraseña debe incluir al menos un número';  
        }

        $cEsp = "!#$%&/()=?¡¿[]{}_";
        $contEsp = 0;
        for($i = 0; $i<strlen($cEsp); $i++){
          if(str_contains($_POST['Contraseniaf'],substr($cEsp,$i,1))) {
            $contEsp++;
          }
        }
        if($contEsp == 0){
          $errores[] = 'La contraseña debe incluir al menos un caracter especial';  
        }
        

        if(strlen($_POST['Contraseniaf']) < 8){
          $errores[] = 'La contraseña debe tener una longitud mínima de 8';
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
      /*
        echo "<pre>";
          var_dump($errores);
        echo "</pre>";*/
        $consulta = "SELECT MAX(ID_Cliente) AS ID_Max FROM cliente";
        $resultado = mysqli_query($conexion,$consulta);
        $id_res = mysqli_fetch_assoc($resultado);
        $id_Cliente = $id_res['ID_Max']+1;
        if(empty($errores)){
          $statement->bind_param('ssssssisi',  
            $CorreoE,
            $NombreUsuario,
            $Contrasenia,
            $Nombre,
            $ApPaterno,
            $ApMaterno,
            $Edad,
            $NumTelefono,
            $id_Cliente
          );
        
          echo 'Hola 4';
          $statement->execute(); 
          echo 'Hola 4_1';
          $statement->close();
          echo 'Hola 4_2';  
          
          $conexion->close();
          echo 'Hola 5';
          
          header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/productos.php?res=1?id='.strval($id_Cliente));
          //resultado=1 Si se llevo exitosamente el registro del nuevo cliente
        }
      }
      echo 'Hola 6';        
    ?>

    <div class="offcanvas offcanvas-end" id="demo">
        <div class="offcanvas-header">
            <h1>
                Iniciar sesión
            </h1>
            <button class="btn-close" type="button" data-bs-dismiss="offcanvas"></button>  
        </div>
        <div class="offcanvas-body">
          <form class="formulario">
            <div class="campo">
                <label  class="label" for="email">CORREO ELECTRONICO</label>
                <input  class="field" type="email" id="email">
            </div>
            <div class="campo">
                <label class="label" for="password">CONTRASEÑA</label>
                <input class="field" type="password" id="password">
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
                <input class="field" type="email" name="CorreoEf" placeholder="email@ejemplo.com" value="<?php echo $CorreoE?>">
            </div>
            <div class="campo">
                <label class="label">Nombre de Usuario</label>
                <input class="field" type="text" name="NombreUsuariof" placeholder="Usuario" value="<?php echo $NombreUsuario?>">
            </div>
            <div class="campo">
                <label class="label">Contraseña</label>
                <input class="field" type="password" name="Contraseniaf" placeholder="**********" value="<?php echo $Contrasenia?>">
            </div>
            <div class="campo">
                <label class="label">Nombre</label>
                <input class="field" type="text" name="Nombref" placeholder="Nombre" value="<?php echo $Nombre?>">
            </div>
            <div class="campo">
                <label class="label">Apellido Paterno</label>
                <input class="field" type="text" name="ApPaternof" placeholder="Apellido Paterno" value="<?php echo $ApPaterno?>">
            </div>
            <div class="campo">
                <label class="label">Apellido Materno</label>
                <input class="field" type="text" name="ApMaternof" placeholder="Apellido Materno" value="<?php echo $ApMaterno?>">
            </div>
            <div class="campo">
                <label class="label">Edad</label>
                <input class="field" type="number" name="Edadf" placeholder="00" min="0" value="<?php echo $Edad?>">
            </div>
            <div class="campo">
                <label class="label">NumTelefono</label>
                <input class="field" type="text" name="NumTelefonof" minlength="10" placeholder="1234567890" value="<?php echo $NumTelefono?>">
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
    <script src="build/js/app.js"></script>
</body>
</html>