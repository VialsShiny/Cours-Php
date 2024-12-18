<?php
require_once "../inc/init.inc.php";

$contenu = '';

/**
 * Traitement
 */

// 1 - Si l'utilisateur n'est pas admin on redirige

if (!internantesEstConnecteEtAdmin()) {
  header('location: ../views/connexion.php');
  exit();
}

// 4 - Supprimer produits

if (isset($_GET['action']) && $_GET['action'] == 'supprimer' && isset($_GET['id_produit'])) {
  $id_produit = intval($_GET['id_produit']); // Sécurisation de l'id
  $res = executeRequete("SELECT photo FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $id_produit))->fetch(PDO::FETCH_OBJ);
  if ($res) {
    if (!empty($res->photo) && file_exists('../' . $res->photo)) {
      unlink('../' . $res->photo);
    }
    $produit = executeRequete("DELETE FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $id_produit));

    if ($produit->rowCount() === 1) {
      header('Location:' . RACINE_SITE . 'admin/gestion_boutique.php');
      exit();
    }
  } else {
    $contenu .= '<div class="alert alert-danger">Erreur lors de la suppression, le produit n°' . $id_produit . 'n\'existe pas.';
  }

} elseif (isset($_GET['action']) && $_GET['action'] == 'supprimerall') {
  $produit = executeRequete("DELETE FROM produit");
  header('Location:' . RACINE_SITE . 'admin/gestion_boutique.php');
  exit();
}

// 3 - Affiche produits

$res = executeRequete("SELECT id_produit AS 'ID', reference AS 'Référence', categorie AS 'Catégorie', 
                         titre AS 'Titre', description AS 'Description', couleur AS 'Couleur', 
                         taille AS 'Taille', public AS 'Public', photo AS 'Photo', prix AS 'Prix', stock AS 'Stock' FROM produit");

$stock_total = executeRequete("SELECT SUM(stock) as Total_Stock FROM produit")->fetch(PDO::FETCH_OBJ)->Total_Stock;

$contenu .= '<p class="text-end">Nombre de réfèrences : ' . $res->rowCount() . '</p>';
$contenu .= '<p class="text-end">Stock total : ' . ($stock_total ?: 0) . '</p>';

// Tableau d'affichage des produits

$contenu .= '<table class="table table-dark table-hover">';
$contenu .= '<thead><tr>';

// Entête dynamique

for ($i = 0; $i < $res->columnCount(); $i++) {
  $colonne = $res->getColumnMeta($i);
  $contenu .= '<th class="text-center">' . htmlspecialchars($colonne['name']) . '</th>';
}

$contenu .= '<th>Actions</th>';
$contenu .= '</tr></thead><tbody>';

// Ligne du tableau

while ($row = $res->fetch(PDO::FETCH_OBJ)) {
  $contenu .= '<tr>';
  foreach ($row as $key => $value) {
    if ($key == 'Photo' && !empty($value)) {
      $contenu .= '<td><img src="../' . htmlspecialchars($value) . '" alt="Produit" class="img-thumbnail cart-thumbnail w-3 h-3"></td>';
    } else {
      $contenu .= '<td class="text-center align-middle">' . htmlspecialchars($value) . '</td>';
    }
  }
  $contenu .= '<td class="d-grid gap-4 pt-3 pb-3">
                  <a href="ajout_modif_produit.php?action=modifier&id_produit=' . $row->ID . '" class="btn btn-outline-info btn-sm">
                      <i class="fa-solid fa-wrench fa-xl"></i>
                  </a>
                  <a href="?action=supprimer&id_produit=' . $row->ID . '" class="btn btn-outline-warning btn-sm" onclick="return confirm(\'Confirmez-vous la suppression?\')">
                      <i class="fa-solid fa-trash-can fa-xl"></i>
                  </a>
               </td>';
  $contenu .= '</tr>';
}

$contenu .= '</tbody></table>';

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
    <h1 class="mt-4">Gestion Boutique</h1>
    <ul class="nav nav-pills mb-4 gap-2 justify-content-between">
      <div class="d-flex gap-3">
        <li class="nav-item">
          <a class="btn btn-outline-primary btn-lg" role="button" href="gestion_boutique.php">Affichage des produits</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-danger btn-lg" role="button" href="ajout_modif_produit.php">Ajout d'un produit</a>
        </li>
      </div>
      <?php
      $random = rand(1, 100);
      if ($random == 52) { ?>
        <li class="nav-item d-flex">
          <a onclick="return confirm(\'Confirmez-vous la suppression?\')" href="?action=supprimerall"
            class="btn btn-outline-danger btn-lg">
            <i class="fa-solid fa-trash-can fa-xl"></i>
          </a>
        </li>
      <?php } ?>
    </ul>

    <div class="mt-6">

    </div>

    <?php
    echo $contenu;
    ?>
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