<?php

require_once "../inc/init.inc.php";

// User non connecté
if (!internantesEstConnecte()) {
  global $contenu;
  $contenu = '<div class="alert alert-info">Vous devez être connecter pour ajouter des articles à votre panier.</div>';
  header('location: connexion.php');
  exit();
}

// Récupérer les infos en sesion
$test = extract($_SESSION['membre']);
?>

<!DOCTYPE html>
<html lang='FR-fr'>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Connexion</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    .card img {
      height: 17.5rem;
      width: 100%;
      object-fit: cover;
      object-position: top;
    }
  </style>
</head>

<body>

  <?php require_once '../inc/header.inc.php'; ?>

  <main class="container d-flex flex-column justify-content-center" style="min-height: 80vh;">
    <h1 class="mt-4">Profil</h1>

    <h2>Bonjour <strong><?php echo htmlspecialchars($prenom) ?></strong></h2>

    <?php
    if (internantesEstConnecteEtAdmin()) {
      echo '<p>Vous êtes un des administrateurs du site.</p>';
    }
    ?>

    <hr>

    <h3>Voici vos informations de profil</h3>

    <table class="table table-dark table-hover table-striped">
      <thead>
        <tr>
          <th scope="col">Informations</th>
          <th scope="col">Détails</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>Votre email</th>
          <td><?php echo htmlspecialchars($email); ?></td>
        </tr>
        <tr>
          <th>Votre adresse</th>
          <td><?php echo htmlspecialchars($adresse); ?></td>
        </tr>
        <tr>
          <th>Votre ville</th>
          <td><?php echo htmlspecialchars($ville); ?></td>
        </tr>
        <tr>
          <th>Votre numéro client</th>
          <td><?php echo htmlspecialchars($id_membre); ?></td>
        </tr>
      </tbody>
    </table>

  </main>

  <?php require_once '../inc/footer.inc.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>