<?php
    require_once 'connection.php';

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

    $statement = $conexion->prepare('CALL ingresarClienteST(?,?,?,?,?,?,?,?)');
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
    $statement->execute();
    $statement->close();
    $conexion->close();
?>