<?php

$CreateTitle = function ($title, $type) {
    echo "<$type>$title</$type>";
};

$CreateCommentaire = function ($title) {
    echo "<em>$title</em><br>";
};

$CreateCodeZone = function ($code) {
    echo "<pre>";
    echo $code;
    echo "</pre>";
};

function debug($param)
{
    echo '<pre class="console">';
    print_r($param);
    echo '</pre>';
};

$CreateCodeExemple = function ($title, $titleH, $code, $res) use ($CreateTitle, $CreateCodeZone) {
    $CreateTitle($title, $titleH);
    ?>
    <div class="exemple">
        <?php
        $CreateCodeZone( htmlspecialchars($code));
        $CreateCodeZone($res);
        ?>
    </div>
<?php };
?>