<?php
include 'RegistroUsuarios.php';
//echo 'Hola';
echo $CorreoEf;
$registroUsuarios = new Cliente();
echo $registroUsuarios->getCorreoE();