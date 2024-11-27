<?php

function CreateCard($produit)
{
  return '
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <!-- IMG Cliquable -->
            <a href="?id_produit=' . htmlspecialchars($produit->id_produit) . '">
                <img src="' . htmlspecialchars($produit->photo) . '" alt="' . htmlspecialchars($produit->description) . '" class="card-img-top">
            </a>
            <div class="card-body">
                <h5 class="card-title">' . ucfirst(htmlspecialchars($produit->titre)) . '</h5>
                <h6 class="card-subtitle mb-2 text-muted">' . number_format($produit->prix, 2, ',', '') . ' €</h6>
                <p class="card-text">' . htmlspecialchars($produit->description) . '</p>
            </div>
        </div>
    </div>';
}

$res = executeRequete("SELECT DISTINCT categorie FROM produit");

$contenue_gauche = '<div class="list-group">';
$contenue_gauche .= '<a href="?categorie=tous" class="list-group-item list-group-item-action">Tous les produits</a>';

// Autres catégories
while ($cat = $res->fetch(PDO::FETCH_OBJ)) {
  $contenue_gauche .= "<a href='?categorie=" . htmlspecialchars($cat->categorie) . "' class='list-group-item list-group-item-action'>" . ucfirst(htmlspecialchars($cat->categorie)) . "</a>";
}

$contenue_gauche .= '</div>';

// filtre des produits affichés
if (isset($_GET['categorie']) && $_GET['categorie'] !== 'tous') {
  $res = executeRequete("SELECT * FROM produit WHERE categorie = :categorie", [
          ':categorie' => $_GET['categorie']
  ]);
} else {
  $res = executeRequete("SELECT * FROM produit");
}

// Affichage des produits
while ($produit = $res->fetch(PDO::FETCH_OBJ)) {
  $contenue_droite .= CreateCard($produit);
}

?>

<!DOCTYPE html>
<main class="countainer" style="min-height: 80vh;">
  <div class="container">
    <h1 class="mt-4">Vêtements</h1>

    <div class="row">
      <div class="col-lg-3">
        <?php echo $contenue_gauche; // pour afficher les catégories ?>
      </div>
      <div class="col-lg-9">
        <div class="row">
          <?php echo $contenue_droite; // pour afficher les produits ?>
        </div>
      </div>
    </div><!-- .row -->
  </div>
</main>