$(document).ready(function(){
    console.log("main.js ready!");

    $(".projet_details").hide();
    $("#projet_bouton_1").on( "click", function() {
        $(".div_portfolio .projets").hide("slow");
        $("#projet_details_1").show("slow");
    });
    $(".bt_retour").on( "click", function() {
        $(".projet_details").hide("slow");
        $(".div_portfolio .projets").show("slow");
    });

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