$(document).ready(function(){
    console.log("main.js ready!");

    $(".projet_details").hide();

    $(".projet_bouton").on( "click", function() {
        num= $(this).attr("id").split("_")[2];
        console.log($(this).attr("id"));
        $(".div_portfolio .projets").hide("slow");
        $("#projet_details_"+num).show("slow");
    });

    $(".bt_retour").on( "click", function() {
        $(".projet_details").hide("slow");
        $(".div_portfolio .projets").show("slow");
    });

    //-------------------------------------------- boutons menu navigation
    const temps_transition = 500;
    $(".div_menu a").on( "click", function() {
        bt=$(this).attr("id").split("_")[1];
        $('html, body').animate({ scrollTop: $("#"+bt).offset().top }, temps_transition);
    });
  

});