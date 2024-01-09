$(document).ready(function(){
    const temps_transition = 500;
    $("#bt_haut").on( "click", function() {
        $('html, body').animate({ scrollTop: $("#haut").offset().top }, temps_transition);
    });
    $("#bt_portfolio").on( "click", function() {
        $('html, body').animate({ scrollTop: $("#portfolio").offset().top }, temps_transition);
    });
    $("#bt_about").on( "click", function() {
        $('html, body').animate({ scrollTop: $("#about").offset().top }, temps_transition);
    });
    $("#bt_contact").on( "click", function() {
        $('html, body').animate({ scrollTop: $("#contact").offset().top }, temps_transition);
    });
});