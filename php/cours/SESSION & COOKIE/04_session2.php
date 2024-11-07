<?php

session_start();

if (isset($_SESSION['username'])) {
    echo 'Bonjour ' . $_SESSION['username'] . ' !';
} else {
    echo 'Pas de session active !';
}