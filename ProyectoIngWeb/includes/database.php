<?php

//host,usuario,contraseña,base de datos a la que nos vamos a conectar
$db = mysqli_connect('localhost','root','anahi1610','ccm');

if(!$db){
    echo "Se ha producido un error en la conexión";
    exit;
    /**
     * En caso de que haya un error en la conexión, se va a salir del programa
     */
}