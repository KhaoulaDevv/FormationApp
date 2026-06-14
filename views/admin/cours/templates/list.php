<h2>Liste des Cours</h2>

<a href="add.php">Ajouter un cours</a>

<?php if (empty($coursList)): ?>
    <p>Aucun cours enregistré.</p>
<?php else: ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Sujet</th>
                <th>Durée (min)</th>
                <th>Test inclus</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($coursList as $cours): ?>
                <tr>
                    <td><?= htmlspecialchars($cours->cours_name) ?></td>
                    <td><?= htmlspecialchars($cours->sujet_name ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($cours->duration) ?></td>
                    <td><?= $cours->testIncluded ? 'Oui' : 'Non' ?></td>
                    <td>
                        <a href="edit.php?id=<?= $cours->id ?>">Modifier</a> |
                        <a href="delete.php?id=<?= $cours->id ?>" onclick="return confirm('Supprimer ce cours ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<a href="../dashboard.php">Retourner au Dashboard</a>
