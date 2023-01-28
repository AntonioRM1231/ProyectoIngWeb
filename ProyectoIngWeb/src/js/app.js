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
}

function navegacionResponsive(){
    
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');

}
function scrollNav(){
    //SRCOLLNAV
    const enlace = document.querySelector('.a-nos');
    enlace.addEventListener('click', function(e){
        e.preventDefault();
        console.log('hola');
        const seccionScroll =  e.target.attributes.href.value;
        const seccion = document.querySelector(seccionScroll);
        seccion.scrollIntoView({behavior:"smooth"});
    });
}
function navegacionFija(){
    //navegacion fija
    const barra = document.querySelector('.header');
    const anuncios = document.querySelector('.contenedor-anuncio');
    const body = document.querySelector('body');

    window.addEventListener('scroll', function(){
        if (anuncios.getBoundingClientRect().bottom<0) {
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

