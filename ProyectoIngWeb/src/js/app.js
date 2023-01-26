document.addEventListener('DOMContentLoaded', function(){

    eventListeners();
});

function eventListeners(){
    //NAVEGACION RESPONSIVE 
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);
    //SRCOLLNAV
    const enlace = document.querySelector('.a-nos');
    enlace.addEventListener('click', scrollNav(e));

}

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');

}
function scrollNav(e){
    e.preventDefault();
    const seccionScroll =  e.target.attributes.href.value;
    const seccion = document.querySelector(seccionScroll);
    seccion.scrollIntoView({behavior: "smooth"});
}
