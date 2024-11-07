<?php

session_start();

var_dump($_SESSION);
echo '<hr>';

// démarrer la session
session_unset();

if (isset($_SESSION['username'])) {
    echo 'Bonjour ' . $_SESSION['username'] . ' !';
} else {
    echo 'Pas de session active !';
}

echo '<hr>';

session_destroy();

var_dump($_SESSION);