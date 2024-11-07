<!-- #Main -->

<main>

    <h1>Cours Php :</h1>

    <?php

    include_once('./php/functions.php');

    ?>

    <details>
        <summary>Base</summary>

        <div class="padding-left">
            <details>
                <summary>Index | Base</summary>
                <div class="padding-left">
                    <?php require_once("./php/cours/Base/00_index.php"); ?>
                </div>
            </details>

            <details>
                <summary>Date | Base</summary>
                <div class="padding-left">
                    <?php require_once("./php/cours/Base/01_date.php"); ?>
                </div>
            </details>

            <details>
                <summary>Exemple | Base</summary>
                <div class="padding-left">
                    <?php require_once("./php/cours/Base/01_exemple.php"); ?>
                </div>
            </details>

            <details>
                <summary>Exercices | Base</summary>
                <div class="padding-left">
                    <?php require_once("./php/cours/Base/01_exercices.php"); ?>
                </div>
            </details>
        </div>
    </details>



</main>

<!-- #Main -->