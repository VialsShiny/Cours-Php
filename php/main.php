<!-- #Main -->

<main>

    <h1>Cours Php :</h1>

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

    // Echo
    $CreateTitle('Echo', 'h2');
    $code = <<<'EOD'
    // Affichage d'un message
    echo '<p>Je suis genti</p>';
EOD;
    $CreateCodeZone($code);
    eval($code);
    echo '<hr>';

    // Variable
    $CreateTitle('Variable', 'h2');
    $code = <<<'EOD'
    // Déclaration de variables
    $le = 'le';
    $leCookie = "BG $le Cookie";
    echo "$leCookie<br>";
EOD;
    $CreateCodeZone($code);
    eval($code);
    echo '<hr>';

    // Gettype
    $CreateTitle('Gettype', 'h2');
    $code = <<<'EOD'
    // Obtenir le type d'une variable
    echo "$leCookie<br>";
    echo gettype($leCookie);
EOD;
    $CreateCodeZone($code);
    eval($code);
    echo '<hr>';

    // Concaténation
    $CreateTitle('Concaténation', 'h2');
    $code = <<<'EOD'
    // Concaténer des chaînes
    echo $leCookie . '<br>' . 'MAIS NAAAN';
EOD;
    $CreateCodeZone($code);
    eval($code);
    echo '<hr>';

    // Le += en Php (pour les String)
    $CreateTitle('Le += en Php (pour les String)', 'h4');
    $code = <<<'EOD'
    // Utilisation de += avec des chaînes
    $s = '(s)';
    $le .= $s;
    $leCookie = "BG $le Cookie" . $s;
    echo $leCookie;
EOD;
    $CreateCodeZone($code);
    eval($code);
    echo '<hr>';

    // Const/Define
    $CreateTitle('Const/Define', 'h2');
    $code = <<<'EOD'
    // Définir des constantes
    const CAPITALE = 'Paris';
    define('CAPITALE2', 'Madrid');
    echo CAPITALE . '<br>';
    echo CAPITALE2 . '<br>';
EOD;
    $CreateCodeZone($code);
    eval($code);
    echo '<hr>';

    // Constante Magique (__Teste__)
    $CreateTitle('Constante Magique (__Teste__)', 'h4');
    $code = <<<'EOD'
    // Utilisation de constantes magiques
    echo __DIR__ . '<br>';
    echo __FILE__ . '<br>';
    echo __LINE__ . '<br>';
EOD;
    $CreateCodeZone($code);
    eval($code);
    echo '<hr>';

    // Exercice
    $CreateTitle('Exercice', 'h2');
    $CreateTitle('Afficher Bleu-Blanc-Rouge', 'strong');
    echo '<br>';
    $code = <<<'EOD'
    // Afficher une chaîne de couleurs
    $bleu = 'Bleu';
    $blanc = 'Blanc';
    $rouge = 'Rouge';
    $tiret = '-';
    echo $bleu . $tiret . $blanc . $tiret . $rouge . '<br>';
    echo "$bleu$tiret$blanc$tiret$rouge";
EOD;
    $CreateCodeZone($code);
    eval($code);
    echo '<hr>';

    // Opérateurs arithmétiques
    $CreateTitle('Opérateur arithmétiques', 'h4');
    $code = <<<'EOD'
    // Opérations arithmétiques
    $nbr1 = 10;
    $nbr2 = 2;
    echo $nbr1 % $nbr2 . '<br>';
    $nbr1 *= $nbr2 + $nbr1;
    echo $nbr1 . '<br>';
EOD;
    $CreateCodeZone($code);
    eval($code);
    echo '<hr>';

    // Condition
    $CreateTitle('Condition', 'h2');
    $code = <<<'EOD'
    // Conditions if
    $a = 10;
    $b = 5;
    $c = 2;
    if ($a > $b) {
        echo true . '<br>';
    } else {
        echo false . '<br>';
    }
    if ($a == 8) {
        echo 'true' . '<br>';
    } elseif ($a < 18) {
        echo 'true' . '<br>';
    } else {
        echo 'Je sais pas chef ' . '(false)';
    }
EOD;
    $CreateCodeZone($code);
    eval($code);
    echo '<hr>';

    // XOR
    $CreateTitle('XOR', 'h4');
    $code = <<<'EOD'
    // Utilisation de XOR
    if ($a > $b xor $b < $c) {
        echo 'true' . '<br>';
    } else {
        echo 'false' . '<br>';
    }
EOD;
    $CreateCodeZone($code);
    eval($code);
    echo '<hr>';

    // Ternaire
    $CreateTitle('Ternaire', 'h4');
    $code = <<<'EOD'
    // Utilisation de l'opérateur ternaire
    echo ($a === 10) ? 'true' : 'false';
EOD;
    $CreateCodeZone($code);
    eval($code);
    echo '<hr>';

    // Fonctions prédéfinies
    $CreateTitle('Fonctions prédéfinies', 'h2');
    $code = <<<'EOD'
    // Fonctions de chaîne
    $email = 'tvialatou@gmail.com';
    echo strpos($email, '@') . '<br>';
    echo strpos($email, '@', '5') . '<br>';
    echo strpos($email, '.') . '<br>';
    var_dump(strpos($email, '@'));
    echo '<br>';
    echo strlen('€') . '<br>'; // 3 Octets
    echo mb_strlen('€', 'UTF-8') . '<br>'; // 1 Caractères
    $texte = 'CACACACACACACACAACCAACACC';
    echo substr($texte, 0, 4) . ' <a href="">Lire la Suite</a>';
EOD;
    $CreateCodeZone($code);
    eval($code);
    echo '<hr>';

    // InArray
    $CreateTitle('In__Array', 'h4');
    $code = <<<'EOD'
    // Vérifier l'existence d'une valeur dans un tableau
    $tab_simple = array('prenom' => 'Julien', 'nom' => 'Dupont', 'telephone' => '0601020304');
    echo in_array('Julien', $tab_simple) ? 'true' : 'false';
    echo '<br>';
    echo array_key_exists('prenom', $tab_simple) ? 'true' : 'false';
EOD;
    $CreateCodeZone($code);
    eval($code);
    echo '<hr>';

    // Sort
    $CreateTitle('Sort', 'h2');
    $code = <<<'EOD'
    // Trier un tableau
    $fruits = array('pomme', 'banane', 'poire', 'mangue');
    sort($fruits);
    var_dump($fruits);
EOD;
    $CreateCodeZone($code);
    eval($code);
    echo '<hr>';

    // Array_Map
    $CreateTitle('Array', 'h2');
    $code = <<<'EOD'
    // Utilisation de array_map
    function cube($n) {
        return ($n * $n * $n);
    }
    $a = [1, 2, 3];
    $b = array_map('cube', $a);
    var_dump($a);
    var_dump($b);
EOD;
    $CreateCodeZone($code);
    eval($code);
    echo '<hr>';

    // Explode
    $CreateTitle('Explode', 'h4');
    $code = <<<'EOD'
    // Diviser une chaîne en tableau
    $strToExplode = 'Lorem je sais pas quoi dire putain';
    $tabToExplode = explode(' ', $strToExplode);
    var_dump($tabToExplode);
EOD;
    $CreateCodeZone($code);
    eval($code);
    echo '<hr>';

    // Implode
    $CreateTitle('Implode', 'h4');
    $code = <<<'EOD'
    // Joindre un tableau en chaîne
    $tabToImplode = implode(' ', $tabToExplode);
    echo $tabToImplode;
EOD;
    $CreateCodeZone($code);
    eval($code);
    echo '<hr>';

    // Array_rand
    $CreateTitle('Array_rand', 'h2');
    $code = <<<'EOD'
    // Tirer un élément au hasard d'un tableau
    $tabToRand = array('Coucou', 5, false, 'Caca');
    $randomKeys = array_rand($tabToRand, count($tabToRand));
    var_dump($randomKeys);
EOD;
    $CreateCodeZone($code);
    eval($code);
    echo '<hr>';

    function debug($param)
    {
        echo '<pre style="background-color: lightgray;">';
        print_r($param);
        echo '</pre>';
    }

    // EXO 2
    $CreateTitle('Sélecteur d\'années', 'h2');
    $code = <<<'EOD'
    // Sélecteur d'années
    echo '<select id="date-choose">';
    $nbr = 1900;
    while ($nbr <= 2025) {
        echo "<option>$nbr</option>";
        $nbr += 10;
    }
    echo '</select>';
EOD;
    $CreateCodeZone($code);
    eval($code);

    ?>


</main>

<!-- #Main -->