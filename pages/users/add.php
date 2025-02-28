<?php
require_once dirname(__DIR__, 2) . '/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $role_id = $_POST['role'];

    $sql = "INSERT INTO users (nom, prenom, age, role_id) VALUES ('$nom', '$prenom', $age, $role_id)";
    $connexion->query($sql);

    header('Location: /projetEmargementsPHP/index.php?action=listeUsers');
    exit;
}

$roles = $connexion->query("SELECT * FROM roles");
?>

<div class="container">
    <h2 class="text-center mb-4">Ajouter un utilisateur</h2>
    <form action="#" method="POST" class="shadow p-4 rounded bg-light">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez le prénom" required>
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Âge</label>
            <input type="number" class="form-control" id="age" name="age" placeholder="Entrez l'âge" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select class="form-control" id="role" name="role" required>
                <option value="" disabled selected>Sélectionnez un rôle</option>
                <?php while ($role = $roles->fetch_assoc()): ?>
                    <option value="<?= $role['id'] ?>"><?= $role['nom'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success me-2">Valider</button>
            <a href="/projetEmargementsPHP/index.php?action=listeUsers" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
