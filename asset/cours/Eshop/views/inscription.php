<?php
include_once '../inc/init.inc.php';
include_once '../inc/functions.inc.php';

$flag = true; // Afficher le Formulaire tant que l'inscription n'est pas réussie
$contenu = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $is_valid = true;

  // Validation de chaque champ et ajout d'erreurs au contenu si nécessaire
  if (!isset($_POST['pseudo']) || strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 20) {
    $contenu .= '<div class="alert alert-danger">Le pseudo doit contenir entre 4 et 20 caractères.</div>';
    $is_valid = false;
  }

  if (!isset($_POST['mdp']) || strlen($_POST['mdp']) < 4 || strlen($_POST['mdp']) > 40) {
    $contenu .= '<div class="alert alert-danger">Le mot de passe doit contenir entre 4 et 40 caractères.</div>';
    $is_valid = false;
  }

  if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20) {
    $contenu .= '<div class="alert alert-danger">Le pseudo doit contenir entre 2 et 20 caractères.</div>';
    $is_valid = false;
  }

  if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20) {
    $contenu .= '<div class="alert alert-danger">Le prénom doit contenir entre 2 et 20 caractères.</div>';
    $is_valid = false;
  }

  if (!isset($_POST['ville']) || strlen($_POST['ville']) < 2 || strlen($_POST['ville']) > 75) {
    $contenu .= '<div class="alert alert-danger">La ville doit contenir entre 2 et 20 caractères.</div>';
    $is_valid = false;
  }

  if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 4 || strlen($_POST['adresse']) > 50) {
    $contenu .= '<div class="alert alert-danger">L\'adresse doit contenir entre 4 et 50 caractères.</div>';
    $is_valid = false;
  }

  if (!isset($_POST['civilite']) || ($_POST['civilite'] != 'm' && $_POST['civilite'] != 'f')) {
    $contenu .= '<div class="alert alert-danger">La civilité est incorrecte</div>';
    $is_valid = false;
  }

  if (!isset($_POST['code_postal']) || !preg_match('#^[0-9]{5}$#', $_POST['code_postal'])) {
    $contenu .= '<div class="alert alert-danger">Le code postal est incorrect.</div>';
    $is_valid = false;
  }

  if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $contenu .= '<div class="alert alert-danger">L\'email est invalide.</div>';
    $is_valid = false;
  }

  if ($is_valid) {
    // Le pseudo est libre ?
    $membre = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo", array(':pseudo' => $_POST['pseudo']));

    if ($membre->rowCount() > 0) {
      $contenu .= '<div class="alert alert-danger">Le pseudo est déja utilisé.</div>';
    } else {
      executeRequete("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse, statut) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :ville, :code_postal, :adresse, 0)", array(
        ':pseudo' => $_POST['pseudo'],
        ':mdp' => password_hash($_POST['mdp'], PASSWORD_DEFAULT),
        ':nom' => $_POST['nom'],
        ':prenom' => $_POST['prenom'],
        ':email' => $_POST['email'],
        ':civilite' => $_POST['civilite'],
        ':ville' => $_POST['ville'],
        ':code_postal' => $_POST['code_postal'],
        ':adresse' => $_POST['adresse']
      ));

      $contenu .= '<div class="alert alert-success">Vous êtes inscrit. <a href="connexion.php">Se connecter.</a></div>';
      $flag = false;
      $_POST = [];
    }
  }

}

?>


<!DOCTYPE html>
<html lang='FR-fr'>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Inscription</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <meta name='description' content='Eshop Page'>
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

  <?php
  require_once '../inc/header.inc.php'; ?>

  <main class="container py-5" style="min-height: 80vh;">
    <div class="text-center">
      <h1 class="mb-4">Inscription</h1>
    </div>

    <?php
    echo $contenu;

    if ($flag): // Affiche le formulaire si l'utilisateur n'est pas encore inscrit
      ?>

      <div class="alert alert-info text-center" role="alert">
        Veuillez renseigner le formulaire pour vous inscrire.
      </div>

      <form action="" method="post" class="container mt-4">
        <div class="row g-4">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="pseudo" class="form-label">Pseudo</label>
              <input type="text" id="pseudo" name="pseudo" class="form-control"
                value="<?php echo $_POST['pseudo'] ?? ''; ?>">
            </div>

            <div class="mb-3">
              <label for="mdp" class="form-label">Mot de passe</label>
              <input type="password" id="mdp" name="mdp" class="form-control" value="<?php echo $_POST['mdp'] ?? ''; ?>">
            </div>

            <div class="mb-3">
              <label for="nom" class="form-label">Nom</label>
              <input type="text" id="nom" name="nom" class="form-control" value="<?php echo $_POST['nom'] ?? ''; ?>">
            </div>

            <div class="mb-3">
              <label for="prenom" class="form-label">Prénom</label>
              <input type="text" id="prenom" name="prenom" class="form-control"
                value="<?php echo $_POST['prenom'] ?? ''; ?>">
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email" class="form-control"
                value="<?php echo $_POST['email'] ?? ''; ?>">
            </div>

            <div class="mb-3">
              <label class="form-label">Civilité</label><br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="civilite" id="civilite_homme" value="m" checked>
                <label class="form-check-label" for="civilite_homme">Homme</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="civilite" id="civilite_femme" value=" 
            <?php if (isset($_POST['civilite']) && $_POST['civilite'] == 'f')
              echo 'checked'; ?>">
                <label class="form-check-label" for="civilite_femme">Femme</label>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="mb-3">
              <label for="ville" class="form-label">Ville</label>
              <input type="text" id="ville" name="ville" class="form-control"
                value="<?php echo $_POST['ville'] ?? ''; ?>">
            </div>

            <div class="mb-3">
              <label for="code_postal" class="form-label">Code Postal</label>
              <input type="text" id="code_postal" name="code_postal" class="form-control"
                value="<?php echo $_POST['code_postal'] ?? ''; ?>">
            </div>

            <div class="mb-3">
              <label for="adresse" class="form-label">Adresse</label>
              <textarea name="adresse" id="adresse" class="form-control"
                rows="5"><?php echo $_POST['adresse'] ?? ''; ?></textarea>
            </div>
          </div>
        </div>

        <div class="d-grid mt-4">
          <input type="submit" value="S'inscrire" name="inscription" class="btn btn-info">
        </div>
      </form>

    <?php endif; ?>
  </main>


  <?php require_once '../inc/footer.inc.php'; ?>

  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</body>

</html>