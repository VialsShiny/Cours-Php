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
    echo "<em>$title</em><br>";
};

function debug($param)
{
    echo '<pre class="console">';
    print_r($param);
    echo '</pre>';
}