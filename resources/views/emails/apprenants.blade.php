<!DOCTYPE html>
  <html lang="fr">
      <head>
        <meta charset="utf-8">
      </head>
      <body>
        <h4>Madame, Monsieur {{ $data['nom'] }}</h4>
        <br>
        <p>Vous allez suivre une formation dispensée par notre organisme JR Formation, pour mener à bien votre expérience votre profil a été créé sur notre extranet à l'adresse http://www.jr_formation/extranet.com</p>
        <br>
        <p>Vous pouvez dès à présent vous connecter grâce aux identifiants suivant :</p>
        <ul>
            <li><strong>ID -> {{ $data['email'] }}</strong></li>
            <li><strong>Mdp -> {{ $data['mdp'] }} </strong></li>
        </ul>
        <br>
        <p>Vous trouverez votre programme de formation, ainsi que 2 questionnaires, l'un pour évaluer la formation, l'autre pour évaluer votre formateur. De plus vous pourrez publier un commentaire pour chaque semaine de formation. L'objectif étant d'améliorer nos formations continuellement</p>
        <p>Merci pour le temps que vous nous consacrez et bon courage pour votre formation!</p>

        <p>A bientôt,</p>

        <h4>L'équipe JR Formation.</h4>
        <br>
        <br>
        <img src="/img/image005.jpg" class="css-class" alt="alt text">
      </body>
  </html>