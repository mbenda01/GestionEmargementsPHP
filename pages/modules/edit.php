<?php
require_once dirname(__DIR__, 2) . '/database.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $connexion->prepare("SELECT * FROM modules WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $module = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'];

        // Mise à jour du module
        $stmt = $connexion->prepare("UPDATE modules SET nom = ? WHERE id = ?");
        $stmt->bind_param("si", $nom, $id);
        $stmt->execute();

        // Redirection vers la liste des modules
        header('Location: /projetEmargementsPHP/index.php?action=listeModules');
        exit;
    }
} else {
    header('Location: /projetEmargementsPHP/index.php?action=listeModules');
    exit;
}
?>

<div class="container">
    <h2 class="text-center mb-4">Modifier un module</h2>
    <form action="#" method="POST" class="shadow p-4 rounded bg-light">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du module</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?= $module['nom'] ?>" required>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-warning me-2">Modifier</button>
            <a href="/projetEmargementsPHP/index.php?action=listeModules" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
