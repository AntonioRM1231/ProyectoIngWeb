<?php
include 'RegistroUsuarios.php';
//echo 'Hola';
//echo $CorreoEf;
$registroUsuarios = new RegistroUsuarios();
echo $registroUsuarios->getCorreoE();