<?php
require_once dirname(__DIR__, 2) . '/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];

    // Insérer le module dans la base de données
    $stmt = $connexion->prepare("INSERT INTO modules (nom) VALUES (?)");
    $stmt->bind_param("s", $nom);
    $stmt->execute();

    // Redirection vers la liste des modules
    header('Location: /projetEmargementsPHP/index.php?action=listeModules');
    exit;
}
?>

<div class="container">
    <h2 class="text-center mb-4">Ajouter un module</h2>
    <form action="#" method="POST" class="shadow p-4 rounded bg-light">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du module</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom du module" required>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success me-2">Valider</button>
            <a href="/projetEmargementsPHP/index.php?action=listeModules" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
