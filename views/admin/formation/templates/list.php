<h2>Liste des Formations</h2>
<a href="add.php">Ajouter une Formation</a>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Prix (€)</th>
            <th>Mode</th>
            <th>Cours</th>
            <th>Formateur</th>
            <th>Ville</th>
            <th>Date de Formation</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($formationList)): ?>
        <?php foreach ($formationList as $formation): ?>
            <tr>
                <td><?= htmlspecialchars($formation->id) ?></td>
                <td><?= htmlspecialchars($formation->price) ?></td>
                <td><?= htmlspecialchars($formation->mode) ?></td>
                <td><?= htmlspecialchars($formation->cours_name ?? '-') ?></td>
                <td><?= htmlspecialchars(($formation->formateur_firstName ?? '') . ' ' . ($formation->formateur_lastName ?? '')) ?></td>
                <td><?= htmlspecialchars($formation->ville_name ?? '-') ?></td>
                <td><?= htmlspecialchars($formation->date ?? '-') ?></td>
                <td>
                    <a href="edit.php?id=<?= $formation->id ?>">Modifier</a> |
                    <a href="delete.php?id=<?= $formation->id ?>" onclick="return confirm('Voulez-vous vraiment supprimer ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="8">Aucune formation trouvée.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
<a href="../dashboard.php">Retourner au Dashboard</a>