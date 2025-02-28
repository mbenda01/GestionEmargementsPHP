<?php
require_once dirname(__DIR__, 2) . '/shared/authMiddleware.php';
checkRole([2, 3]); // Seulement gestionnaire et professeur peuvent voir cette page

require_once dirname(__DIR__, 2) . '/database.php';
?>


<?php
require_once dirname(__DIR__, 2) . '/database.php';
?>

<h2 class="text-center mb-4">Liste des cours</h2>
<div class="d-flex justify-content-between mb-3">
    <h4>Gestion des cours</h4>
    <a href="index.php?action=addCours" class="btn btn-success">+ Nouveau</a>
</div>
<table class="table table-hover table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Module</th>
            <th>Semestre</th>
            <th>Professeur</th>
            <th>Date</th>
            <th>Heure début</th>
            <th>Heure fin</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = $connexion->query("SELECT cours.id, modules.nom AS module, semestres.nom AS semestre, 
                                    CONCAT(users.prenom, ' ', users.nom) AS professeur, 
                                    cours.date, cours.heuredebut, cours.heurefin 
                                    FROM cours
                                    JOIN modules ON cours.module_id = modules.id
                                    JOIN semestres ON cours.semestre_id = semestres.id
                                    JOIN users ON cours.professeur_id = users.id");
        while ($row = $query->fetch_assoc()):
        ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['module'] ?></td>
                <td><?= $row['semestre'] ?></td>
                <td><?= $row['professeur'] ?></td>
                <td><?= $row['date'] ?></td>
                <td><?= $row['heuredebut'] ?></td>
                <td><?= $row['heurefin'] ?></td>
                <td>
                    <a href="index.php?action=editCours&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                    <a href="index.php?action=deleteCours&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce cours ?');">Supprimer</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
