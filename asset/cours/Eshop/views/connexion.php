<?php
require_once '../inc/init.inc.php';

// Initialisation des variables
$message_connexion = '';
$message_deconnexion = '';

if(isset($_GET['action']) && $_GET['action'] == 'required') {
    $contenu .= '<div class="alert alert-warning">Vous devez être connecter !</div>';
}

/**
 * 3- Déconnexion
 */
if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {
    // Supprimer les infos dans la session
    unset($_SESSION['membre']);
    // Message de confirmation
    $message_connexion .= '<div class="alert alert-info">Vous avez été déconnecté.</div>';
}

/**
 * 4- Redirection si connecté
 */
if (function_exists('internantesEstConnecte') && internantesEstConnecte()) {
    header('location: profil.php');
    exit();
}

/**
 * 1- Traitement du formulaire de connexion
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['pseudo'])) {
        $contenu .= '<div class="alert alert-danger">Le pseudo est requis.</div>';
    }
    if (empty($_POST['mdp'])) {
        $contenu .= '<div class="alert alert-danger">Le mot de passe est requis.</div>';
    }

    if (empty($contenu)) { // Pas d'erreur
        $res = executeRequete(
            "SELECT * FROM membre WHERE pseudo = :pseudo",
            array(':pseudo' => $_POST['pseudo'])
        );

        if ($res->rowCount() > 0) {
            $membre = $res->fetch(PDO::FETCH_ASSOC);
            if (password_verify($_POST['mdp'], $membre['mdp'])) {
                $_SESSION['membre'] = $membre;
                header('location: profil.php');
                exit();
            } else {
                $contenu .= '<div class="alert alert-danger">Identifiants erronés.</div>';
            }

        } else {
            $contenu .= '<div class="alert alert-danger">Identifiants erronés.</div>';
        }
    }
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
        <h1 class="mt-4">Connexion</h1>
        <p>Veuillez indiquer vos identifiants pour vous connecter.</p>

        <?php echo $message_connexion . $contenu; ?>

        <form method="post" action="./connexion.php">
            <div class="mb-3">
                <label for="exampleInputPseudo1" class="form-label">Pseudo</label>
                <input type="text" class="form-control" id="exampleInputPseudo1" name="pseudo"
                    value="<?php echo htmlspecialchars($_POST['pseudo'] ?? '', ENT_QUOTES); ?>" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mot de Passe</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="mdp" required>
                <div id="passwordHelp" class="form-text">Ne partagez jamais votre mot de passe.</div>
            </div>
            <button type="submit" class="btn btn-primary">Connexion</button>
        </form>
    </main>

    <?php require_once '../inc/footer.inc.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>