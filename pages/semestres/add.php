<?php
require_once dirname(__DIR__, 2) . '/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];

    // Insérer le semestre dans la base de données
    $stmt = $connexion->prepare("INSERT INTO semestres (nom) VALUES (?)");
    $stmt->bind_param("s", $nom);
    $stmt->execute();

    // Redirection vers la liste des semestres
    header('Location: /projetEmargementsPHP/index.php?action=listeSemestres');
    exit;
}
?>

<div class="container">
    <h2 class="text-center mb-4">Ajouter un semestre</h2>
    <form action="#" method="POST" class="shadow p-4 rounded bg-light">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du semestre</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom du semestre" required>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success me-2">Valider</button>
            <a href="/projetEmargementsPHP/index.php?action=listeSemestres" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
