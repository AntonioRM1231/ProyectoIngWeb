<?php
    echo "cerrar sesión 1";
    echo "<br>";
    session_start();
    echo "cerrar sesión 1-2";
    echo "<br>";
    $bandera = 0;
    if($_SESSION['loginAdmin']){
        $bandera = 1;
    }
    $_SESSION = [];
    echo "cerrar sesión 2";
    echo "<br>";
    if($bandera == 0){
        header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/index.php');
    }else if($bandera == 1){
        header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/index.php');
    }
    
?>