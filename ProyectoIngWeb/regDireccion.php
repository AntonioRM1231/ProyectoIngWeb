<?php
    include "includes/templates/header_registro.php";
    require 'includes/funciones.php';
    require 'conexionBD/connection.php';
    $mysql = new connection();
    $conexion = $mysql->get_connection();
    $Calle = '';
	  $NumExt = '';
    $NumInt = '';
    $CP = '';
    $COLONIA = '';
    $Municipio = '';
    $Estado = '';

    //Arreglo con mensajes de errores
    $errores = [];

    //Ejecutar el código después de que el usuario envie el formulario
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $Calle = strtoupper(filter_var($_POST['Calle'],FILTER_SANITIZE_STRING));
        $NumExt = strtoupper(filter_var($_POST['NumExt'],FILTER_SANITIZE_STRING));
        $NumInt = strtoupper(filter_var($_POST['NumInt'],FILTER_SANITIZE_STRING));
        $CP = filter_var($_POST['CP'],FILTER_SANITIZE_NUMBER_INT);
        $COLONIA = strtoupper(filter_var($_POST['COLONIA'],FILTER_SANITIZE_STRING));
        $Municipio = strtoupper(filter_var($_POST['Municipio'],FILTER_SANITIZE_STRING));
        $Estado = strtoupper(filter_var($_POST['Estado'],FILTER_SANITIZE_STRING));

        //Posibles errores al registrar una dirección
        if(!$_POST['Calle']){
          $errores[] = 'El nombre de la calle es obligatorio';
        }
        if(!$_POST['NumExt']){
          $errores[] = 'El número exterior es obligatorio';
        }
        if(!$_POST['CP']){
          $errores[] = 'El Código Postal es obligatorio';
        }
        $nums = "0123456789";
        $contNums = 0;
        for($i = 0; $i<strlen($nums); $i++){
          if(!str_contains($_POST['CP'],substr($nums,$i,1))) {
            $contNums++;
          }
        }
        if($contNums == 0){
          $errores[] = 'El Código Postal unicamente puede incluir números';  
        }
        if(!$_POST['COLONIA']){
          $errores[] = 'El nombre de la Colonia es obligatorio';
        }
        if(!$_POST['Municipio']){
          $errores[] = 'El Municipio es obligatorio';
        }
        if(!$_POST['Estado']){
          $errores[] = 'El Estado es obligatorio';
        }
        //Fin de los posibles errores      
      
        if(empty($errores)){
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
          header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/productos.php?dir='.strval($ID_Dir));
          //res=1 Si se llevo exitosamente el registro del nuevo cliente
        }
    }
      
?>
    <hr>
        <section id="#crear">
            <h1>
                Ingresa los datos a donde será enviado tu pedido
            </h1>
            <div class="contenedor">
                <!-- Código para ver errores en el registro -->
            <?php foreach($errores as $error): ?>
                <div class = "alerta error"> <!-- ...error-->
                    <?php echo '*'.$error; ?>
                </div>
            <?php endforeach; ?>  

            <form class="formulario" method="POST" action="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/regDireccion.php">
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
        </section>
    <hr>
        <footer  class="site-footer">
            <p><b>CUIDADO CON EL MICHI</b></p>
            <p>TODOS LOS DERECHOS RESERVADOS</p>
        </footer>
        <script src="build/js/app.js"></script>
    </body>
</html>