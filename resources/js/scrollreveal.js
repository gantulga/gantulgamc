let ScrollReveal = require('scrollreveal');
ScrollReveal = ScrollReveal.default || ScrollReveal;

var defaultOpt = {
    interval: 64, //16
    delay: 250,
    duration: 800,
    distance: '50px',
    easing: 'ease',
    //mobile: false,
    afterReveal: function(el) {
        el.classList.remove('reveal');
        el.classList.add('revealed');
        //el.className = el.className.replace(/\breveal.+?/g, '');
    }

};

//document.addEventListener("DOMContentLoaded", function () {
//});
export default function(){

    ScrollReveal().reveal('.reveal', {
        ...defaultOpt,
    });
    ScrollReveal().reveal('.reveal-up', {
        ...defaultOpt,
        origin: 'down',
    });
    ScrollReveal().reveal('.reveal-left', {
        ...defaultOpt,
        origin: 'right',
    });
    ScrollReveal().reveal('.reveal-right', {
        ...defaultOpt,
        origin: 'left',
    });
    ScrollReveal().reveal('.reveal-down', {
        ...defaultOpt,
        origin: 'up',
    });
    ScrollReveal().reveal('.reveal-scale', {
        ...defaultOpt,
        distance: '0px',
        scale: .5,
    });
    ScrollReveal().reveal('.reveal-in', {
        ...defaultOpt,
        distance: '1px',
        scale: 1,
    });

    // custom
    ScrollReveal().reveal('.reveal-left-no-mobile', {
        ...defaultOpt,
        origin: 'right',
        mobile: false,
    });
}
