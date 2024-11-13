<?php

$nationality = 'Invisible';
$sexe = '??';

if (isset($_GET)) {
    if (!empty($_GET)) {
        if (isset($_GET['lang'])) {
            switch ($_GET['lang']) {
                case 'fr':
                    $nationality = 'France';
                    break;
                case 'it':
                    $nationality = 'Italien';
                    break;
                case 'es':
                    $nationality = 'Espagnole';
                    break;
                case 'en':
                    $nationality = 'Anglais';
                    break;

            }
        }
        if (isset($_GET['sexe'])) {
            switch ($_GET['sexe']) {
                case 'men':
                    $sexe = 'un Homme';
                    break;
                case 'woman':
                    $sexe = 'une Femme';
                    break;
            }
        }
    }
}

?>

<div>
    <a href="03_exercices.php?lang=fr">France</a>
    <a href="03_exercices.php?lang=it">Italie</a>
    <a href="03_exercices.php?lang=es">Espagne</a>
    <a href="03_exercices.php?lang=en">Angleterre</a>
</div>

<strong>Tu es <?php echo $nationality ?></strong>

<div>
    <a href="03_exercices.php?sexe=men">Homme</a>
    <a href="03_exercices.php?sexe=woman">Femme</a>
</div>

<strong>Tu es <?php echo $sexe ?></strong>