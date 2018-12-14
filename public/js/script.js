
$( document ).ready(function() {

    $('#form_satisfaction_formation').hide();
    $('#form_satisfaction_formateur').hide();
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
    $('#presence_2_mois').hide();  
    $('#presence_6_mois').hide();
    $('#btn_valider_suivi_client ').hide();
    $('#input_date_embauche').hide();
    $('#label_date_embauche').hide();
    $('#tableau_gestion_admin_infos_formateurs2').hide();
    $('#form_satisfaction_formateur').hide();
    $('.loader').hide();
    $('#form_com_semaine_apprenant').hide();
    $('#btns_questionnaires').hide();

    
    if (true) {}
    
    setTimeout(function() {

        $('.alert-error,.alert-success').fadeOut('fast');

    }, 3000);

	num_role = $( "#role" ).text();

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

$("#info_mdp_login").hover(function(){

    $("#password").attr("placeholder", "Votre mot de passe vous a été communiqué par mail");
});

$("#info_mdp_login").click(function(){

    $("#password").attr("placeholder", "Votre mot de passe vous a été communiqué par mail");
});


$("#btn_donnees").click(function(){

    $(".boutons_gestion_utilisateur").hide();
    $("#contenu_form3").hide();
    $("#contenu_form2").hide();
    $("#contenu_form1").hide();
    $("#dropdownMenuButton").hide(); 
});

$("#btn_switch_to_client").click(function(){

    $("#tableau_gestion_admin_infos_formateurs").hide();
    $("#tableau_gestion_admin_infos_formateurs2").show('fast');
 
});

$("#btn_switch_to_form").click(function(){

    $("#tableau_gestion_admin_infos_formateurs2").hide();
    $("#tableau_gestion_admin_infos_formateurs").show('fast');
  
});


$("#btn_questionnaires").click(function(){


    $("#btns_questionnaires").show("fast");
    $("#form_com_semaine_apprenant").hide(); 
    $("#programme_form_pdf").hide(); 
    
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
    $("#form_com_semaine_apprenant").show("fast");
    $("#btns_questionnaires").hide();
    
});

$("#btn_apprenant_programme").click(function(){

    $("#form_satisfaction_formateur").hide();
    $("#form_satisfaction_formation").hide();
    $("#form_com_semaine_apprenant").hide();
    $("#programme_form_pdf").show("fast");
    $("#btns_questionnaires").hide();
     
});

function doalert(checkboxElem) {

  if (checkboxElem.checked) {

    $("#presence_2_mois").show("fast");
    $("#btn_valider_suivi_client").show("fast");
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

function search() {

  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {

        td = tr[i].getElementsByTagName("td")[0];

        if (td) {

            txtValue = td.textContent || td.innerText;

            if (txtValue.toUpperCase().indexOf(filter) > -1) {

                tr[i].style.display = "";

            } else {

                tr[i].style.display = "none";
            }

        }

    }

}

function search2() {

  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("input_form");
  filter = input.value.toUpperCase();
  table = document.getElementById("taille_tab_formateur");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {

        td = tr[i].getElementsByTagName("td")[0];

        if (td) {

            txtValue = td.textContent || td.innerText;

            if (txtValue.toUpperCase().indexOf(filter) > -1) {

                tr[i].style.display = "";

            } else {

                tr[i].style.display = "none";
            }

        }

    }

}

$('#form_login').submit(function() {

    $('#label_btn_login').hide();
    $('.loader').show();
});

$('#register_user').submit(function() {

    $('#label_btn_register').hide();
    $('.loader').show();
});

$('#form_register_apprenants').submit(function() {

    $('#label_btn_submit_add_appr').hide();
    $('.loader').show();
});

$('#form_change_mdp').submit(function() {

    $('#label_btn_submit_change_mdp').hide();
    $('.loader').show();
});

$('#form_suppr_users').submit(function() {

    $('#label_btn_submit_suppr_user').hide();
    $('.loader').show();
});


$('#form_add_formation').submit(function() {

    $('#label_btn_submit_add_form').hide();
    $('.loader').show();
});

$('#form_suppr_form').submit(function() {

    $('#label_btn_submit_suppr_form').hide();
    $('.loader').show();
});

$('#form_suivi_app_client').submit(function() {

    $('#label_btn_valid_suivi').hide();
    $('.loader').show();
});

$('#form_eval_impact_client').submit(function() {

    $('#label_btn_valid_eval').hide();
    $('.loader').show();
});

$('#form_register_commentaire').submit(function() {

    $('#label_btn_add_com_forma').hide();
    $('#loader1').show();
});

$('#form_absence_retard').submit(function() {

    $('#label_btn_add_absret_forma').hide();
    $('#loader2').show();
});

$('#form_register_note').submit(function() {

    $('#label_btn_add_note_forma').hide();
    $('#loader3').show();
});

$('#form_com_jour_forma').submit(function() {

    $('#label_btn_add_come_form_forma').hide();
    $('#loader4').show();
});

$('#form_compte_rendu').submit(function() {

    $('#label_btn_add_eval_form').hide();
    $('.loader').show();
});

$('#form_quest_formateur_app').submit(function() {

    $('#label_btn_valid_quest_formateur').hide();
    $('.loader').show();
});

$('#form_quest_formation_app').submit(function() {

    $('#label_btn_valid_quest_formation').hide();
    $('.loader').show();
});

$('#com_sem1').submit(function() {

    $('#label_btn_valid_com1').hide();
    $('.loader').show();
});

$('#com_sem2').submit(function() {

    $('#label_btn_valid_com2').hide();
    $('.loader').show();
});























