// Función para mostrar el preloader y colocar el fixed el navbar
// $(function () {
//   $(window).on('scroll', function (event) {
//       var scroll = $(window).scrollTop();
//       if (scroll < 0) {
//           $(".navbar").removeClass("fixed-top");
//       } else {
//           $(".navbar").addClass("fixed-top")
//       }
//   });

// });

// Funcion para el efecto hover en beneficios
$(document).ready(function () {
  $(".count-box").hover(function () {
      $(this).find("i").css("background-color", "#f9b313"); 
  }, function () {
      $(this).find("i").css("background-color", ""); 
  });
});

// Contador de los atributos de la parte de inicio
$(document).ready(function() {
  setTimeout(startCounting, 2500); 
});

function startCounting() {
  var counter = $("#numero_experiencia");
  var counter2 = $("#numero_proyectos");
  var counter3 = $("#atencion");
  var count = 1;
  var count2 = 1;
  var count3 = 1;
  

  var interval = setInterval(function() {
    counter.text(count);

    if (count === 6) {
      clearInterval(interval);
    }

    count++;
  }, 1200);

  var interval2 = setInterval(function() {
    counter2.text(count2);

    if (count2 === 1800) {
      clearInterval(interval2);
    }

    count2++;
  }, 1);

  var interval3 = setInterval(function() {
    counter3.text(count3+"%");

    if (count3 === 100) {
      clearInterval(interval3);
    }

    count3++;
  }, 75);
}


/**/
/*Seccion*/
const menuItems = document.querySelectorAll('.menu-item');
const sections = document.querySelectorAll('.sectionselect');

menuItems.forEach(item => {
  item.addEventListener('click', () => {
    const selectedSection = item.dataset.section;
    sections.forEach(section => {
      if (section.id === selectedSection) {
        section.style.display = 'block';
      } else {
        section.style.display = 'none';
      }
    });
  });
});

/**
* Testimonials slider
*/
new Swiper('.testimonials-slider', {
speed: 500,
loop: true,
autoplay: {
delay: 2000,
disableOnInteraction: false
},
slidesPerView: 'auto',
pagination: {
el: '.swiper-pagination',
type: 'bullets',
clickable: true
}
});




/*Carrusel de video */      
$(document).ready(function(){

//--------------Slider Secundario--------------//
const slider_secundario=$(".slider_secundario")

slider_secundario.owlCarousel({
    autoplay:true,
    loop:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        480:{
            items:2
        },
        600:{
            items:3
        },
        800:{
            items:4
        }
    }	
});

$('#btn_prev_slider_secundario').on('click',function(){
    slider_secundario.trigger('prev.owl.carousel');
});

$('#btn_next_slider_secundario').on('click',function(){
    slider_secundario.trigger('next.owl.carousel');
});
});







//*carrusel de imagenes */
var swiper = new Swiper(".mySwiper",{
effect:"coverflow",
grabCursor: true,
centeredSlides: true,
slidesPerView: "auto",
coverflowEffect: {
rotate: 15,
strech:0,
depth:300,
modifier:1,
slideShadow:true,
},
loop: true,
})




window.addEventListener('scroll', function() {
const navbar = document.querySelector('.navbar');
if (window.scrollY > 10) {
  navbar.classList.add('navbar-scrolled');
} else {
  navbar.classList.remove('navbar-scrolled');
}
});








const dropdowns = document.querySelectorAll('.dropdown__list');

dropdowns.forEach(dropdown => {
    const link = dropdown.querySelector('.dropdown__link');
    const checkbox = dropdown.querySelector('.dropdown__check');

    link.addEventListener('click', () => {
        dropdowns.forEach(otherDropdown => {
            if (otherDropdown !== dropdown) {
                const otherCheckbox = otherDropdown.querySelector('.dropdown__check');
                otherCheckbox.checked = false;
            }
        });
    });
});








