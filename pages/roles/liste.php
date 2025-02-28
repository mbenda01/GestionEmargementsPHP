<?php
require_once dirname(__DIR__, 2) . '/database.php';
?>


<h2 class="text-center mb-4">Liste des rôles</h2>
<table class="table table-hover table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = $connexion->query("SELECT * FROM roles");
        while ($row = $query->fetch_assoc()):
        ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nom'] ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
