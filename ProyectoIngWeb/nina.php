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
    <link rel="icon" type="image/x-icon" href="imagenes/ccm.png">
    <link rel="stylesheet" href="build/css/app.css">
</head>
<body>
    <?php
        include './includes/templates/header.php';
    ?>
    <div class="offcanvas offcanvas-end" id="demo">
        <div class="offcanvas-header">
            <h1>
                Iniciar sesión
            </h1>
            <button class="btn-close" type="button" data-bs-dismiss="offcanvas"></button>  
        </div>
        <div class="offcanvas-body">
          <form class="formulario">
            <div class="campo">
                <label  class="label" for="email">CORREO ELECTRONICO</label>
                <input  class="field" type="email" id="email">
            </div>
            <div class="campo">
                <label class="label" for="password">CONTRASEÑA</label>
                <input class="field" type="password" id="password">
            </div>
            <div class="campo">
                <input type="submit" value="Enviar" class="boton-marron">
            </div>
          </form>
        </div>
      </div>
      <div class="offcanvas offcanvas-end" id="demo2">
        <div class="offcanvas-header">
          <h1>
            Registrate
          </h1>
          <button class="btn-close" type="button" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
          <form class="formulario">
            <div class="campo">
                <label class="label" for="name">NOMBRE</label>
                <input class="field" type="text" id="name">
            </div>
            <div class="campo">
                <label class="label" for="lastname">APELLIDO</label>
                <input class="field" type="text" id="lastname">
            </div>
            <div class="campo">
                <label class="label" for="email2">CORREO ELECTRONICO</label>
                <input class="field" type="email" id="email2">
            </div>
            <div class="campo">
                <label class="label" for="password2">CONTRASEÑA</label>
                <input class="field" type="password" id="password2">
            </div>
            <div class="campo">
                <input type="submit" value="Enviar" class="boton-marron">
            </div>
          </form>
        </div>
    </div>
    <hr>
    <main class="contenedor">
        <h2>NIÑA</h2>
    </main>
    <section class="seccion contenedor">
        <div class="contenedor-anuncio">
            <a href="anuncio.html" class="anuncio">
                <picture>
                    <source srcset="imagenes/forum1.png" type="image/jpg">
                    <img loading="lazy" src="imagenes/forum1.png" alt="anuncio">
                </picture>
                <div class="contenido-anuncio">
                    <h3>ADIDAS FORUM LOW EXHIBIT</h3>
                    <p class="precio"><b> $1,200.00</b></p>
                </div>
            </a>
        </div>
    </section>
    <hr>
    <footer  class="site-footer">
        <p><b>CUIDADO CON EL MICHI</b></p>
        <p>TODOS LOS DERECHOS RESERVADOS</p>
    </footer>
</body>
</html>