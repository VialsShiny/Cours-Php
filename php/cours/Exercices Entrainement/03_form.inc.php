<?php
$pseudo = '';
$pseudoValue = '';
$email = '';
$emailValue = '';

if (isset($_POST) && !empty($_POST)) {
    if (isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        if (strlen($pseudo) < 3 || strlen($pseudo) > 10) {
            $pseudo = 'Incorrect';
            $pseudoValue = '';
            echo $pseudo . '<br>';
        } else {
            $pseudo = $_POST['pseudo'];
            $pseudoValue = $pseudo;
            echo $pseudo . '<br>';
        }
    }

    if (isset($_POST['email']) && !empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = htmlspecialchars($_POST['email']);

        if (strlen($email) < 3 || strlen($email) > 50) {
            $email = 'Incorrect';
            $emailValue = '';
            echo $email;
        } else {
            $email = $_POST['email'];
            $emailValue = $email;
            echo $email;
        }
    }
}

?>


<form action="" method="post">

    <label for="pseudo">Pseudo :</label>
    <input type="text" name="pseudo" id="pseudo" value="<?php echo $pseudoValue ?>">

    <label for="mdp">Mot de passe :</label>
    <input type="password" name="mdp" id="mdp">

    <label for="email">Email :</label>
    <input type="email" name="email" id="email" value="<?php echo $emailValue ?>">

    <input type="submit" value="Envoyer">

</form>