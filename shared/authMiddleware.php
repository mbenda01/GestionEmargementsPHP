<?php
error_reporting(E_ALL);

//pour activer l'affichage des erreurs directement sur la page web pendant l'exécution du script.
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_id'])) {
    header("Location: /projetEmargementsPHP/pages/auth/login.php");
    exit;
}

function checkRole($allowedRoles) {
    if (!in_array($_SESSION['user_role'], $allowedRoles)) {
        header("Location: /projetEmargementsPHP/index.php");
        exit;
    }
}
?>
