<?php
if (isset($_POST)) {
    if (!empty($_POST)) {
        if (!empty($_POST['city'])) {
            $city = $_POST['city'];
        } else {
            $city = 'Empty';
        }
        if (!empty($_POST['cp'])) {
            $cp = $_POST['cp'];
        } else {
            $cp = 'Empty';
        }
        if (!empty($_POST['address'])) {
            $address = $_POST['address'];
        } else {
            $address = 'Empty';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="">
    <style>
        html {
            position: relative;
            min-height: 100%;
        }

        body {
            margin-bottom: 60px;
            /* Margin bottom by footer height */
        }
    </style>
</head>

<body>
<div class="container">
    <h1>Traitement du formulaire</h1>
    <div class="card">
        <div class="card-body">
            <?php
            if (!empty($_POST)) {
                if (isset($city) && isset($cp) && isset($address)) {
                    ?>
                    <ul>
                        <li><?php echo $city; ?></li>
                        <li><?php echo $cp; ?></li>
                        <li><?php echo $address; ?></li>
                    </ul>
                    <?php
                }
            } else {
                ?>
                <div class="card-text">
                    <?php
                    $msg = '<div class="alert alert-danger" role="alert">Error</div>';
                    echo $msg;
                    ?>
                </div>
                <?php
            }
            ?>
            <a href="03_form-exos.php" class="btn btn-block btn-warning">Retour</a>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>