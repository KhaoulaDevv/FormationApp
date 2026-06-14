<h2>Liste des Inscriptions</h2>
<a href="add.php">Ajouter une inscription</a>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Nom Complet</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Entreprise</th>
            <th>Formation ID</th>
            <th>Payé</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($inscriptions as $inscription): ?>
            <tr>
                <td><?= htmlspecialchars($inscription->firstName . ' ' . $inscription->lastName) ?></td>
                <td><?= htmlspecialchars($inscription->email) ?></td>
                <td><?= htmlspecialchars($inscription->phone) ?></td>
                <td><?= htmlspecialchars($inscription->company) ?></td>
                <td><?= $inscription->formation_id ?></td>
                <td><?= $inscription->paid ? 'Oui' : 'Non' ?></td>
                <td>
                    <a href="edit.php?id=<?= $inscription->id ?>">Modifier</a> |
                    <a href="delete.php?id=<?= $inscription->id ?>" onclick="return confirm('Supprimer cette inscription ?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="../dashboard.php">Retour au dashboard</a>
