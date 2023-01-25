<?php
    if(!isset($_SESSION)){
        session_start();
    }
    $auth = $_SESSION['loginAdmin'] ?? false; //null
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuidado con el michi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,400;0,700;1,400;1,700&family=Roboto&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/x-icon" href="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/imagenes/ccm.png">
    <link rel="stylesheet" href="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/build/css/app.css">
</head>
<body>
<header class="header">
        <div class="contenedor contenido-header">
           
            <!--LOGOTIPO-->
            <a href="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/index.php">
                <img class="logotipo" src="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/imagenes/ccm.png" alt="logotipo">
            </a>
            <div class="barra">
                <div class="mobile-menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </div>
                <nav class="navegacion">
<<<<<<< HEAD
                    <!--CATEGORIAS-->  
                    <?php  if(!$auth): ?>
                        <a href="#" data-bs-toggle="offcanvas" data-bs-target="#demo"> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                        </a>
                    <?php endif ?>
                    <?php  if($auth): ?>
                        <a href="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/crear.php">Crear</a>
                        <a href="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/cerrarSesion.php">Cerrar sesión</a>
                    <?php endif ?>
=======
                    <!--CATEGORIAS-->
                    <a href="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/editar.php">Editar</a>
>>>>>>> e897a159563c9c1b0e3246948591063490c9149c
                </nav>
            </div>
        </div>
    </header>