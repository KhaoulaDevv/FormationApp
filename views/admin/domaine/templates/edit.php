<h2>Modifier le Domaine</h2>

<?php if (!empty($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="edit.php">
    <input type="hidden" name="id" value="<?= $domaine->id ?>">

    <label>Nom :</label><br>
    <input type="text" name="domaine_name" value="<?= htmlspecialchars($domaine->domaine_name) ?>" required><br><br>

    <label>Description :</label><br>
    <textarea name="description"><?= htmlspecialchars($domaine->description) ?></textarea><br><br>

    <button type="submit">Mettre à jour</button>
</form>
