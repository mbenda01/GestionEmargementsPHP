<?php
require_once dirname(__DIR__, 2) . '/database.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $result = $connexion->query("SELECT * FROM cours WHERE id = $id");
    $cours = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $module_id = $_POST['module'];
        $semestre_id = $_POST['semestre'];
        $professeur_id = $_POST['professeur'];
        $date = $_POST['date'];
        $heureDebut = $_POST['heuredebut'];
        $heureFin = $_POST['heurefin'];

        $sql = "UPDATE cours SET module_id = $module_id, semestre_id = $semestre_id, professeur_id = $professeur_id, 
                date = '$date', heuredebut = '$heureDebut', heurefin = '$heureFin' WHERE id = $id";
        $connexion->query($sql);

        header('Location: /projetEmargementsPHP/index.php?action=listeCours');
        exit;
    }

    $modules = $connexion->query("SELECT * FROM modules");
    $semestres = $connexion->query("SELECT * FROM semestres");
    $professeurs = $connexion->query("SELECT * FROM users WHERE role_id = (SELECT id FROM roles WHERE nom = 'professeur')");
} else {
    header('Location: /projetEmargementsPHP/index.php?action=listeCours');
    exit;
}
?>

<div class="container">
    <h2 class="text-center mb-4">Modifier un cours</h2>
    <form action="#" method="POST" class="shadow p-4 rounded bg-light">
        <div class="mb-3">
            <label for="module" class="form-label">Module</label>
            <select class="form-control" id="module" name="module" required>
                <option value="" disabled>Sélectionnez un module</option>
                <?php while ($module = $modules->fetch_assoc()): ?>
                    <option value="<?= $module['id'] ?>" <?= $cours['module_id'] == $module['id'] ? 'selected' : '' ?>><?= $module['nom'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="semestre" class="form-label">Semestre</label>
            <select class="form-control" id="semestre" name="semestre" required>
                <option value="" disabled>Sélectionnez un semestre</option>
                <?php while ($semestre = $semestres->fetch_assoc()): ?>
                    <option value="<?= $semestre['id'] ?>" <?= $cours['semestre_id'] == $semestre['id'] ? 'selected' : '' ?>><?= $semestre['nom'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="professeur" class="form-label">Professeur</label>
            <select class="form-control" id="professeur" name="professeur" required>
                <option value="" disabled>Sélectionnez un professeur</option>
                <?php while ($professeur = $professeurs->fetch_assoc()): ?>
                    <option value="<?= $professeur['id'] ?>" <?= $cours['professeur_id'] == $professeur['id'] ? 'selected' : '' ?>><?= $professeur['prenom'] . ' ' . $professeur['nom'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="<?= $cours['date'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="heuredebut" class="form-label">Heure début</label>
            <input type="time" class="form-control" id="heuredebut" name="heuredebut" value="<?= $cours['heuredebut'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="heurefin" class="form-label">Heure fin</label>
            <input type="time" class="form-control" id="heurefin" name="heurefin" value="<?= $cours['heurefin'] ?>" required>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-warning me-2">Modifier</button>
            <a href="/projetEmargementsPHP/index.php?action=listeCours" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
