<h2>Liste des Domaines</h2>

<a href="add.php">Ajouter un domaine</a>

<?php if (empty($domaineList)): ?>
    <p>Aucun domaine enregistré.</p>
<?php else: ?>
    <table border="1" cellpadding="8" >
        <thead>
            <tr>
                <th>Nom du domaine</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($domaineList as $domaine): ?>
                <tr>
                    <td><?= htmlspecialchars($domaine->domaine_name) ?></td>
                    <td><?= nl2br(htmlspecialchars($domaine->description)) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $domaine->id ?>">Modifier</a> |
                        <a href="delete.php?id=<?= $domaine->id ?>" onclick="return confirm('Supprimer ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<a href="../dashboard.php">Retourner au Dashboard</a>
