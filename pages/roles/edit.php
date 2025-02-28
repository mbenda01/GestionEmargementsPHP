<?php
require_once dirname(__DIR__, 2) . '/database.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $result = $connexion->query("SELECT * FROM roles WHERE id = $id");
    $role = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'];

        $sql = "UPDATE roles SET nom = '$nom' WHERE id = $id";
        $connexion->query($sql);

        header('Location: /projetEmargementsPHP/index.php?action=listeRoles');
        exit;
    }
} else {
    header('Location: /projetEmargementsPHP/index.php?action=listeRoles');
    exit;
}
?>

<div class="container">
    <h2 class="text-center mb-4">Modifier un rôle</h2>
    <form action="#" method="POST" class="shadow p-4 rounded bg-light">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du rôle</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?= $role['nom'] ?>" required>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-warning me-2">Modifier</button>
            <a href="/projetEmargementsPHP/index.php?action=listeRoles" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
