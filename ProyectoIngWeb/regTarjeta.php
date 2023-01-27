<?php
    include "includes/templates/header_registro.php";
    require 'includes/funciones.php';
    require 'conexionBD/connection.php';
    $mysql = new connection();
    $conexion = $mysql->get_connection();
    $statement = $conexion->prepare('CALL ingresarTarjeta(?,?,?,?,?,?)');
    $NumeroTarjeta = '';
	$CVC = '';
    $FechaVenc = '';
    $NombreTarjeta = '';
    $ApPatTarjeta = '';
    $ApMatTarjeta = '';
    
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

        //Verificar si el correo electrónico ya existe en la base de datos
        $consulta = "SELECT * FROM cliente WHERE CorreoE = '".$CorreoE."';";
        $resultado = mysqli_query($conexion,$consulta);
        
        //Posibles errores al registrar un usuario
        //Verifica que haya al menos una fila en el resultado de la consulta
        if($resultado->num_rows){
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
      
        $consulta = "SELECT MAX(ID_Cliente) AS ID_Max FROM cliente";
        $resultado = mysqli_query($conexion,$consulta);
        $id_res = mysqli_fetch_assoc($resultado);
        $id_Cliente = $id_res['ID_Max']+1;
        $Contrasenia = password_hash($_POST['Contraseniaf'],PASSWORD_BCRYPT);
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
          $statement->execute(); 
          $statement->close();
          $conexion->close();

          session_start();
          $_SESSION['CorreoE'] = $CorreoE;
          $_SESSION['login'] = true;

          header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/productos.php?res=1?id='.strval($id_Cliente));
          //res=1 Si se llevo exitosamente el registro del nuevo cliente
        }
    }
      
?>
    <hr>
        <section id="#crear">
            <h1>
                ¡Regístrate!
            </h1>
            <div class="contenedor">
                <!-- Código para ver errores en el registro -->
            <?php foreach($errores as $error): ?>
                <div class = "alerta error"> <!-- ...error-->
                    <?php echo '*'.$error; ?>
                </div>
            <?php endforeach; ?>  

            <form class="formulario" method="POST" action="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/registro.php">
                <div class="campo">
                <label class="label">Numero de Tarjeta</label>
                <input class="field" type="text" name="NumeroTarjeta" placeholder="0000 0000 0000 0000" value="<?php echo $NumeroTarjeta?>" required>
            </div>
            <div class="campo">
                <label class="label">CVC</label>
                <input class="field" type="text" name="CVC" placeholder="123" value="<?php echo $CVC?>" required>
            </div>
            <div class="campo">
                <label class="label">Fecha de Vencimiento</label>
                <input class="field" type="text" name="FechaVenc" placeholder="MM/AA" value="<?php echo $FechaVenc?>" required>
            </div>
            <div class="campo">
                <label class="label">Nombre del titular</label>
                <input class="field" type="text" name="NombreTarjeta" placeholder="Nombre" value="<?php echo $NombreTarjeta?>" required>
            </div>
            <div class="campo">
                <label class="label">Apellido Paterno del titular</label>
                <input class="field" type="text" name="ApPatTarjeta" placeholder="Apellido Paterno" value="<?php echo $ApPatTarjeta?>" required>
            </div>
            <div class="campo">
                <label class="label">Apellido Materno del titular</label>
                <input class="field" type="text" name="ApMatTarjeta" placeholder="Apellido Materno" value="<?php echo $ApMatTarjeta?>" required>
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