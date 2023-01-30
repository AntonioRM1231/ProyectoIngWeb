document.addEventListener('DOMContentLoaded', function(){

    eventListeners();
});

function eventListeners(){
    //NAVEGACION RESPONSIVE 
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);
    //SRCOLLNAV
    scrollNav();
    //navegacion fija
    navegacionFija();
    //mostrarImagen
    mostrarImagen();
}

function navegacionResponsive(){
    
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');

}
function scrollNav(){
    //SRCOLLNAV
    const enlace = document.querySelector('.a-nos');
    //console.log(enlace);
    if (enlace) {
        enlace.addEventListener('click', function(e){
            e.preventDefault();
            //console.log('hola');
            const seccionScroll =  e.target.attributes.href.value;
            const seccion = document.querySelector(seccionScroll);
            seccion.scrollIntoView({behavior:"smooth"});
        });
    }
    
}
function navegacionFija(){
    //navegacion fija
    const barra = document.querySelector('.header');
    const maiN = document.querySelector('main');
    const body = document.querySelector('body');

    window.addEventListener('scroll', function(){
        if (maiN.getBoundingClientRect().bottom<0) {
            barra.classList.add('fijo');
            //console.log("ya pasamos");
            body.classList.add('body-scroll');
        }else{
            barra.classList.remove('fijo');
            //console.log("aun no");|
            body.classList.remove('body-scroll');
        }
    });
}
function mostrarImagen(){
    const imagenes = document.querySelectorAll('.anuncio-izq img');
    imagenes.forEach(imagen=>{
        imagen.addEventListener('click',function(e){
            const id = e.target.attributes.id.value;
            console.log(id);
            const image = document.createElement('div');
            image.innerHTML=`<img width="600" height="600" src="/ProyectoIngWebGit/ProyectoIngWeb/ProyectoIngWeb/admin/zapatos/image/${id}">`;
            //Crea ell overlay con la imagen
            const overlay = document.createElement('DIV');
            overlay.appendChild(image);
            overlay.classList.add('overlay');
            overlay.onclick = function(){
                const body = document.querySelector('body');
                body.classList.remove('fijar-body');
                overlay.remove();
            }
            //Boton para cerrar el modal
            const cerrarModal = document.createElement('P');
            cerrarModal.textContent = 'X';
            cerrarModal.classList.add('boton-cerrar');
            cerrarModal.onclick = function () {
                const body = document.querySelector('body');
                body.classList.remove('fijar-body');
                overlay.remove();
            }
            overlay.appendChild(cerrarModal);
            //Añadirlo al HTML
            const body = document.querySelector('body');
            body.appendChild(overlay); 
            body.classList.add('fijar-body'); 
        })
    })
}
