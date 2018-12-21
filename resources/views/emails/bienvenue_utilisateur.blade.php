<!DOCTYPE html>
  <html lang="fr">
      <head>
        <meta charset="utf-8">
      </head>
      <body>
        <h4>Madame, Monsieur {{ $data['nom'] }}</h4>
        <br>
        @if ( $data['role']  == 3)
          <p>Votre profil d'Administrateur a été créé sur notre extranet à l'adresse www.jrt-formation-extranet.fr</p>
        @endif
        @if ( $data['role']  == 2)
          <p>Votre profil de Client a été créé sur notre extranet à l'adresse www.jrt-formation-extranet.fr</p>
        @endif
        @if ( $data['role']  == 1)
          <p>Votre profil de Formateur a été créé sur notre extranet à l'adresse www.jrt-formation-extranet.fr</p>
        @endif
        <br>
        <p>Vous pouvez vous connecter grâce aux identifiants suivants :</p>
        <ul>
            <li><strong>ID : {{ $data['email'] }}</strong></li>
            <li><strong>Mot de passe : {{ $data['mdp'] }}</strong></li>
        </ul>
        <br>
        @if ( $data['role'] == 3)

          <p>Cet espace vous servira à gérer les utilisateurs (apprenants, formateurs, clients, admins) ainsi que les formations. </p>

        @endif
        @if ( $data['role'] == 2)

          <p>Cet espace vous permet de visualiser et de gérer le suivi des apprenants à votre compte : </p>
          <ul>
            <li> Liste des apprenants.</li>
            <li> Suivi des apprenants en entreprise.</li>
            <li> Formulaire d'évaluation de l'impact de l'action de formation sur votre entreprise.</li>
          </ul>

        @endif
        @if ( $data['role']  == 1)

          <p>Cet espace vous permet de visualiser et de gérer le suivi des apprenants qui vous ont été attribués : </p>
          <ul>
            <li> Liste des apprenants</li>
            <li> Possibilité d'envoyer un commentaire /jour /apprenant.</li>
            <li> Possibilité d'envoyer un commentaire /jour /formation.</li>
            <li> Possibilité de signaler le retard ou l'absence d'un apprenant.</li>
            <li> Possibilité d'attribuer une note /20 à un apprenant.</li>
          </ul>

        @endif
        <p>Par sécurité vous êtes invité à modifier votre mot passe dans l'onglet Profil -> Modifier votre mot de passe</p>
        <p>A bientôt,</p>

        <h4>L'équipe JRT Formation.</h4>
        <br>
        <br>
      </body>