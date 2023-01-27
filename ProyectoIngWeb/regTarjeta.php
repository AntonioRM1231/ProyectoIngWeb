<?php
    include "includes/templates/header_registro.php";
    require 'includes/funciones.php';
    require 'conexionBD/connection.php';
    $mysql = new connection();
    $conexion = $mysql->get_connection();
    

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
        $NumeroTarjeta = filter_var($_POST['NumeroTarjeta'],FILTER_SANITIZE_NUMBER_INT);
        $CVC = filter_var($_POST['CVC'],FILTER_SANITIZE_NUMBER_INT);
        $FechaVenc = $_POST['FechaVenc'];
        $NombreTarjeta = strtoupper(filter_var($_POST['NombreTarjeta'],FILTER_SANITIZE_STRING));
        $ApPatTarjeta = strtoupper(filter_var($_POST['ApPatTarjeta'],FILTER_SANITIZE_STRING));
        $ApMatTarjeta = strtoupper(filter_var($_POST['ApMatTarjeta'],FILTER_SANITIZE_STRING));

        //Posibles errores al registrar una tarjeta
        if(!$_POST['NumeroTarjeta']){
          $errores[] = 'El número de tarjeta es obligatorio';
        }
        if(strlen($_POST['NumeroTarjeta']) != 16){
            $errores[] = 'El número de tareta debe tener una longitud de 16 digitos';
        }
        if(!$_POST['CVC']){
          $errores[] = 'El CVC es obligatorio';
        }
        if(strlen($_POST['CVC']) != 3){
            $errores[] = 'El CVC debe tener 3 digitos';
        }
        if(!$_POST['FechaVenc']){
          $errores[] = 'La fecha de vencimiento es obligatoria';
        }
        if(strlen($_POST['FechaVenc']) != 5){
            $errores[] = 'La fecha de vencimiento dene tener 5 digitos';
        }
        if(!$_POST['NombreTarjeta']){
          $errores[] = 'El nombre del titular es obligatorio';
        }
        if(!$_POST['ApPatTarjeta']){
          $errores[] = 'El apellido paterno del titular es obligatorio';
        }
        if(!$_POST['ApMatTarjeta']){
          $errores[] = 'El apellido materno del titular es obligatorio';
        }

        //Verificar si los datos de esa tarjeta ya existen en la base de datos
        $consulta = "SELECT * FROM tarjeta WHERE NumeroTarjeta = '".$NumeroTarjeta."';";
        $resultado = mysqli_query($conexion,$consulta);
        
        //Verifica que haya al menos una fila en el resultado de la consulta
        if($resultado->num_rows && empty($errores)){
          //Solo llamamos al procedimiento almacenado de actualizar la tabla de cliente
          //para agregar el campo de la tarjeta
          $statement = $conexion->prepare('CALL ingActTarjetaEnCliente(?,?)');
          $correo = $_SESSION['CorreoE'];
          $statement->bind_param('ss',  
            $correo,
            $NumeroTarjeta
          );
          $statement->execute();   
          $statement->close();
          $conexion->close();
          echo "se logró";
          //header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/regDireccion.php');
        }
        
        //Fin de los posibles errores      
      
        $consulta = "SELECT MAX(ID_Cliente) AS ID_Max FROM cliente";
        $resultado = mysqli_query($conexion,$consulta);
        $id_res = mysqli_fetch_assoc($resultado);
        $id_Cliente = $id_res['ID_Max']+1;
        $Contrasenia = password_hash($_POST['Contraseniaf'],PASSWORD_BCRYPT);
        if(empty($errores)){
          $statement = $conexion->prepare('CALL ingresarTarjeta(?,?,?,?,?,?)');
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
                ¡Registra tu Tarjeta!
            </h1>
            <div class="contenedor">
                <!-- Código para ver errores en el registro -->
            <?php foreach($errores as $error): ?>
                <div class = "alerta error"> <!-- ...error-->
                    <?php echo '*'.$error; ?>
                </div>
            <?php endforeach; ?>  

            <form class="formulario" method="POST" action="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/regTarjeta.php">
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