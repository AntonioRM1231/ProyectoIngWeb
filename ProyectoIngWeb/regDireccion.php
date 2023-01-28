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
        $NumExt = strtoupper($_POST['NumExt']);
        $NumInt = strtoupper($_POST['NumInt']);  
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
          header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/infoPedido.php?band=1&dir='.strval($ID_Dir));
        }
    }
      
?>
    <hr>
        <section id="#crear">
            <h1>
                Ingresa los datos de la dirección a donde será enviado tu pedido
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
                <label class="label">Calle</label>
                <input class="field" type="text" name="Calle" placeholder="Nombre de la Calle" value="<?php echo $Calle?>" required>
            </div>
            <div class="campo">
                <label class="label">Num Exterior </label>
                <input class="field" type="text" name="NumExt" placeholder="Número Exterior" value="<?php echo $NumExt?>" required>
            </div>
            <div class="campo">
                <label class="label">Num Interior </label>
                <input class="field" type="text" name="NumInt" placeholder="Número Interior" value="<?php echo $NumInt?>">
            </div>
            <div class="campo">
                <label class="label">CP</label>
                <input class="field" type="number" name="CP" placeholder="Código Postal" value="<?php echo $CP?>" required>
            </div>
            <div class="campo"> 
                <label class="label">Colonia </label>
                <input class="field" type="text" name="COLONIA" placeholder="Colonia" value="<?php echo $COLONIA?>" required>
            </div>
            <div class="campo">
                <label class="label">Municipio</label>
                <input class="field" type="text" name="Municipio" placeholder="Municipio" value="<?php echo $Municipio?>" required>
            </div>
            <div class="campo"> 
                <label class="label">Estado</label>
                <input class="field" type="text" name="Estado" placeholder="Estado" value="<?php echo $Estado?>" required>
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