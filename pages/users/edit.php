<?php
require_once dirname(__DIR__, 2) . '/database.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $result = $connexion->query("SELECT * FROM users WHERE id = $id");
    $user = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $age = $_POST['age'];
        $role_id = $_POST['role'];

        $sql = "UPDATE users SET nom = '$nom', prenom = '$prenom', age = $age, role_id = $role_id WHERE id = $id";
        $connexion->query($sql);

        header('Location: /projetEmargementsPHP/index.php?action=listeUsers');
        exit;
    }

    $roles = $connexion->query("SELECT * FROM roles");
} else {
    header('Location: /projetEmargementsPHP/index.php?action=listeUsers');
    exit;
}
?>

<div class="container">
    <h2 class="text-center mb-4">Modifier un utilisateur</h2>
    <form action="#" method="POST" class="shadow p-4 rounded bg-light">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?= $user['nom'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $user['prenom'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Âge</label>
            <input type="number" class="form-control" id="age" name="age" value="<?= $user['age'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select class="form-control" id="role" name="role" required>
                <option value="" disabled>Sélectionnez un rôle</option>
                <?php while ($role = $roles->fetch_assoc()): ?>
                    <option value="<?= $role['id'] ?>" <?= $user['role_id'] == $role['id'] ? 'selected' : '' ?>><?= $role['nom'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-warning me-2">Modifier</button>
            <a href="/projetEmargementsPHP/index.php?action=listeUsers" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
