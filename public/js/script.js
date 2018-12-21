
$( document ).ready(function() {

    $('#infos_jrt_formation').hide();
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
    $('#form_satisfaction_formateur').hide();
    $('.loader').hide();
    $('#form_com_semaine_apprenant').hide();
    $('#btns_questionnaires').hide();
    $('#container_form_eval_formateur_admin').hide();
    $('#container_form_eval_formation_admin').hide();
    $('#container_form_eval_autoeval_admin').hide();
    $('#container_impact_forma_admin').hide();
    $('#tab_formateurs_et_clients').hide();
    
    
    
    if($('#div_show_error').is(':visible') || $('#div_show_success').is(':visible')){

        $('#btns_gestion_admin').hide();
        $('#titre_profil').hide();
        $('#btns_nav_apprenants').hide();
        $('#titre_row_interface_formateur').hide();
        $('#row_titre_compte_rendu').hide();
        $('#titre_interface_client').hide();
        $('#btns_modif_questionnaires').hide();
        
        
               
        $('#div_show_error').delay(2900).fadeOut('fast');
        $('#div_show_success').delay(2900).fadeOut('fast');

        $('#btns_gestion_admin').delay(3000).fadeIn('fast');
        $('#titre_profil').delay(3000).fadeIn('fast');
        $('#btns_nav_apprenants').delay(3000).fadeIn('fast');
        $('#titre_row_interface_formateur').delay(3000).fadeIn('fast');
        $('#row_titre_compte_rendu').delay(3000).fadeIn('fast');
        $('#titre_interface_client').delay(3000).fadeIn('fast');
        $('#btns_modif_questionnaires').delay(3000).fadeIn('fast');
    };
    

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

$("#lien_ousuisje").click(function(){

    
    $("#infos_jrt_formation").slideToggle('fast');
    $("#logo_accueil").slideToggle('fast');
   
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

$("#btn_switch_to_client_form").click(function(){

    $("#tableau_gestion_admin_infos_apprenants").hide();
    $("#tab_formateurs_et_clients").show('fast');
 
});

$("#btn_switch_to_form").click(function(){

    $("#tab_formateurs_et_clients").hide();
    $("#tableau_gestion_admin_infos_apprenants").show('fast');
 
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

$("#btn_quest_eval_formateur").click(function(){

    
    $("#container_form_eval_formateur_admin").show("fast");
    $("#container_form_eval_formation_admin").hide();
    $("#container_form_eval_autoeval_admin").hide();
    $("#container_impact_forma_admin").hide();
    
     
});

$("#btn_quest_eval_formation").click(function(){

    
    
    $("#container_form_eval_formation_admin").show("fast");
    $("#container_form_eval_autoeval_admin").hide();
    $("#container_impact_forma_admin").hide();
    $("#container_form_eval_formateur_admin").hide();
     
});

$("#btn_quest_auto_eval").click(function(){

    
    
    $("#container_form_eval_autoeval_admin").show("fast");
    $("#container_impact_forma_admin").hide();
    $("#container_form_eval_formateur_admin").hide();
    $("#container_form_eval_formation_admin").hide();
     
});

$("#btn_quest_impact_forma").click(function(){


    $("#container_impact_forma_admin").show("fast");
    $("#container_form_eval_autoeval_admin").hide();
    $("#container_form_eval_formateur_admin").hide();
    $("#container_form_eval_formation_admin").hide();
    
     
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

function search3() {

  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("input_form_client");
  filter = input.value.toUpperCase();
  table = document.getElementById("table_tab_client");
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

function search4() {

  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("input_com1");
  filter = input.value.toUpperCase();
  table = document.getElementById("table_tab_com1");
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

function search5() {

  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("input_com2");
  filter = input.value.toUpperCase();
  table = document.getElementById("table_tab_com2");
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

$('#com_sem3').submit(function() {

    $('#label_btn_valid_com3').hide();
    $('.loader').show();
});

$('#form_eval_formateur_modifiable').submit(function() {

    $('#label_btn_valid_quest_formateur_admin').hide();
    $('.loader').show();
});

$('#form_eval_formation_modifiable').submit(function() {

    $('#label_btn_valid_quest_formation_admin').hide();
    $('.loader').show();
});

$('#form_compte_rendu_admin').submit(function() {

    $('#label_btn_add_eval_form_admin').hide();
    $('.loader').show();
});

$('#form_impact_client_admin').submit(function() {

    $('#label_btn_valid_eval_admin').hide();
    $('.loader').show();
});


























