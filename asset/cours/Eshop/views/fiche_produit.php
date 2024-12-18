<?php

/**
 * 2- Traitement PHP
 */
// Variable d'affichage 
$panier = '';
$suggestion = '';

// 2.1 - Vérifier l'existence du produit en BDD (stock > 0)
if (isset($_GET['id_produit'])) {
  $res = executeRequete("SELECT * FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit']));
  $id_produit = $_GET['id_produit'];

  if ($res->rowCount() === 0) {
    header('location : ../index.php');
    exit;
  }

  // 2.2 - Afficher les infos du produit
  $produit = $res->fetch(PDO::FETCH_ASSOC); // On ne fait pas de while car on n'a qu'une seul ligne
  extract($produit);

  if ($stock > 0) {
    // On met le bouton du panier
    $panier .= '<hr><form method="post" action="views/panier.php"   class="d-grid gap-3">';
    $panier .= '<input type="hidden" name="id_produit" value="' . $id_produit . '">'; // Ajout l'id du produit au panier

    // Select de quantité 
    $panier .= '<select name="quantite" class="form-select col-sm-2"';
    for ($i = 0; $i <= $stock && $i <= 5; $i++) {
      $panier .= '<option>' . $i . '</option>';
    }
    $panier .= '</select>';

    $panier .= '<input type="submit" name="ajout_panier" value="Ajouter au panier" class="btn btn-outline-success">';

    $panier .= '</form>';
    $panier .= '<hr>';

    if ($stock <= 5) {
      $panier .= '<div class="alert alert-warning mt-4">Vite ... plus que ' . $stock . ' en stock !</div>';
    }
  } else { // If($stock < 0) {}
    $panier .= '<hr><div class="alert alert-danger">Ce produit reviens bientôt !</div><hr>';
  }

  // Exercice :
  $res = executeRequete("SELECT * FROM produit WHERE categorie = :categorie AND id_produit != :id_produit ORDER BY RAND() LIMIT 2", array(
    ':categorie' => $produit['categorie'],
    ':id_produit' => $produit['id_produit']
  ));
  if ($res->rowCount() < 1) {
    $suggestion .= '<h4>Pas de Suggestion pour cet article</h4>';
  } else {
    while ($produit = $res->fetch(PDO::FETCH_OBJ)) {
      $suggestion .= '
      <a href="?id_produit=' . $produit->id_produit . '" class="text-decoration-none">
          <div class="card">
              <img src="./' . $produit->photo . '" alt="' . htmlspecialchars($produit->titre, ENT_QUOTES) . '" class="img-fluid">
              <div class="card-body">
                  <strong class="card-title text-center d-block">' . htmlspecialchars(ucfirst($produit->titre), ENT_QUOTES) . '</strong>
              </div>
          </div>
      </a>';
    }
  }
} else {
  header("location : " . RACINE_SITE . 'index.php');
  exit;
}



?>

<div class="row mt-3">
  <div class="col-12">
    <h1><?php echo ucfirst($titre); ?></h1>
  </div>
  <!-- /.col-12 -->

  <!-- .col-md-8>img.img-fluid -->
  <div class="col-md-8">
    <img src="<?php echo './' . $photo; ?>" alt="<?php echo $titre; ?>" class="img-fluid">
  </div>

  <!--.col-md-4>h3{Description}+p+h3{Détails}+ul>(li*3)^+h4-->
  <div class="col-md-4">
    <h3>Description</h3>
    <p><?php echo ucfirst($description); ?></p>
    <h3>Détails</h3>
    <ul>
      <li>Catégorie : <?php echo $categorie; ?></li>
      <li>Couleur : <?php echo $couleur; ?></li>
      <li>Taille : <?php echo $taille; ?></li>
    </ul>
    <h4>Prix : <?php echo number_format($prix, 2, ',', ' '); ?> &euro;</h4>

    <?php echo $panier; ?>

    <!--    p.d-grid>a.btn.btn-outline-primary>span-->
    <p class="d-grid">
      <a href="?categorie=<?php echo $categorie; ?>" class="btn btn-outline-primary">
        << Retour au rayon <span style="font-weight: bold;
            "><?php echo $categorie; ?></span>
      </a>
    </p>
  </div>
</div>
<hr>
<div class="row mt-3">
  <div class="col-12">
    <h3>Suggestion</h3>
  </div>

  <div class="d-flex gap-3">
    <?php echo $suggestion; ?>
  </div>
</div>