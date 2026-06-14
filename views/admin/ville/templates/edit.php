<h2>Modifier la Ville</h2>

<?php if (!empty($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="edit.php">
    <input type="hidden" name="id" value="<?= $ville->id ?>">

    <label for="ville_name">Nom de la ville :</label><br>
    <input type="text" id="ville_name" name="ville_name" value="<?= htmlspecialchars($ville->ville_name) ?>" required><br><br>

    <label for="pays_id">Pays :</label><br>
    <select id="pays_id" name="pays_id">
        <option value="">-- Sélectionnez un pays --</option>
        <?php foreach ($paysList as $pays): ?>
            <option value="<?= $pays->id ?>" <?= ($ville->pays_id == $pays->id) ? 'selected' : '' ?>>
                <?= htmlspecialchars($pays->pays_name) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Enregistrer</button>
</form>
