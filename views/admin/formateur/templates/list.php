<h2>Liste des Formateurs</h2>
<a href="add.php">Ajouter un formateur</a><br><br>

<?php if (empty($formateurList)): ?>
    <p>Aucun formateur trouvé.</p>
<?php else: ?>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($formateurList as $formateur): ?>
                <tr>
                    <td><?= htmlspecialchars($formateur->id) ?></td>
                    <td><?= htmlspecialchars($formateur->firstName) ?></td>
                    <td><?= htmlspecialchars($formateur->lastName) ?></td>
                    <td><?= nl2br(htmlspecialchars($formateur->description)) ?></td>
                    <td>
                        <?php if (!empty($formateur->photo)): ?>
                            <img src="<?= htmlspecialchars($formateur->photo) ?>" alt="Photo de <?= htmlspecialchars($formateur->firstName) ?>" style="max-width: 100px; max-height: 100px;">
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="edit.php?id=<?= $formateur->id ?>">Modifier</a> |
                        <a href="delete.php?id=<?= $formateur->id ?>" onclick="return confirm('Supprimer ce formateur ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<br>
<a href="../dashboard.php">Retourner au Dashboard</a>
