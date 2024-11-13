<?php

setcookie('username', 'Merlin', time() + 240);
var_dump($_COOKIE);

echo '<hr>';

setcookie('username', 'Merlin', time() - 240);
var_dump($_COOKIE);