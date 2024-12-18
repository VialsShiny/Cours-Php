<?php
require_once '../inc/init.inc.php';

if (!isset($_SESSION['membre'])) {
    header("Location:" . RACINE_SITE . 'views/connexion.php?action=required');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['payer'])) {
        if (isset($_SESSION['panier']) && !empty($_SESSION['panier']['id_produit'])) {
            try {
                $res = executeRequete("INSERT INTO commande (id_membre, montant, date_enregistrement, etat) VALUES (:id_membre, :montant, :date, :etat)", [
                    ':id_membre' => $_SESSION['membre']['id_membre'],
                    ':date' => date('Y-m-d h:i:s'),
                    ':montant' => montantTotal(),
                    'etat' => "en cours de traitement"
                ]);
            } catch (Exception $e) {
                $contenu = '';
                $contenu .= '<div class="alert alert-danger">Il y a eu une erreur lors du payement ! Error Type :' . $e . '</div>';
            } finally {
                unset($_SESSION['panier']);
                $contenu .= '<div class="alert alert-success">Votre commande a bien été passer !</div>';
            }
        }
    }
}

// Ajout du panier
if (isset($_POST['ajout_panier'])) {

    $res = executeRequete("SELECT * FROM produit WHERE id_produit = :id_produit", [':id_produit' => $_POST['id_produit']]);

    $produit = $res->fetch(PDO::FETCH_OBJ);

    if ($produit) {
        ajouterProduitDansPanier($produit->titre, $produit->id_produit, $_POST['quantite'], $produit->prix);
    }
}

// Suppression d'un élément du panier
if (isset($_GET['action']) && $_GET['action'] == 'suppression') {
    retirerProduitDuPanier($_GET['id_produit']);
    $contenu .= '<div class="alert alert-success">Le produit a été supprimer du panier !</div>';
}

// Suppression de tous les éléments du panier
if (isset($_GET['action']) && $_GET['action'] == 'vider') {
    unset($_SESSION['panier']);
    $contenu .= '<div class="alert alert-success">Le Panier a bien été supprimer en entier.</div>';
}


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
        <div class="container my-4">
            <h2>Votre Panier</h2>
            <?php echo $contenu ?? ''; ?>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix Unitaire</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($_SESSION['panier']['id_produit'])): ?>
                        <tr>
                            <td colspan="5" class="text-center">Votre panier est vide.</td>
                        </tr>
                    <?php else: ?>
                        <?php for ($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($_SESSION['panier']['titre'][$i]); ?></td>
                                <td><?php echo number_format($_SESSION['panier']['prix'][$i], 2); ?> €</td>
                                <td><?php echo $_SESSION['panier']['quantite'][$i]; ?></td>
                                <td><?php echo number_format($_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i], 2); ?>
                                    €</td>
                                <td>
                                    <a href="?action=suppression&id_produit=<?php echo $_SESSION['panier']['id_produit'][$i]; ?>"
                                        class="btn btn-danger btn-sm">Supprimer</a>
                                </td>
                            </tr>
                        <?php endfor; ?>
                        <tr>
                            <td colspan="3" class="text-end">Total :</td>
                            <td colspan="2"><?php echo number_format(montantTotal(), 2); ?> €</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="d-flex justify-content-between mt-4">
                <a href="?action=vider" class="btn btn-warning">Vider le panier</a>
                <form method="POST">
                    <button type="submit" name="payer" class="btn btn-success">Payer</button>
                </form>
            </div>
        </div>
    </main>

    <?php require_once '../inc/footer.inc.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>