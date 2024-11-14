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
    var_dump($param);
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
//---------------------------------------------------------------
echo '<h3> 09 - requête préparée et bindValue() </h3>';
//---------------------------------------------------------------
//----------------------------------------
echo '<h3> 10 - Requête préparée et points complémentaires </h3>';
//----------------------------------------
//----------------------------------------
echo '<hr>';
echo '<h3> 11 - La méthode fetchClass() </h3>';
//----------------------------------------