<h2>Liste des Sujets</h2>

<a href="add.php">Ajouter un sujet</a><br><br>

<?php if (empty($sujetList)): ?>
    <p>Aucun sujet trouvé.</p>
<?php else: ?>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du Sujet</th>
                <th>Domaine</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sujetList as $sujet): ?>
                <tr>
                    <td><?= htmlspecialchars($sujet->id) ?></td>
                    <td><?= htmlspecialchars($sujet->sujet_name) ?></td>
                    <td><?= htmlspecialchars($sujet->domaine_name ?? 'N/A') ?></td>
                    <td>
                        <a href="edit.php?id=<?= $sujet->id ?>">Modifier</a> |
                        <a href="delete.php?id=<?= $sujet->id ?>" onclick="return confirm('Supprimer ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<br>
<a href="../dashboard.php">Retourner au Dashboard</a>
