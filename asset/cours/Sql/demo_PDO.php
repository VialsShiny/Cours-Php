<style>
    h3 {
        background-color: darkslategray;
        color: white;
        padding: 10px;
        font-size: 18px;
        padding-left: 5vw;
    }

    h4 {
        color: #2B193D;
        background-color: #B3EFB2;
        padding-left: 5vw;
    }

    table {
        border-collapse: collapse;
        color: white;
        text-transform: capitalize;
    }

    th, td {
        border: #2B193D 2px solid;
        padding: 8px;
    }

    tr {
        background-color: blueviolet;

        &:nth-of-type(odd) {
            background-color: darkslateblue;
        }
    }

</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

<?php
/**
 * **********************
 *          PDO
 * **********************
 * PHP Data Objects (objets de données PHP)
 *
 * PDO est une interface qui permet de se connecter à une base de données depuis le PHP
 */
// fonction d'affichage d'un print_r() avec balise <pre>
function debugP($param)
{
    echo '<pre style="background-color: #D5ECD4 ;">';
    print_r($param);
    echo '</pre>';
}

//-------------------------------
echo '<h3> 01 - Connexion </h3>';

try {
    // $pdo est un objet issu de la classe prédéfinie PDO, il représente la connexion à la BDD ici "entreprise"
    $pdo = new PDO(
        "mysql:host=localhost;dbname=entreprise",
        "root",
        "",
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Passe en mode exception pour capturer les erreurs SQL
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", // Caractères UTF8
        )
    );
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

debugP($pdo);

//-------------------------------
//----------------------------------------
echo '<h3> 02 - La méthode exec() </h3>';
//----------------------------------------

// exec() est utilisée pour la formulation de requêtes de retournant pas de résultat : INSERT, UPDATE, DELETE
$res = $pdo->exec("INSERT INTO employes(prenom, nom, sexe, service, date_embauche, salaire) VALUES ('test', 'test', 'm', 'test', '2016-02-08', 500)");
debugP($res);

//----------------------------------------
echo '<h3> 02.1 - Supprimer les lignes avec "test" </h3>';
//----------------------------------------

// les objets qui viennent de la BDD ne prennet pas de quotes, les valeurs à insérer par contre oui elles prennent des quotes
/**
 * Valeur de retour :
 *  - Succès : renvoie le nombre de lignes affectées par la requête
 *  - Echec : retourne false
 */

$res = $pdo->exec("DELETE FROM employes WHERE prenom = 'test'");

echo "Nombre de lignes affectées par la requête INSERT INTO : $res <br>"; // entre "" la variable est évaluée
echo 'Dernier ID généré par la BDD : ' . $pdo->lastInsertId() . '<br>';

//----------------------------------------
echo '<h3> 03 - La méthode query() et les différents fetch </h3>';
//----------------------------------------

$res = $pdo->query("SELECT * FROM employes WHERE prenom = 'Merlin'");

debugP($res);
debugP($pdo);

/* FETCH ASSOC */
$employes = $res->fetch(PDO::FETCH_ASSOC);

debugP($employes);

echo "Je suis $employes[prenom] $employes[nom] du service $employes[service] et dont l'id d'employer est $employes[id_employes] <hr>";

/* FETCH NUM */
$res = $pdo->query("SELECT * FROM employes WHERE prenom = 'Merlin'");
$employes = $res->fetch(PDO::FETCH_NUM);

echo "$employes[1] $employes[2]";

/* FETCH */
$res = $pdo->query("SELECT * FROM employes WHERE prenom = 'Merlin'");
$employes = $res->fetch();

debugP($employes);
echo "$employes[prenom] $employes[nom] $employes[0]";

/* FETCH OBJECT */
$res = $pdo->query("SELECT * FROM employes WHERE prenom = 'Merlin'");
$employes = $res->fetch(PDO::FETCH_OBJ);

debugP($employes);
echo "Mon ID est " . $employes->id_employes . "<hr>";

// Exercice :
$res = $pdo->query("SELECT service FROM employes WHERE id_employes = 701");
$employes = $res->fetch(PDO::FETCH_OBJ);

debugP($employes);
echo "$employes->service";

/* Valeur de retour de la méthode query() :
*  - Succès : elle nous fournit un objet issu de la classe prédéfinie PDOStatement qui contient 1 ou plusieurs
* jeux de résultats
*  - Echec : retourne false
*
* Notez que query() peut aussi être utilisée avec INSERT, UPDATE et DELETE
*/

//----------------------------------------
echo '<h3> 04 - La méthode query() et boucle while </h3>';
//----------------------------------------

$res = $pdo->query("SELECT * FROM employes");
echo $res->rowCount() . '<hr>';

while ($employes = $res->fetch(PDO::FETCH_OBJ)) {
    echo '<div>';
    echo "<p> $employes->id_employes </p>";
    echo "<p> $employes->prenom </p>";
    echo "<p> $employes->nom </p>";
    echo '</div><hr>';
}

//----------------------------------------
echo '<h3> 05 - La méthode fetchAll() </h3>';
//----------------------------------------

$res = $pdo->query("SELECT * FROM employes");
$employes = $res->fetchAll(PDO::FETCH_OBJ);

debugP($employes);

foreach ($employes as $employe) {
    echo '<div>';
    echo "<p> $employe->id_employes </p>";
    echo "<p> $employe->prenom </p>";
    echo "<p> $employe->nom </p>";
    echo '</div><hr>';
}


//----------------------------------------
echo '<h3> 06 - Exercice </h3>';
//----------------------------------------

// 1
$res = $pdo->query("SELECT DISTINCT service FROM employes");
debugP($res);

while ($services = $res->fetch(PDO::FETCH_OBJ)) {
    echo '<div>';
    echo "<p> $services->service </p>";
    echo '</div><hr>';
}

// 2
$res = $pdo->query("SELECT DISTINCT service FROM employes");
$services = $res->fetchAll(PDO::FETCH_OBJ);

debugP($services);

foreach ($services as $service) {
    echo '<div>';
    echo "<p> $service->service </p>";
    echo '</div><hr>';
}

//----------------------------------------
echo '<h3> 07 - Tables HTML </h3>';
//----------------------------------------

$res = $pdo->query("SELECT id_employes AS 'Id employé', prenom AS prénom, nom AS 'Nom', sexe AS 'Genre',service AS 'Service', date_embauche AS 'Date embauche', salaire AS 'Salaire' FROM employes");
debugP($res);

?>

<table>
    <tr>
        <?php
        for ($i = 0; $i < $res->columnCount(); $i++) {
            $colonne = $res->getColumnMeta($i);
            echo '<th>' . $colonne['name'] . '</th>';
        }
        ?>
    </tr>
    <?php
    while ($ligne = $res->fetch(PDO::FETCH_OBJ)) { ?>
        <tr>
            <?php
            foreach ($ligne as $data) {
                echo '<td>' . $data . '</td>';
            }
            ?>
        </tr>
    <?php } ?>

</table>

<?php
//----------------------------------------
echo '<h3> 08 - Requête préparée et bindParam() </h3>';
//----------------------------------------

$nom = 'Vignal';

$res = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom");
// :nom est un marqueur nominatif (il a un nom) qui est en attente d'une valeur (il est vide à cette étape)
// il faut relier la valeur de $nom et le marqueur :nom qui est dans la requête

$nom = 'Mila';
$res->bindParam(':nom', $nom);
$res->execute();

$data = $res->fetch(PDO::FETCH_ASSOC);
debugP($data);

//---------------------------------------------------------------
echo '<h3> 09 - requête préparée et bindValue() </h3>';
//---------------------------------------------------------------

$nom = 'Vignal';

$res = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom");
// :nom est un marqueur nominatif (il a un nom) qui est en attente d'une valeur (il est vide à cette étape)
// il faut relier la valeur de $nom et le marqueur :nom qui est dans la requête

$res->bindValue(':nom', $nom);
$nom = 'Mila';
// $res->bindValue(':nom', $nom);
$res->execute();

$data = $res->fetch(PDO::FETCH_ASSOC);
debugP($data);

// Exercice :
/*
    - Afficher dans une liste <ul><li> : le prenom, le nom et le salaire des employés du service commercial (1 commercial par <li>). Pour cela , vous utilisez une requete préparée.
    - Afficher le nombre de commerciaux dans l'entreprise.
 */

echo '<hr>';

// 1
$param = 'commercial';
$res = $pdo->prepare("SELECT prenom, nom, salaire FROM employes WHERE service = :param");
$res->bindValue(':param', $param);
$res->execute();

$employes = $res->fetchAll(PDO::FETCH_OBJ);

echo '<ul>';
foreach ($employes as $employe) {
    echo "<li> $employe->prenom $employe->nom $employe->salaire </li>";
}
echo '</ul>';

echo '<hr>';
// 2

$res->execute();
$employes = $res->fetchAll(PDO::FETCH_ASSOC);

echo '<ul>';
for ($i = 0; $i < count($employes); $i++) {
    echo '<li>' . $employes[$i]['prenom'] . ' ' . $employes[$i]['nom'] . ' ' . $employes[$i]['salaire'] . '</li>';
}
echo '</ul>';

//----------------------------------------
echo '<h3> 10 - Requête préparée et points complémentaires </h3>';
//----------------------------------------

// 1 \ Le marqueur Anonyme ---
$res = $pdo->prepare("SELECT * FROM employes WHERE prenom = ? AND prenom = ?");

// VERSION COMPLÈTE
$res->bindValue(1, 'Pixel');
$res->bindValue(2, 'Merlin');

// VERSION COURTE
$res->execute(array('Pixel', 'Merlin'));

// 2 \ Le marqueur nominatif ---
$res = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom AND prenom = :prenom");
$prenom = 'Pixel';
$nom = 'Mila';

// VERSION 'LONGUE'
$res->bindValue(':prenom', 'Pixel');
$res->bindValue(':nom', 'Mila');

// VERSION COURTE
$res->execute(array(
        ':prenom' => 'Pixel', // $prenom
        ':nom' => 'Mila', // $nom
    )
);


//----------------------------------------
echo '<hr>';
echo '<h3> 11 - La méthode fetchClass() </h3>';

//----------------------------------------

class Employes
{
    public $id_employes;
    public $prenom;
    public $nom;
    public $sexe;
    public $salaire;
    public $service;
    public $date_embauche;
}

$res = $pdo->query("SELECT * FROM employes");
$res->setFetchMode(PDO::FETCH_CLASS, 'Employes');

$data = $res->fetchAll();

debugP($data);

// EXOS \\

/*
* CAS PRATIQUE : un formulaire pour poster des commentaires
* Objectif : sécuriser le formulaire
*/
/***
 * Modélisation de la BDD :
 * BDD : dialogue
 * Table : commentaires
 * Champs : id_commentaire      INT PK AI
 *          pseudo              VARCHAR(20)
 *          message             TEXT
 *          date_enregistrement DATETIME
 */

