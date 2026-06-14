<h2>Ajouter un Pays</h2>

<?php if (!empty($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="add.php">
    <label for="pays_name">Nom du pays:</label>
    <input type="text" id="pays_name" name="pays_name" value="<?= htmlspecialchars($old['pays_name'] ?? '') ?>" required>
    <button type="submit">Ajouter</button>
</form>

<a href="list.php">Retour à la liste</a>
