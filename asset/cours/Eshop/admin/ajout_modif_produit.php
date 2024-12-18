<?php
require_once "../inc/init.inc.php";

// 1 - Vérification des droits admin
if (!internantesEstConnecteEtAdmin()) {
  header('location: ../views/connexion.php');
  exit();
}

// 2 - Initialisation des variables pour le formulaire
$id_produit = $reference = $categorie = $titre = $description = $couleur = $taille = $public = $photo = $prix = $stock = "";

// 3 - Si on est sur l'UPDATE, on récupère les données en BDD
if (isset($_GET['action']) && $_GET['action'] == 'modifier' && isset($_GET['id_produit'])) {
  $res = executeRequete("SELECT * FROM produit WHERE id_produit = :id_produit", [':id_produit' => $_GET['id_produit']]);
  $produit = $res->fetch(PDO::FETCH_ASSOC);

  if ($produit) {
    extract($produit);
  } else {
    $contenu .= '<div class="alert alert-danger">Erreur : le produit n\'existe pas.</div>';
  }
}

// 4 - Traitement du formulaire en POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Variable pour la photo
  $photo_bdd = $photo ?? '';

  // Gestion du fichier photo si on insère une nouvelle image
  if (!empty($_FILES['photo']['name'])) {
    $nom_photo = $_FILES['photo']['name'];
    $photo_bdd = "photo/$nom_photo";
    $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE . $photo_bdd; // Chemin absolue sur le serveur

    // Vérification de l'extension du fichier
    $extensions_autorisees = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $extension = strtolower(pathinfo($nom_photo, PATHINFO_EXTENSION));

    // Si l'extension pas ok -> msg Erreur
    if (!in_array($extension, $extensions_autorisees)) {
      $contenu .= '<div class="alert alert-danger">Erreur lors du chargement de la photo.</div>';
    } else {
      if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photo_dossier)) {
        $contenu .= '<div class="alert alert-danger">Erreur lors du téléchargement de la photo.</div>';
      }
    }
  }

  // Vérification si c'est une modification ou un ajout
  if (isset($_GET['action']) && $_GET['action'] == 'modifier') {
    $requete = "UPDATE produit SET reference = :reference, categorie = :categorie, titre = :titre, description = :description, couleur = :couleur, taille = :taille, public = :public, photo = :photo, prix = :prix, stock = :stock WHERE id_produit = :id_produit";

    $param = [
      ':reference' => $_POST['reference'],
      ':categorie' => $_POST['categorie'],
      ':titre' => $_POST['titre'],
      ':description' => $_POST['description'],
      ':couleur' => $_POST['couleur'],
      ':taille' => $_POST['taille'],
      ':public' => $_POST['public'],
      ':photo' => $photo_bdd,
      ':prix' => $_POST['prix'],
      ':stock' => $_POST['stock'],
      ':id_produit' => $_POST['id_produit']
    ];
  } else {
    // Ajout d'un nouveau produit
    $requete = "INSERT INTO produit (reference, categorie, titre, description, couleur, taille, public, photo, prix, stock) VALUES (:reference, :categorie, :titre, :description, :couleur, :taille, :public, :photo, :prix, :stock)";

    $param = [
      ':reference' => $_POST['reference'],
      ':categorie' => $_POST['categorie'],
      ':titre' => $_POST['titre'],
      ':description' => $_POST['description'],
      ':couleur' => $_POST['couleur'],
      ':taille' => $_POST['taille'],
      ':public' => $_POST['public'],
      ':photo' => $photo_bdd,
      ':prix' => $_POST['prix'],
      ':stock' => $_POST['stock']
    ];
  }

  // Exécution de la requête préparée
  $res = executeRequete($requete, $param);
  if ($res) {
    $contenu .= '<div class="alert alert-succes">Produit enregistré.</div>';
  } else {
    $contenu .= '<div class="alert alert-warning">Produit non-enregistré.</div>';
  }

  header('Location: gestion_boutique.php');
  exit();

}






?>

<!DOCTYPE html>
<html lang='FR-fr'>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Gestion Boutique</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    /* .card img {
      height: 17.5rem;
      width: 100%;
      object-fit: cover;
      object-position: top;
    } */

    .img-thumbnail {
      height: 100px;
      min-width: 100px;
      width: fit-content;
      object-fit: contain;
    }
  </style>
</head>

<body>

  <?php require_once '../inc/header.inc.php'; ?>

  <main class="container d-flex flex-column justify-content-center" style="min-height: 80vh;">
    <!-- Interface -->
    <h1 class="mt-4">Ajout/Modification d'un produit</h1>

    <!-- Formulaire d'ajout/modification de produit -->
    <form method="POST" enctype="multipart/form-data" class="mt-4">
      <div class="mb-3">
        <label for="reference" class="form-label">Référence</label>
        <input type="text" name="reference" id="reference" class="form-control"
          value="<?php echo htmlspecialchars($reference); ?>" required>
      </div>
      <div class="mb-3">
        <label for="categorie" class="form-label">Catégorie</label>
        <input type="text" name="categorie" id="categorie" class="form-control"
          value="<?php echo htmlspecialchars($categorie); ?>" required>
      </div>
      <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <input type="text" name="titre" id="titre" class="form-control" value="<?php echo htmlspecialchars($titre); ?>"
          required>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control"
          required><?php echo htmlspecialchars($description); ?></textarea>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="couleur" class="form-label">Couleur</label>
          <input type="text" name="couleur" id="couleur" class="form-control"
            value="<?php echo htmlspecialchars($couleur); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="taille" class="form-label">Taille</label>
          <input type="text" name="taille" id="taille" class="form-control"
            value="<?php echo htmlspecialchars($taille); ?>" required>
        </div>
      </div>
      <div class="mb-3">
        <label for="public" class="form-label">Public</label>
        <select name="public" id="public" class="form-select" required>
          <option value="Homme" <?php echo ($public == 'Homme') ? 'selected' : ''; ?>>Homme</option>
          <option value="Femme" <?php echo ($public == 'Femme') ? 'selected' : ''; ?>>Femme</option>
          <option value="Mixte" <?php echo ($public == 'Mixte') ? 'selected' : ''; ?>>Mixte</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="photo" class="form-label">Photo</label>
        <input type="file" name="photo" id="photo" class="form-control">
        <!-- pour éviter les erreurs on n'affiche la photo que s'il y en a une -->
        <?php if (!empty($photo)): ?>
          <p class="form-text">Actuelle : <img src="../<?php echo $photo; ?>" style="width:100px; height:100px;"
              alt="Photo actuelle"></p>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="prix" class="form-label">Prix</label>
        <input type="number" name="prix" id="prix" class="form-control" value="<?php echo $prix; ?>" step="0.01"
          required>
      </div>

      <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" name="stock" id="stock" class="form-control" value="<?php echo $stock; ?>" required>
      </div>

      <input type="hidden" name="id_produit" value="<?php echo $id_produit; ?>">

      <div class="d-grid">
        <button type="submit" class="btn btn-outline-success">
          <?php echo isset($_GET['action']) && $_GET['action'] == 'modifier' ? 'Modifier' : 'Ajouter'; ?> le produit
        </button>
      </div>
    </form>
  </main>

  <?php require_once '../inc/footer.inc.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <!-- FontAwesome -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet"> -->
  <script src="https://kit.fontawesome.com/9de8273207.js" crossorigin="anonymous"></script>
</body>

</html>