<!DOCTYPE html>
  <html lang="fr">
      <head>
        <meta charset="utf-8">
      </head>
      <body>
        <h4>Madame, Monsieur {{ $data['nom'] }}</h4>
        <br>
        <p>Vous allez suivre une formation dispensée par notre organisme JRT Formation, pour mener à bien votre expérience, votre profil a été créé sur notre extranet à l'adresse www.jrt-formation-extranet.fr</p>
        <br>
        <p>Vous pouvez vous connecter grâce aux identifiants suivants :</p>
        <ul>
            <li><strong>ID : {{ $data['email'] }}</strong></li>
            <li><strong>Mdp : {{ $data['mdp'] }} </strong></li>
        </ul>
        <br>
        <p>Cet espace vous permet de :</p>
        <ul>
            <li>Consulter/Télécharger votre programme de formation.</li>
            <li>Compléter un questionnaire pour évaluer le formateur.</li>
            <li>Compléter un questionnaire pour évaluer la formation.</li>
            <li>Ecrire un commentaire sur chaque semaine de formation.</li>
        </ul>
        <p>Par sécurité vous êtes invité à modifier votre mot passe dans l'onglet Profil->Modifier votre mot de passe</p>

        <p>Bon courage et à bientôt,</p>

        <h4>L'équipe JRT Formation.</h4>
        <br>
        <br>
      </body>
  </html>