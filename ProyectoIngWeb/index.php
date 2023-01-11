   <?php
        require 'includes/funciones.php';
        incluirTemplate('header');
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
            ¡Regístrate!
          </h1>
          <button class="btn-close" type="button" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
          <form class="formulario" action="pru.php" method="get">
            <div class="campo">
                <label class="label">Correo Electrónico</label>
                <input class="field" type="email" name="CorreoEf" placeholder="email@ejemplo.com">
            </div>
            <div class="campo">
                <label class="label">Nombre de Usuario</label>
                <input class="field" type="text" name="NombreUsuariof" placeholder="Usuario">
            </div>
            <div class="campo">
                <label class="label">Contraseña</label>
                <input class="field" type="password" name="Contraseniaf" placeholder="**********">
            </div>
            <div class="campo">
                <label class="label">Nombre</label>
                <input class="field" type="text" name="Nombref" placeholder="Nombre">
            </div>
            <div class="campo">
                <label class="label">Apellido Paterno</label>
                <input class="field" type="text" name="ApPaternof" placeholder="Apellido Paterno">
            </div>
            <div class="campo">
                <label class="label">Apellido Materno</label>
                <input class="field" type="text" name="ApMaternof" placeholder="Apellido Materno">
            </div>
            <div class="campo">
                <label class="label">Edad</label>
                <input class="field" type="number" name="Edadf" placeholder="00">
            </div>
            <div class="campo">
                <label class="label">NumTelefono</label>
                <input class="field" type="number" name="NumTelefonof" minlength="10" placeholder="1234567890">
            </div>
            <div class="campo">
                <input type="submit" value="Enviar" class="boton-marron">
            </div>
          </form>
        </div>
    </div>
    <hr>
    <main class="contenedor">
        <h2>NUESTROS PRODUCTOS</h2>
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
    </main>
    <hr>
    <section id="nosotros">
      <div class="contenedor-nosotros">
        <div class="img-nosotros">
          <picture>
            <source srcset="imagenes/catsnk.jpg" type="image/jpg">
            <img loading="lazy" src="imagenes/catsnk.jpg" alt="anuncio">
          </picture>
        </div>
        <div class="desc-nosotros">
          <h3>NOSOTROS</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus mauris nisl, 
            cursus feugiat sapien ac, facilisis mollis enim. Aenean bibendum urna id ante varius 
            interdum. In vulputate lacus in pulvinar suscipit. Pellentesque posuere varius 
            vestibulum. Pellentesque sapien nisl, malesuada non sapien at, mattis elementum 
            diam. Donec nisi quam, ultrices ut pharetra eget, pharetra in mauris. Nullam ullamcorper, 
            nunc ac dignissim luctus, ante massa tempor nunc, non aliquet tellus quam sed eros. Quisque gravida, 
            diam a molestie ultrices, ex neque pretium felis, a tempor diam leo sed orci. Pellentesque 
            id metus quis neque laoreet placerat. Quisque commodo, diam ac accumsan sollicitudin, 
            odio libero eleifend enim, in pretium odio felis eu elit.</p>
        </div>
      </div>
    </section>
    <hr>
    <footer  class="site-footer">
        <p><b>CUIDADO CON EL MICHI</b></p>
        <p>TODOS LOS DERECHOS RESERVADOS</p>
    </footer>
    <script src="build/js/app.js"></script>
</body>
</html>