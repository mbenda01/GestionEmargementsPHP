<?php
require_once dirname(__DIR__) . '/shared/authMiddleware.php';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/projetEmargementsPHP/index.php">Gestion Émargements</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if ($_SESSION['user_role'] == 1): // Admin ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($_GET['action'] ?? '') == 'listeUsers' ? 'active' : '' ?>" href="index.php?action=listeUsers">Utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($_GET['action'] ?? '') == 'listeRoles' ? 'active' : '' ?>" href="index.php?action=listeRoles">Rôles</a>
                    </li>
                <?php endif; ?>

                <?php if (in_array($_SESSION['user_role'], [2, 3])): // Gestionnaire et Professeur ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($_GET['action'] ?? '') == 'listeCours' ? 'active' : '' ?>" href="index.php?action=listeCours">Cours</a>
                    </li>
                <?php endif; ?>

                <?php if ($_SESSION['user_role'] == 2): // Gestionnaire uniquement ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($_GET['action'] ?? '') == 'listeModules' ? 'active' : '' ?>" href="index.php?action=listeModules">Modules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($_GET['action'] ?? '') == 'listeSemestres' ? 'active' : '' ?>" href="index.php?action=listeSemestres">Semestres</a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="/projetEmargementsPHP/pages/auth/logout.php">Déconnexion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar-nav .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 5px;
    }
</style>
