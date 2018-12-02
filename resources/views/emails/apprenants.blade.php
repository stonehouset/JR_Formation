<!DOCTYPE html>
  <html lang="fr">
      <head>
        <meta charset="utf-8">
      </head>
      <body>
        <h4>Madame, Monsieur {{ $data['nom'] }}</h4>
        <br>
        <p>Vous allez suivre une formation dispensée par notre organisme JRT Formation, pour mener à bien votre expérience votre profil a été créé sur notre extranet à l'adresse http://www.jrt_formation/extranet.com</p>
        <br>
        <p>Vous pouvez dès à présent vous connecter grâce aux identifiants suivants :</p>
        <ul>
            <li><strong>ID -> {{ $data['email'] }}</strong></li>
            <li><strong>Mdp -> {{ $data['mdp'] }} </strong></li>
        </ul>
        <br>
        <p>Cet espace vous permet de :</p>
        <ul>
            <li>Consulter/Télécharger votre programme de formation.</li>
            <li>Compléter un questionnaire pour évaluer le formateur.</li>
            <li>Compléter un questionnaire pour évaluer la formation.</li>
            <li>Ecrire un commentaire sur chaque semaine de formation.</li>
        </ul>
        <p>Merci pour le temps que vous nous consacrez et bon courage pour votre formation!</p>
        <p>Par sécurité vous êtes invité à modifier votre mot passe dans l'onglet Profil->Modifier votre mot de passe</p>

        <p>A bientôt,</p>

        <h4>L'équipe JRT Formation.</h4>
        <br>
        <br>
      </body>
  </html>