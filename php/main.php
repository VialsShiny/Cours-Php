<?php include_once('./php/functions.php'); ?>

<!-- #Main -->

<main>
    <?php if (isset($_GET['cours'])) { ?>
        <?php if ($_GET['cours'] == "First") { ?>
            <h1>Les bases | First :</h1>

            <div class="cours__container">
                <details>
                    <summary>Les bases</summary>
                    <?php include_once('./asset/cours/Base/First/00_index.php') ?>
                </details>
                <details>
                    <summary>Les Dates</summary>
                    <?php include_once('./asset/cours/Base/First/01_date.php') ?>
                </details>
                <details>
                    <summary>Exercices</summary>
                    <?php include_once('./asset/cours/Base/First/01_exercices.inc.php') ?>
                </details>
            </div>
        <?php } ?>

        <?php if ($_GET['cours'] == "GET") { ?>
            <h1>Les bases | First :</h1>

            <div class="cours__container">
                <details>
                    <summary>GET</summary>
                    <?php $CreateTitle('GET', 'h2') ?>
                    <iframe src="./asset/cours/Base/GET/03_profile.php"></iframe>
                </details>
            </div>
        <?php } ?>
    <?php } else { ?>
        <h1>Cours Php :</h1>
    <?php } ?>
</main>

<!-- #Main -->