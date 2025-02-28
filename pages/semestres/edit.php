<?php
require_once dirname(__DIR__, 2) . '/database.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $connexion->prepare("SELECT * FROM semestres WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $semestre = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'];

        // Mise à jour du semestre
        $stmt = $connexion->prepare("UPDATE semestres SET nom = ? WHERE id = ?");
        $stmt->bind_param("si", $nom, $id);
        $stmt->execute();

        // Redirection vers la liste des semestres
        header('Location: /projetEmargementsPHP/index.php?action=listeSemestres');
        exit;
    }
} else {
    header('Location: /projetEmargementsPHP/index.php?action=listeSemestres');
    exit;
}
?>

<div class="container">
    <h2 class="text-center mb-4">Modifier un semestre</h2>
    <form action="#" method="POST" class="shadow p-4 rounded bg-light">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du semestre</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?= $semestre['nom'] ?>" required>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-warning me-2">Modifier</button>
            <a href="/projetEmargementsPHP/index.php?action=listeSemestres" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
