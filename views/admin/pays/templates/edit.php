<h2>Modifier un Pays</h2>

<?php if (!empty($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="edit.php">
    <input type="hidden" name="id" value="<?= $pays->id ?>">
    <label for="pays_name">Nom du pays:</label>
    <input type="text" id="pays_name" name="pays_name" value="<?= htmlspecialchars($pays->pays_name) ?>" required>
    <button type="submit">Modifier</button>
</form>

<a href="list.php">Retour à la liste</a>
