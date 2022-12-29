<?php

function obtenerServicios() : array{
    try {
        //Importar una conexión
        require 'database.php';

        //Escribir el código SQL
        $sql = "SELECT * FROM cliente;";//Ejemplo de consulta
        $consulta = mysqli_query($db,$sql);

        //Arreglo vacio para guardar el resultado de las consultas
        $clientes = [];
        $i = 0;
        //Obtener los resultados (e imprimirlos)
        while($row = mysqli_fetch_assoc($consulta)){
            $clientes[$i]['CorreoE'] = $row['CorreoE'];
            $clientes[$i]['NombreUsuario'] = $row['NombreUsuario'];
            $clientes[$i]['Contrasenia'] = $row['Contrasenia'];
            $clientes[$i]['Nombre'] = $row['Nombre'];
            $clientes[$i]['ApPaterno'] = $row['ApPaterno'];
            $clientes[$i]['ApMaterno'] = $row['ApMaterno'];
            $clientes[$i]['Edad'] = $row['Edad'];
            $clientes[$i]['NumTelefono'] = $row['NumTelefono'];
            $clientes[$i]['ID_Pedido'] = $row['ID_Pedido'];
            $clientes[$i]['NumeroTarjeta'] = $row['NumeroTarjeta'];
            $i++;
        }
        /*
        echo "<pre>";
            var_dump($clientes);
        echo "<pre>";*/
        return $clientes;

    } catch (\Throwable $th) {
        //Imprimimos el error, en caso de que haya
        var_dump($th);
    }
}

obtenerServicios();