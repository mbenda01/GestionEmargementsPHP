<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Activer l'affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'shared/authMiddleware.php';
require_once 'database.php';

// Vérifier la connexion à la base de données
if (!$connexion) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Rediriger vers la page de changement de mot de passe si l'utilisateur doit changer son mot de passe
if (isset($_SESSION['change_password']) && $_SESSION['change_password']) {
    header("Location: /projetEmargementsPHP/pages/auth/change_password.php");
    exit;
}

$action = $_GET['action'] ?? 'home';

// Mode debug (mettre à true pour afficher "Action demandée")
$debug = false;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Émargements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php require_once 'shared/navBar.php'; ?>

    <div class="container mt-5">
        <?php if ($debug): ?>
            <p class="text-center text-muted">Action demandée : <strong><?= htmlspecialchars($action) ?></strong></p>
        <?php endif; ?>

        <div class="card shadow p-4">
        <?php
        switch ($action) {
            // Gestion des utilisateurs (admin uniquement)
            case 'listeUsers':
                checkRole([1]);
                require_once 'pages/users/liste.php';
                break;
            case 'addUser':
                checkRole([1]);
                require_once 'pages/users/add.php';
                break;
            case 'editUser':
                checkRole([1]);
                require_once 'pages/users/edit.php';
                break;
            case 'deleteUser':
                checkRole([1]);
                $id = intval($_GET['id']);
                $stmt = $connexion->prepare("DELETE FROM users WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                header('Location: index.php?action=listeUsers');
                exit;
                break;

            // Gestion des cours (accessible aux gestionnaires et professeurs)
            case 'listeCours':
                checkRole([2, 3]);
                require_once 'pages/cours/liste.php';
                break;
            case 'addCours':
                checkRole([2]);
                require_once 'pages/cours/add.php';
                break;
            case 'editCours':
                checkRole([2]);
                require_once 'pages/cours/edit.php';
                break;
            case 'deleteCours':
                checkRole([2]);
                $id = intval($_GET['id']);
                $stmt = $connexion->prepare("DELETE FROM cours WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                header('Location: index.php?action=listeCours');
                exit;
                break;

            // Gestion des rôles (admin uniquement)
            case 'listeRoles':
                checkRole([1]);
                require_once 'pages/roles/liste.php';
                break;
            case 'addRole':
                checkRole([1]);
                require_once 'pages/roles/add.php';
                break;
            case 'editRole':
                checkRole([1]);
                require_once 'pages/roles/edit.php';
                break;
            case 'deleteRole':
                checkRole([1]);
                $id = intval($_GET['id']);
                $stmt = $connexion->prepare("DELETE FROM roles WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                header('Location: index.php?action=listeRoles');
                exit;
                break;

            // Gestion des modules (gestionnaire uniquement)
            case 'listeModules':
                checkRole([2]);
                require_once 'pages/modules/liste.php';
                break;
            case 'addModule':
                checkRole([2]);
                require_once 'pages/modules/add.php';
                break;
            case 'editModule':
                checkRole([2]);
                require_once 'pages/modules/edit.php';
                break;
            case 'deleteModule':
                checkRole([2]);
                $id = intval($_GET['id']);
                $stmt = $connexion->prepare("DELETE FROM modules WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                header('Location: index.php?action=listeModules');
                exit;
                break;

            // Gestion des semestres (gestionnaire uniquement)
            case 'listeSemestres':
                checkRole([2]);
                require_once 'pages/semestres/liste.php';
                break;
            case 'addSemestre':
                checkRole([2]);
                require_once 'pages/semestres/add.php';
                break;
            case 'editSemestre':
                checkRole([2]);
                require_once 'pages/semestres/edit.php';
                break;
            case 'deleteSemestre':
                checkRole([2]);
                $id = intval($_GET['id']);
                $stmt = $connexion->prepare("DELETE FROM semestres WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                header('Location: index.php?action=listeSemestres');
                exit;
                break;

            // Page d'accueil par défaut
            default:
                echo '<h1 class="text-center">Bienvenue dans la gestion des émargements</h1>';
                echo '<p class="text-center">Utilisez le menu pour naviguer.</p>';
        }
        ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
