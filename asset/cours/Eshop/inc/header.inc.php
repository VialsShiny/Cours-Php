<header class="bg-body-tertiary" data-bs-theme="dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="<?php echo 'index.php'; ?>" class="navbar-brand">MA BOUTIQUE</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav1"
                aria-controls="nav1" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu de Navigation -->
            <div class="collapse navbar-collapse" id="nav1">
                <ul class="navbar-nav ms-auto">
                    <?php
                    echo '<li class="nav-item"><a class="nav-link" href="' . RACINE_SITE . 'index.php">Boutique</a></li>';

                    // Menu pour les internautes connectés
                    if (internantesEstConnecte()) {
                        echo '<li class="nav-item"><a class="nav-link" href="' . RACINE_SITE . 'views/profil.php">Profil</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="' . RACINE_SITE . 'views/connexion.php?action=deconnexion">Se déconnecter</a></li>';
                    } else {
                        // Menu pour les internautes non-connectés
                        echo '<li class="nav-item"><a class="nav-link" href="' . RACINE_SITE . 'views/inscription.php">Inscription</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="' . RACINE_SITE . 'views/connexion.php">Connexion</a></li>';
                    }

                    echo '<li class="nav-item"><a class="nav-link" href="' . RACINE_SITE . 'views/panier.php">Panier</a></li>';

                    // ADMIN
                    if (internantesEstConnecteEtAdmin()) {
                        echo '<li class="nav-item"><a class="nav-link" href="' . RACINE_SITE . 'admin/gestion_boutique.php">Admin</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>