document.addEventListener('DOMContentLoaded', function() {


    eventListeners();
    darkMode();

})

function darkMode() {
    const btnDarkMode = document.querySelector('.btn-dark-mode');
    
    btnDarkMode.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
    });
}

function eventListeners() {
    
    //Selector

    const mobileMenu = document.querySelector('.mobile-menu');

    // evento 
    mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    //Motrar la navegacion
    
    if(navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
        
    }
    // tambien se puede usar navegacion.classList.toggle('mostrar');
    
}