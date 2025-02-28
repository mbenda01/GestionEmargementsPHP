<?php
session_start();
require_once dirname(__DIR__, 2) . '/database.php';

$error = "";

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    header("Location: /projetEmargementsPHP/index.php");
    exit;
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    if (empty($login) || empty($password)) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        $stmt = $connexion->prepare("SELECT * FROM users WHERE login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (!$user) {
            $error = "Utilisateur introuvable.";
        } else {
            // Vérifier si l'utilisateur doit changer son mot de passe
            if ($user['password'] == 'default') {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role_id'];
                $_SESSION['change_password'] = true;
                header("Location: /projetEmargementsPHP/pages/auth/change_password.php");
                exit;
            }

            // Vérifier le mot de passe avec la fonction personnalisée
            if (customPasswordVerify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role_id'];
                $_SESSION['change_password'] = false;
                header("Location: /projetEmargementsPHP/index.php");
                exit;
            } else {
                $error = "Mot de passe incorrect.";
            }
        }
    }
}

// Fonction de vérification du mot de passe haché
//vérifier si un mot de passe fourni correspond à un mot de passe haché en utilisant l'algorithme de hachage SHA-256 avec un "sel" (secret_salt).
function customPasswordVerify($password, $hashedPassword) {
    return hash('sha256', $password . 'secret_salt') === $hashedPassword;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion des Émargements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: auto;
            margin-top: 100px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-container">
        <h2 class="text-center">Connexion</h2>
        
        <!-- Affichage des erreurs -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form action="#" method="POST">
            <div class="mb-3">
                <label for="login" class="form-label">Identifiant</label>
                <input type="text" class="form-control" id="login" name="login" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success w-100">Se connecter</button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
