<?php

// Footer HTML
$code = <<<PHP
echo <<<HTML
<footer>
  <p>Cheeeeef</p>
</footer>
HTML;
PHP;

ob_start();
eval($code);
$res = ob_get_clean();
$CreateCodeExemple('Footer HTML', 'h2', $code, $res);
