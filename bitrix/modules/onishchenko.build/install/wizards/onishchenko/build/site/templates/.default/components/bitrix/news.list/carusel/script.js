$(document).ready(function(){
    $('.car-carusel li').hover(
        function(){
            $(this).find('.car-carusel-hover').fadeIn(300);
        },
        function(){
            $(this).find('.car-carusel-hover').fadeOut(300);
        }
    );
});
