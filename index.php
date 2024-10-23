    <!DOCTYPE html>
<html lang='FR-fr'>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Cours Php</title>
    <meta name='viewport' content='width=device-width'>
     <meta name='description' content='Tous les cours de Php des A2'>
    <link rel='stylesheet' type='text/css' media='screen' href='./asset/css/style.css'>
</head>
<body>
    
<?php

$CreateTitle = function ($title, $type) {
    echo "<$type>$title</$type>";
};

$CreateCodeZone = function ($code) {
    echo "<pre>";
    echo htmlspecialchars($code);
    echo "</pre>";
};

$CreateCommentaire = function ($title) {
    echo "<em>$title</em>";
};

// htmlspecialchars()

require_once("./php/header.php");
require_once("./php/main.php");

?> 

</body>
</html>