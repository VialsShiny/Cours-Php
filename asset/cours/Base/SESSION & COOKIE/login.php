<?php
if (isset($_POST) && !empty($_POST)) {
    if (isset($_POST['username']) && !empty($_POST['username'])) {
        $username = $_POST['username'];
    }
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $_POST['email'];
    }

    if (isset($_POST['remember']) && !empty($_POST['remember'])) {
        if ($_POST['remember']) {
            setcookie('username', $username, time() + 3600);
        }
    }

    if (!empty($username) && !empty($email)) {
        session_start();
        header("dashboard.inc.php");

        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
    }
}

if (!empty($_SESSION['username']) && !empty($_SESSION['email'])) {
    var_dump($_SESSION);
    session_destroy();
} else { ?>
    <form action="" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">

        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <input type="submit" value="Login">
        
        <label for="remember">Remember Me</label>
        <input type="checkbox" name="remember" id="remember">
    </form>
    <a href="dashboard.inc.php">Return to Dashboard</a>
<?php } ?>

