<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Questionnaires extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires', function (Blueprint $table) {

            $table->increments('id');
            $table->text('champ1', 300);
            $table->text('champ2', 300);
            $table->text('champ3', 300);
            $table->text('champ4', 300);
            $table->text('champ5', 300);
            $table->text('champ6', 300);
            $table->text('champ7', 300);
            $table->text('champ8', 300);
            $table->text('champ9', 300);
            $table->text('champ10', 300);
            $table->text('champ11', 300);
            $table->text('champ12', 300);
            $table->text('champ13', 300);
            $table->text('champ14', 300);
            $table->text('champ15', 300);
            $table->text('champ16', 300);
            $table->text('champ17', 300);
            $table->text('champ18', 300)->nullable();
            $table->text('champ19', 300)->nullable();
            $table->text('champ20', 300)->nullable();
            $table->text('champ21', 300)->nullable();
            $table->text('champ22', 300)->nullable();

            
        });

        DB::table('questionnaires')->insert(

            array(

                'champ1' => 'Le formateur sait transmettre ses connaissances (maitrise son sujet, donne des exemples pratiques)',
                'champ2' => 'Le formateur sait mobiliser les participants (donne envie d\'apprendre, fait participer)',
                'champ3' => 'Le formateur sait s\'adapter à chaque participant (personnalise son message, s\'adapte au contexte de chacun)',
                'champ4' => 'Le formateur a des points forts',
                'champ5' => 'Les supports utilisés en formation étaient utiles pour apprendre (documents, vidéos)',
                'champ6' => 'La progression pédagogique est adaptée (rythme, difficulté progressive, équilibre théorie/pratique...)',
                'champ7' => 'L\'alternance de moments de « théorie » avec des travaux pratiques vous a-t-elle semblée équilibrée',
                'champ8' => 'Le niveau du formateur vous a semblé correct',
                'champ9' => 'Le formateur a tenu un langage clair',
                'champ10' => 'Le formateur a respecté le contenu du programme, il vous a aidé à atteindre les objectifs',
                'champ11' => 'Il y a eu une adaptation au rythme, au contenu',
                'champ12' => 'La qualité des exemples cités',
                'champ13' => 'Le niveau des aptitudes (élocution, postures, tenue)',
                'champ14' => 'Le niveau de compétences et de disponibilité',
                'champ15' => 'Globalement, j\'ai été très satisfait(e) du formateur',
                'champ16' => 'Si vous deviez suivre à nouveau une formation, le feriez-vous volontiers avec ce formateur ?',
                'champ17' => 'Recommanderiez-vous ce formateur à un centre de formation ou à une entreprise ?',
               
            )

        );

        DB::table('questionnaires')->insert(

            array(

                'champ1' => 'Adéquation de la formation avec vos objectifs d\'emploi',
                'champ2' => 'Parcours de formation adapté à votre niveau',
                'champ3' => 'Durée de la formation',
                'champ4' => 'Efficacité du parcours proposé',
                'champ5' => 'Disponibilité du formateur',
                'champ6' => 'Qualité d\'animation du formateur',
                'champ7' => 'Maîtrise du sujet et connaissance du secteur/métier par le formateur',
                'champ8' => 'Qualité des supports pédagogiques de la formation',
                'champ9' => 'Homogénéité du groupe',
                'champ10' => 'Participation du groupe',
                'champ11' => 'Ambiance générale de la formation',
                'champ12' => 'Qualités des informations communiquées',
                'champ13' => 'Clarté des critères de sélection',
                'champ14' => 'Qualité des entretiens et des tests de recrutement',
                'champ15' => 'Accompagnement pour la constitution du dossier de rémunération',
                'champ16' => 'Accueil et service',
                'champ17' => 'Qualité des salles de formation',
                'champ18' => 'Qualité du matériel utilisé',
                'champ19' => 'Accessibilité des locaux',
                'champ20' => 'Vos commentaires sur cette formation (200 caractères maximum).',
                'champ21' => 'Vous avez particulierement apprécié : (200 caractères maximum).',
                'champ22' => 'Vos suggestions d\'amélioration : (200 caractères maximum).',
               
            )

        );

        DB::table('questionnaires')->insert(

            array(

                'champ1' => '1/ Auto évaluation',
                'champ2' => '¤ Evaluez votre performance durant cette session',
                'champ3' => '¤ Avez vous atteint les objectifs du séminaire ?',
                'champ4' => '(Si oui, quels sont les éléments qui vous permette de l\'affirmer ? Si non, pour quelles raisons ? Qu’auriez-vous dû faire ?)',

                'champ5' => '2/ Contenu et Pédagogie',
                'champ6' => '¤ Avez-vous apporté des modifications significatives (déroulé, contenu, timing, supports, outils) ?',
                'champ7' => '(Si oui lesquelles ? Si non, saisissez non)',
                'champ8' => '3/ Matériel et logistique',
                'champ9' => '¤ Matériel d\'animation',
                'champ10' => '¤ Supports Animateurs',
                'champ11' => '¤ Documents Participants',
                'champ12' => '¤ Accès au lieu de formation',
                'champ13' => '¤ Salles',
                'champ14' => '¤ Mobilier',
                'champ15' => '¤ Accueil',
                'champ16' => '¤ Pauses',
                'champ17' => '¤ Repas',
                'champ18' => '4/ Et demain',
                'champ19' => '¤  D’une manière générale, quelles sont vos idées, vos suggestions pour améliorer et développer ensemble notre efficacité ?',
               
            )

        );

        DB::table('questionnaires')->insert(

            array(

                'champ1' => 'EVALUATION DES IMPACTS « A FROID » PAR L’ENTREPRISE',
                'champ2' => 'Il y a environs 3 mois de cela, un ou plusieurs de vos salariés ont suivi une formation dispensée par notre organisme de formation.',
                'champ3' => 'Aujourd’hui nous souhaiterions connaître l’impact que celle-ci a eu sur la ou les personnes formées ainsi que pour votre entreprise.',
                'champ4' => 'Un de nos conseillers pédagogiques se chargera de prendre contact avec vous afin de faire le point ensemble de votre évaluation. Au préalable, merci de bien vouloir consacrer quelques instants à remplir ce questionnaire en prévision de cet entretien.',

                'champ5' => 'INDENTIFICATION',
                'champ6' => '¤ ENTREPRISE',
                'champ7' => '¤ HIERARCHIE',
                'champ8' => '¤ FORMATION SUIVIE',
                'champ9' => 'EVALUATION DES OBJECTIFS DE PROGRES FIXES LORS DU DIAGNOSTIC INITIAL',
                'champ10' => 'INDICATEURS DE PROGRES QUANTITATIF',
                'champ11' => 'Ex : Nbre de non conformités sur une période, % de retours clients, nbre d’accidents du travail, nbre de salarié ayant suivi une formation …',
                'champ12' => 'INDICATEURS DE PROGRES QUALITATIFS',
                'champ13' => 'Cochez « sans objet », par exemple, si les salariés ne sont pas concernés, s’ils n’ont pas l’occasion de mettre en œuvre cette compétence ou si vous n’êtes pas en mesure d’observer des évolutions...',
                'champ14' => 'Organisation du travail et cohésion d’équipe',
                'champ15' => 'Sécurité au travail (respect de règles, accidents du travail…)',
                'champ16' => 'Utilisation des supports écrits professionnels',
                'champ17' => 'Respect des normes qualité et environnemental',
                'champ18' => 'Qualité de la relation client / usager',
                'champ19' => 'Fidélisation et/ou maintien dans l’emploi',
               
            )

        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
