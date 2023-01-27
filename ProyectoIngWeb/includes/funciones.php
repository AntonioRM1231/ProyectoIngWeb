<?php
function incluirTemplate($nombre){
    include "includes/templates/${nombre}.php";
}

function estaAutenticado() : bool {
    session_start();
    $auth = $_SESSION['login'];
    if($auth){
        return true;
    }else{
        return false;
    }
}

function estaAutenticadoAdmin() : bool {
    session_start();
    $auth = $_SESSION['loginAdmin'];
    if($auth){
        return true;
    }else{
        return false;
    }
}