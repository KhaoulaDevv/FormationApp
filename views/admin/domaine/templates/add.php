<h2>Ajouter un Domaine</h2>

<?php if (!empty($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="add.php">
    <label>Nom :</label><br>
    <input type="text" name="domaine_name" required><br><br>

    <label>Description :</label><br>
    <textarea name="description"></textarea><br><br>

    <button type="submit">Ajouter</button>
</form>
