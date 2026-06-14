<h2>Liste des Villes</h2>

<a href="add.php">Ajouter une ville</a>

<?php if (empty($villeList)): ?>
    <p>Aucune ville enregistrée.</p>
<?php else: ?>
    <table border="1">
        <thead>
            <tr>
                <th>Nom de la ville</th>
                <th>Pays</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($villeList as $ville): ?>
                <?php
                    $paysName = 'Non défini';
                    foreach ($paysList as $pays) {
                        if ($pays->id === $ville->pays_id) {
                            $paysName = htmlspecialchars($pays->pays_name);
                            break;
                        }
                    }
                ?>
                <tr>
                    <td><?= htmlspecialchars($ville->ville_name) ?></td>
                    <td><?= $paysName ?></td>
                    <td>
                        <a href="edit.php?id=<?= $ville->id ?>">Modifier</a> |
                        <a href="delete.php?id=<?= $ville->id ?>" onclick="return confirm('Supprimer cette ville ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<a href="../dashboard.php">Retourner au Dashboard</a>
