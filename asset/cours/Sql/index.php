<?php
// Fonction de validation pour vérifier l'absence de caractères spéciaux
function isNotSpecial($value)
{
    return !preg_match('/[#$%^&*()+=\[\];,.\/{}|":<>~\\\\]/', trim($value));
}

$prenom = $commentaire = "";

// Tableau pour les messages d'erreurs
$errorTable = [
    'prenom' => "",
    'commentaire' => "",
];

// Connexion PDO avec gestion des erreurs
try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=dialogue",
        "root",
        "",
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        ]
    );
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

function DeleteCommentaire($id, $pdo) {
    $del = $pdo->prepare("DELETE FROM commentaires WHERE id_commentaire = ?");
    $del->execute([$id]);
    header('Location: ?');
}

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    DeleteCommentaire($_GET["id"], $pdo);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation du pseudo
    if (!empty($_POST['pseudo'])) {
        if (isNotSpecial($_POST['pseudo']) && $_POST['pseudo'] !== "user1") {
            if (strlen($_POST['pseudo']) <= 20) {
                $prenom = htmlspecialchars(trim($_POST['pseudo']), ENT_QUOTES);
            } else {
                $errorTable['prenom'] = 'Le Pseudo est trop grand';
            }
        } else {
            $errorTable['prenom'] = 'Pseudo invalide';
        }
    } else {
        $errorTable['prenom'] = 'Pseudo requis';
    }

    // Validation du commentaire
    if (!empty($_POST['commentaire'])) {
        if (isNotSpecial($_POST['commentaire'])) {
            $commentaire = htmlspecialchars(trim($_POST['commentaire']), ENT_QUOTES);
        } else {
            $errorTable['commentaire'] = 'Commentaire invalide';
        }
    } else {
        $errorTable['commentaire'] = 'Commentaire requis';
    }

    // Vérification des erreurs avant insertion en BDD
    $hasError = array_filter($errorTable);

    if (!$hasError) {
        // Préparation de la requête sécurisée
        $res = $pdo->prepare("INSERT INTO commentaires (prenom, message) VALUES (?, ?)");
        if ($res) {
            $res->execute([$prenom, $commentaire]);
            // Redirection après l'insertion
            header('Location: ./index.php');
            exit;
        } else {
            echo "Erreur lors de l'insertion des données.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Commentaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        < style>.none {
            display: none;
            visibility: hidden;
        }

        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }

        div.result {
            padding: 8px;
            position: absolute;
            top: 15px;
            left: 15px;
            max-width: 450px;
            background-color: black;
            border: white 2px solid;
            border-radius: 16px;
            color: white;

            hr {
                margin: 4px 0;
            }

            p span {
                font-weight: bold;
            }

            p,
            em {
                margin: 0;
                padding: 4px 0;
            }
        }

        form {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

            textarea {
                resize: none;
            }
        }
    </style>
</head>

<body>
    <div class="result">
        <?php
        $data = $pdo->query("SELECT * FROM commentaires ORDER BY date_enregistrement DESC");
        $res = $data->fetchAll(PDO::FETCH_ASSOC);

        foreach ($res as $comment) { ?>
            <div>
                <a href="?id=<?php echo $comment['id_commentaire'] ?>">Delete</a>
                <?php
                if (trim($comment['prenom']) != 'user1') {
                    echo "<p>Envoyé par <span>" . htmlspecialchars_decode(trim($comment['prenom'])) . "</span> le <span>" . htmlspecialchars_decode($comment['date_enregistrement']) . "</span> :</p>";
                    echo "<hr>";
                    echo "<em>" . htmlspecialchars_decode($comment['message']) . "</em>";
                    echo "<hr>";
                }
                ?>
            </div>
        <?php } ?>
    </div>

    <form method="post">
        <h2 class="text-center mb-4">Laissez un commentaire</h2>

        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" class="form-control <?php echo $errorTable['prenom'] ? 'is-invalid' : 'is-valid'; ?>"
                id="pseudo" name="pseudo" placeholder="Entrez votre pseudo"
                value="<?php echo htmlspecialchars($prenom); ?>" required>
            <div class="invalid-feedback">
                <?php echo $errorTable['prenom']; ?>
            </div>
        </div>

        <div class="mb-3">
            <label for="commentaire" class="form-label">Commentaire</label>
            <textarea class="form-control <?php echo $errorTable['commentaire'] ? 'is-invalid' : 'is-valid'; ?>"
                id="commentaire" name="commentaire" rows="4" placeholder="Votre commentaire"
                required><?php echo htmlspecialchars($commentaire); ?></textarea>
            <div class="invalid-feedback">
                <?php echo $errorTable['commentaire']; ?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">Envoyer</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>