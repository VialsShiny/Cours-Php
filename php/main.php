<?php include_once('./php/functions.php'); ?>

<!-- #Main -->

<main>
    <?php if (isset($_GET['cours'])) { ?>
        <?php if ($_GET['cours'] == "First") { ?>
            <h1>Les bases | First :</h1>

            <div class="cours__container">
                <details class="first">
                    <summary>Les bases</summary>
                    <?php include_once('./asset/cours/Base/First/00_index.php') ?>
                </details>
                <details class="first">
                    <summary>Les Dates</summary>
                    <?php include_once('./asset/cours/Base/First/01_date.php') ?>
                </details>
                <details class="first">
                    <summary>Exercices</summary>
                    <?php include_once('./asset/cours/Base/First/01_exercices.inc.php') ?>
                </details>
            </div>
        <?php } ?>
    <?php } else { ?>
        <h1>Cours Php :</h1>
    <?php } ?>
</main>

<!-- #Main -->