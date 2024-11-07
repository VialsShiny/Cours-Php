<?php 
print_r($_POST);

if (!empty($_POST)) { // Soulever
  if (isset($_POST["name"]) && isset($_POST["age"]) && isset($_POST["email"])) {
    echo '<br>';
    echo "Name : " . $_POST['name'] . '<br>';
    echo "Age : " . $_POST['age'] . '<br>';
    echo "Email : " . $_POST['email'] . '<br>';
  }
}
?>

<!DOCTYPE html>
<html lang='EN-en'>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>GET Php</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <meta name='description' content='GET Php'>
</head>

<body>

  <h1>Formulaire d'inscription</h1>

  <br>

  <form method="post">
    <label for="name">Name :</label>
    <input type="text" name="name" id="name" required>

    <br>

    <label for="age">Age :</label>
    <input type="text" name="age" id="age" required>

    <br>

    <label for="email"> Email :</label>
    <input type="email" name="email" id="email">

    <br>

    <input type="submit" value="Soumettre" name="send">
    <input type="reset" value="Annuler">
  </form>


  <!-- #Script -->

</body>

</html>