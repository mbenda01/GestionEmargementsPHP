<?php
require_once dirname(__DIR__, 2) . '/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $module_id = $_POST['module'];
    $semestre_id = $_POST['semestre'];
    $professeur_id = $_POST['professeur'];
    $date = $_POST['date'];
    $heureDebut = $_POST['heuredebut'];
    $heureFin = $_POST['heurefin'];

    $sql = "INSERT INTO cours (module_id, semestre_id, professeur_id, date, heuredebut, heurefin) 
            VALUES ($module_id, $semestre_id, $professeur_id, '$date', '$heureDebut', '$heureFin')";
    $connexion->query($sql);

    header('Location: /projetEmargementsPHP/index.php?action=listeCours');
    exit;
}

$modules = $connexion->query("SELECT * FROM modules");
$semestres = $connexion->query("SELECT * FROM semestres");
$professeurs = $connexion->query("SELECT * FROM users WHERE role_id = (SELECT id FROM roles WHERE nom = 'professeur')");
?>

<div class="container">
    <h2 class="text-center mb-4">Ajouter un cours</h2>
    <form action="#" method="POST" class="shadow p-4 rounded bg-light">
        <div class="mb-3">
            <label for="module" class="form-label">Module</label>
            <select class="form-control" id="module" name="module" required>
                <option value="" disabled selected>Sélectionnez un module</option>
                <?php while ($module = $modules->fetch_assoc()): ?>
                    <option value="<?= $module['id'] ?>"><?= $module['nom'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="semestre" class="form-label">Semestre</label>
            <select class="form-control" id="semestre" name="semestre" required>
                <option value="" disabled selected>Sélectionnez un semestre</option>
                <?php while ($semestre = $semestres->fetch_assoc()): ?>
                    <option value="<?= $semestre['id'] ?>"><?= $semestre['nom'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="professeur" class="form-label">Professeur</label>
            <select class="form-control" id="professeur" name="professeur" required>
                <option value="" disabled selected>Sélectionnez un professeur</option>
                <?php while ($professeur = $professeurs->fetch_assoc()): ?>
                    <option value="<?= $professeur['id'] ?>"><?= $professeur['prenom'] . ' ' . $professeur['nom'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="mb-3">
            <label for="heuredebut" class="form-label">Heure début</label>
            <input type="time" class="form-control" id="heuredebut" name="heuredebut" required>
        </div>
        <div class="mb-3">
            <label for="heurefin" class="form-label">Heure fin</label>
            <input type="time" class="form-control" id="heurefin" name="heurefin" required>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success me-2">Valider</button>
            <a href="/projetEmargementsPHP/index.php?action=listeCours" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
