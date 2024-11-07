<?php
function montantTTC($montantHT, $TVA)
{
    return $montantHT * ($TVA / 100 + 1);
}

if (isset($_POST)) {
    if (!empty($_POST)) {
        if (!empty($_POST['montant'])) {
            $montant = $_POST['montant'];
        }
        if (!empty($_POST['date'])) {
            $TVA = $_POST['date'];
        }
        if (!empty($_POST['date']) && !empty($_POST['montant'])) {
            echo montantTTC($montant, $TVA);
        } else {
            echo 'Ressaier';
        }
    }
}
?>

<form method="post" action="03_exercices.php">
    <caption>Votre devis de travaux</caption>

    <label for="montant">Montant : </label>
    <input type="number" name="montant" id="montant" required>

    <div>
        <input type="radio" name="date" id="dateP" value="10" required>
        <label for="dateP">Plus de 5 ans</label>
    </div>

    <div>
        <input type="radio" name="date" id="dateM" value="20" required>
        <label for="dateM">Moins de 5 ans</label>
    </div>

    <input type="submit" value="Calculer" name="send">

</form>