document.addEventListener('DOMContentLoaded', function () {


    eventListeners();
    darkMode();

})

function darkMode() {

    const preferDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    if (preferDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }
    
    preferDarkMode.addEventListener('change', () => {
        
        if (preferDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    })

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

    if (navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');

    }
    // tambien se puede usar navegacion.classList.toggle('mostrar');

}