<?php
require_once dirname(__DIR__, 2) . '/shared/authMiddleware.php';
checkRole([1]); // Seul l'admin peut voir cette page

require_once dirname(__DIR__, 2) . '/database.php';
?>


<?php
require_once dirname(__DIR__, 2) . '/database.php';
?>

<h2 class="text-center mb-4">Liste des utilisateurs</h2>
<div class="d-flex justify-content-between mb-3">
    <h4>Gestion des utilisateurs</h4>
    <a href="index.php?action=addUser" class="btn btn-success">+ Nouveau</a>
</div>
<table class="table table-hover table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Âge</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = $connexion->query("SELECT users.id, users.nom, users.prenom, users.age, roles.nom AS role 
                                    FROM users
                                    JOIN roles ON users.role_id = roles.id");
        while ($row = $query->fetch_assoc()):
        ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nom'] ?></td>
                <td><?= $row['prenom'] ?></td>
                <td><?= $row['age'] ?> ans</td>
                <td><?= $row['role'] ?></td>
                <td>
                    <a href="index.php?action=editUser&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                    <a href="index.php?action=deleteUser&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">Supprimer</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
