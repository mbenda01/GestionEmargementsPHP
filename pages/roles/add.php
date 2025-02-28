<?php
require_once dirname(__DIR__, 2) . '/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];

    $sql = "INSERT INTO roles (nom) VALUES ('$nom')";
    $connexion->query($sql);

    header('Location: /projetEmargementsPHP/index.php?action=listeRoles');
    exit;
}
?>

<div class="container">
    <h2 class="text-center mb-4">Ajouter un rôle</h2>
    <form action="#" method="POST" class="shadow p-4 rounded bg-light">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du rôle</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom du rôle" required>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success me-2">Valider</button>
            <a href="/projetEmargementsPHP/index.php?action=listeRoles" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
