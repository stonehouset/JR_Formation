
$( document ).ready(function() {
    $("#contenu_form1").hide();
    $("#contenu_form2").hide();
    $("#contenu_form3").hide();
    $("#gestion_formation").hide();
    $("#dropdownMenuButton").hide();  
    $(".boutons_gestion_utilisateur").hide();
    $("#gestion_utilisateurs").hide();
    $('#form_apprenant').hide(); 
    
    $("#titre_carte_gestion").fadeOut(2500);

});


 $('#inputGroupSelect01').bind('change', function(event) {

    var i= $('#inputGroupSelect01').val();

    if(i=="0"){

        $('#form_apprenant').show("fast");
    }
    else{

        $('#form_apprenant').hide(); 
          
    }
});

$("#btn_gestion_utilisateur").click(function(){

    $(".boutons_gestion_utilisateur").show();
    $("#gestion_utilisateurs").show("fast");
});

$("#btn_donnees").click(function(){

    $(".boutons_gestion_utilisateur").hide();
    $("#contenu_form3").hide();
    $("#contenu_form2").hide();
    $("#contenu_form1").hide();
    $("#dropdownMenuButton").hide(); 
});

$("#btn_gestion_utilisateur").click(function(){

    $("#contenu_donnees").hide();
    $("#dropdownMenuButton").show();
    $("#gestion_formation").hide();   

});

$("#btn_gestion_formation").click(function(){

    $("#contenu_donnees").hide();
    $("#contenu_form2").hide();
    $("#contenu_form1").hide();
    $("#gestion_utilisateurs").hide();
    
    $("#contenu_form3").hide();
    $("#dropdownMenuButton").hide();  
    $("#gestion_formation").show("fast");  

});

$("#btn_entreprise").click(function(){

    $("#contenu_form3").show("fast");
    $("#contenu_form2").hide();
    $("#contenu_form1").hide();
    $("#contenu_donnees").hide();
    $("#gestion_formation").hide();
});

$("#btn_formateur").click(function(){

    $("#contenu_form2").show("fast");
    $("#contenu_form1").hide();
    $("#contenu_form3").hide();
    $("#contenu_donnees").hide();
    $("#gestion_formation").hide();
});

$("#btn_apprenant").click(function(){

    $("#contenu_form1").show("fast");
    $("#contenu_form3").hide();
    $("#contenu_form2").hide();
    $("#contenu_donnees").hide();
    $("#gestion_formation").hide();
});

$("#btn_donnees").click(function(){

    $("#contenu_donnees").show("fast");
    $("#contenu_form1").hide();
    $("#contenu_form2").hide();
    $("#contenu_form3").hide();
    $("#gestion_formation").hide();
    $("#gestion_utilisateurs").hide();
});


// $("#btn_entreprise").mouseleave(function(){
//     $("#form_entreprise").hide();
// });

