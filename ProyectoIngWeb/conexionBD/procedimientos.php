<?php
    require_once 'connection.php';
    echo 'esto es una prueba';
    $mysql = new connection();
    $conexion = $mysql->get_connection();
    /*Valores de prueba para almacenar en la base de datos*/
    $newUsuarioST = array(
        'CorreoEp' => 'cprueba@gmail.com',
        'NombreUsuariop' => 'usuarioPrueba',
        'Contraseniap' => '123654852',
        'Nombrep' => 'Holis',
        'ApPaternop' => 'Holis2',
        'ApMaternop' => 'Holis3',
        'Edadp' => 21, 
        'NumTelefonop' => '5547677837'
    );
    echo 'esto es una prueba intermedia';
    var_dump($conexion);
    $statement = $conexion->prepare('CALL ingresarClienteST(?,?,?,?,?,?,?,?)');
    echo 'esto es una prueba 2.0';
    $statement->bind_param('ssssssis',
        $newUsuarioST['CorreoEp'],
        $newUsuarioST['NombreUsuariop'],
        $newUsuarioST['Contraseniap'],
        $newUsuarioST['Nombrep'],
        $newUsuarioST['ApPaternop'],
        $newUsuarioST['ApMaternop'],
        $newUsuarioST['Edadp'],
        $newUsuarioST['NumTelefonop']
    );
    echo 'esto es una prueba fff';
    /**
     * s -> string
     * i -> int
     * d -> float o decimal
     * b -> datos (blob)
     */
    $statement->execute();
    $statement->close();
    $conexion->close();
    echo 'esto es una prueba final';
?>