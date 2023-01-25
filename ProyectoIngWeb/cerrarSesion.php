<?php
    echo "cerrar sesión 1";
    echo "<br>";
    session_start();
    echo "cerrar sesión 1-2";
    echo "<br>";
    $_SESSION = [];
    echo "cerrar sesión 2";
    echo "<br>";
    header('Location: /ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/index.php');
?>