
$( document ).ready(function() {

    $('input[type=checkbox]').prop("checked", false);

    $("#contenu_form1").hide();
    $("#contenu_form2").hide();
    $("#contenu_form3").hide();
    $("#gestion_formation").hide();
    $("#dropdownMenuButton").hide();  
    $(".boutons_gestion_utilisateur").hide();
    $("#gestion_utilisateurs").hide();
    $('#form_apprenant').hide(); 
    $('#form_suivi_client').hide();  
    $("#titre_carte_gestion").fadeOut(2500);
    $('#contenu_form_client').hide(); 
    $('#contenu_form_impact').hide(); 
    $('#form_impact_client').hide();
    $('#form_ajout_com_journalier_formateur').hide(); 
    $('#commentaire_journalier_formation').hide(); 
    $('#presence_2_mois').hide();  
    $('#presence_6_mois').hide();
    $('#btn_valider_suivi_client ').hide();
    $('#input_date_embauche').hide();
    $('#label_date_embauche').hide();
    
    $('#form_satisfaction_formateur').hide();
    $('#form_satisfaction_formation').hide();
    $('#form_com_semaine_apprenant').hide();
    $('#programme_form_pdf').hide();

    
    if (true) {}
    
    setTimeout(function() {

        $('.alert-error,.alert-success').fadeOut('fast');

    }, 3000);

	num_role = $( "#role" ).text();

    console.log(num_role);

    if(num_role === 3){

        $("#role").text("Administrateur");
    }
    else if(num_role === 2){

        $("#role").text("Client");
    }
    else if(num_role === 1){

        $("#role").text("Formateur");
    }
    else if(num_role === 0){

        $("#role").text("Apprenant");
    }
	

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

$("#btn_apprenant_quest_formateur").click(function(){

    $("#form_satisfaction_formation").hide();
    $("#form_com_semaine_apprenant").hide(); 
    $("#programme_form_pdf").hide(); 
    $("#form_satisfaction_formateur").show("fast");
    
});

$("#btn_apprenant_quest_formation").click(function(){

    $("#form_satisfaction_formateur").hide();
    $("#form_com_semaine_apprenant").hide(); 
    $("#programme_form_pdf").hide(); 
    $("#form_satisfaction_formation").show("fast");
    
});

$("#btn_apprenant_com_fin_sem").click(function(){

    $("#form_satisfaction_formateur").hide();
    $("#form_satisfaction_formation").hide();
    $("#programme_form_pdf").hide(); 
    $('#form_com_semaine_apprenant').show("fast");
    
});

$("#btn_apprenant_programme").click(function(){

    $("#form_satisfaction_formateur").hide();
    $("#form_satisfaction_formation").hide();
    $("#form_com_semaine_apprenant").hide();
    $('#programme_form_pdf').show("fast");
     
});

function doalert(checkboxElem) {

  if (checkboxElem.checked) {

    $('#presence_2_mois').show("fast");
    $('#btn_valider_suivi_client').show("fast");
    $('#input_date_embauche').show("fast");
    $('#label_date_embauche').show("fast");
    $('#motif_non_embauche').hide("fast");
    $('#label_motif_non_embauche').hide("fast");
    
    

  } else {

    $('#presence_2_mois').hide("fast");
    $('#presence_6_mois').hide("fast");
    $('#btn_valider_suivi_client').hide("fast");
    $('#motif_non_embauche').show("fast");
    $('#label_motif_non_embauche').show("fast");
    $('#input_date_embauche').hide("fast");
    $('#label_date_embauche').hide("fast");
    
    
    

  }

}

$('#motif_non_embauche').on('keyup', function() {

     if (this.value.length > 1) {
        
        $('#btn_valider_suivi_client').show("fast");
     }
     else {

        $('#btn_valider_suivi_client').hide();
     }

});

function doalert2(checkboxElem) {

  if (checkboxElem.checked) {

    $('#presence_6_mois').show("fast");
    $('#label_select_motif_2_mois').hide();
    $('#motif_predefini_2_mois').hide();
    $('#label_motif_detaille_2_mois').hide();
    $('#motif_detaille_2_mois').hide();

  } else {

    $('#presence_6_mois').hide();
    $('#label_select_motif_2_mois').show("fast");
    $('#motif_predefini_2_mois').show("fast");
    $('#label_motif_detaille_2_mois').show("fast");
    $('#motif_detaille_2_mois').show("fast");

  }

}

function doalert3(checkboxElem) {

  if (checkboxElem.checked) {

    $('#label_embauche_6_mois').hide();
    $('#input_embauche_6_mois').hide();

    
  } else {

    $('#label_embauche_6_mois').show("fast");
    $('#input_embauche_6_mois').show("fast");

  }

}


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

$("#btn_com_formateur_to_apprenant").click(function(){

    
    $("#com_formateur_to_apprenant").show("fast");
});


function functionShowHideFormClient() {

    var x = document.getElementById("form_suivi_client");

    if (x.style.display === "none") {

        x.style.display = "block";

    } else {

        x.style.display = "none";
    }

    $('#contenu_form_client').show('slow');
} 

function functionShowHideFormImpact() {

    var x = document.getElementById("form_impact_client");

    if (x.style.display === "none") {

        x.style.display = "block";

    } else {

        x.style.display = "none";
    }

    $('#contenu_form_impact').show('slow');
} 

function functionShowHideFormComJour(){

    var x = document.getElementById("form_ajout_com_journalier_formateur");

    if (x.style.display === "none") {

        x.style.display = "block";

    } else {

        x.style.display = "none";
    }

    $('#commentaire_journalier_formation').show('slow');

}

function functionRole(){

    var role = $("#role").val();

    if(role == 0){

        $("#role").attr('text', 'Apprenant');

    }

    console.log(role);
}

$(document).on('change', '#checkbox_1', function(){

    $(this).css('color', 'green');
});







// $("#btn_entreprise").mouseleave(function(){
//     $("#form_entreprise").hide();
// });

