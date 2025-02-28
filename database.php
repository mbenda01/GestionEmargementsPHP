<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$serveur = "localhost";
$user = "root";
$pwd = "";
$dbname = "emargementsiibs";

$connexion = new mysqli($serveur, $user, $pwd, $dbname);

if ($connexion->connect_error) {
    die("Erreur de connexion : " . $connexion->connect_error);
}

// Fonction de hachage sécurisé
function customPasswordHash($password) {
    return hash('sha256', $password . 'secret_salt');
}
?>



