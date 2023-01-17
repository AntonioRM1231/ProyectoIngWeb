<?php
    require_once 'connection.php';

    require '../Cliente.php';
    echo 'Hola 0';
    
    $cliente = new Cliente();

    echo 'Hola 1';
    echo 'esto es una prueba';
    $mysql = new connection();
    $conexion = $mysql->get_connection();
    /*Valores de prueba para almacenar en la base de datos*/
    echo 'Hola 2';
    $newUsuarioST = array(
        'CorreoEp' => 'pruebah@gmail.com',
        'NombreUsuariop' => '1038',
        'Contraseniap' => '123654852',
        'Nombrep' => 'a',
        'ApPaternop' => 'b',
        'ApMaternop' => 'c',
        'Edadp' => 21, 
        'NumTelefonop' => '5547677837'
    );
    echo 'Hola 3';
    $statement = $conexion->prepare('CALL ingresarClienteST(?,?,?,?,?,?,?,?)');
    
    echo 'esto es una prueba intermedia';
    var_dump($conexion);
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
    /**
     * s -> string
     * i -> int
     * d -> float o decimal
     * b -> datos (blob)
     */
    echo 'Hola 4';
    $statement->execute();
    $statement->close();
    $conexion->close();
?>