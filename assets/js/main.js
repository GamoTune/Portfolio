$(document).ready(function(){
    console.log("main.js ready!");
    const temps_transition = 500;
    $(".projet_details").hide();

    $(".projet_bouton").on( "click", function() {
        num = $(this).attr("id").split("_")[2];
        console.log($(this).attr("id"));
        $(".div_portfolio .projets").hide("slow");
        $("#projet_details_"+num).show("slow",function(){
            $('html, body').animate({ scrollTop: $("#projet_details_"+num).offset().top-50 }, temps_transition);
        }); 
    });

    $(".bt_retour").on( "click", function() {
        $('html, body').animate({ scrollTop: $("#portfolio").offset().top+50 }, temps_transition);
        $(".projet_details").hide("slow");
        $(".div_portfolio .projets").show("slow");
    });

    //-------------------------------------------- boutons menu navigation
    
    $(".div_menu a").on( "click", function() {
        bt=$(this).attr("id").split("_")[1];
        $('html, body').animate({ scrollTop: $("#"+bt).offset().top }, temps_transition);
    });
  

});