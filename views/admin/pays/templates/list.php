<h2>Liste des Pays</h2>

<a href="add.php">Ajouter un pays</a>

<?php if (empty($paysList)): ?>
    <p>Aucun pays enregistré.</p>
<?php else: ?>
    <table border="1">
        <thead>
            <tr>
                <th>Nom du pays</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($paysList as $pays): ?>
                <tr>
                    <td><?= htmlspecialchars($pays->pays_name) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $pays->id ?>">Modifier</a> |
                        <a href="delete.php?id=<?= $pays->id ?>" onclick="return confirm('Supprimer ce pays ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<a href="../dashboard.php">Retourner au Dashboard</a>
