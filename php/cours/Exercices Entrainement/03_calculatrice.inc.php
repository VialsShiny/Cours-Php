<?php

function Calculatrice($n1, $n2, $symbole) {
    switch ($symbole) {
        case '-':
            return $n1 - $n2;
            break;
        case '+':
            return $n1 + $n2;
            break;
        case '*':
            return $n1 * $n2;
            break;
        case '/':
            return $n1 / $n2;
            break;
    }
}

if (isset($_POST)) {
    if (!empty($_POST)) {
        if (!empty($_POST['num1'])) {
            $num1 = $_POST['num1'];
        }
        if (!empty($_POST['select'])) {
            $select = $_POST['select'];
        }
        if (!empty($_POST['num2'])) {
            $num2 = $_POST['num2'];
        }

        if (!empty($_POST['num1']) && !empty($_POST['select']) && !empty($_POST['num2'])) {
            echo Calculatrice($num1, $num2, $select);
        }
    }
}
?>

<form method="post" action="03_exercices.php">
    <input type="number" name="num1" required>
    <select name="select" required>
        <option value="-">-</option>
        <option value="+">+</option>
        <option value="*">*</option>
        <option value="/">/</option>
    </select>
    <input type="number" name="num2" required>

    <br>

    <input type="submit" value="Calculer" name="send">
</form>