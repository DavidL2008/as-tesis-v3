setTimeout(function () {
    window.location.href = 'main.html';
}, 3000);


// Funcion para ejecutar el efecto de movimiento en las palabras
let app = document.getElementById('preloader-text');
let typewriter = new Typewriter(app, {
  loop: true,
  delay: 100,
});
typewriter
  .pauseFor(500)
  .typeString('AS TESIS')
  .pauseFor(400)
  .deleteChars(10)
  .start();


// Obtener el año actual para el footer
var annio = (new Date).getFullYear();
$(document).ready(function() {
  $("#annio").text( annio );
});
















