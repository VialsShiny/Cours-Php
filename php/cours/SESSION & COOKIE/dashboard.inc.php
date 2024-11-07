<!DOCTYPE html>
<html lang='EN-en'>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Dashboard</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content='Système de connection'>
</head>

<body>

<?php
if (!empty($_SESSION['username']) && !empty($_SESSION['email'])) { ?>
<h1>Hello <?php echo $_SESSION['username'] ?></h1>

<a href="login.php">Logout</a>
<?php } else if (!empty($_COOKIE['username'])) { ?>
<h1>Hello <?php echo $_COOKIE['username'] ?> !</h1>

<a href="login.php">Logout</a>
<?php } else {?>
<h1>Connect to your Accompt !</h1>

<a href="login.php">Login</a>
<?php }?>


</body>

</html>