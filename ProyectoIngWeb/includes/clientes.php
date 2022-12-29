<?php
//echo "Hola";
require 'funciones2.php';
$clientes = obtenerServicios();
echo json_encode($clientes);