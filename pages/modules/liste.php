<?php
require_once dirname(__DIR__, 2) . '/database.php';
?>

<h2 class="text-center mb-4">Liste des modules</h2>
<div class="d-flex justify-content-between mb-3">
    <h4>Gestion des modules</h4>
    <a href="index.php?action=addModule" class="btn btn-success">+ Nouveau</a>
</div>

<table class="table table-hover table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = $connexion->query("SELECT * FROM modules");
        while ($row = $query->fetch_assoc()):
        ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nom'] ?></td>
                <td>
                    <a href="index.php?action=editModule&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                    <a href="index.php?action=deleteModule&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce module ?');">Supprimer</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
