<div class="row mt-3">
  <div class="col-12">
    <h1><?php echo ucfirst($titre) ?></h1>
  </div>
  <!-- /.col-12 -->
</div>
<!-- /.row mt-3 -->

<!-- .col-md-8>img.img-fluid -->
<div class="col-md-8">
  <img src="<?php echo '../' . $photo; ?>" alt="<?php echo $titre; ?>" class="img-fluid">
</div>

<div class="col-mb-4">
  <h3>description</h3>
  <p><?php echo ucfirst($description); ?></p>
  <h3>Détails</h3>
  <ul>
    <li>Catégorie : <?php echo $categorie ?></li>
    <li>Couleur : <?php echo $couleur ?></li>
    <li>Taille : <?php echo $taille ?></li>
  </ul>
  <h4>Prix : <?php echo number_format($prix, 2, ',', ''); ?> &euro;</h4>

  <?php echo $panier; ?>

  <p class="d-grid">
    <a href="../index.php?categorie=<?php echo $categorie ?>" class="btn btn-outline-primary">
      Retour en rayon <span style="font-weight: bold;"><?php echo $categorie ?></span>
    </a>
  </p>
</div>