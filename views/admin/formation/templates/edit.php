<h2>Modifier la Formation #<?= htmlspecialchars($formation->id) ?></h2>

<?php if (!empty($error)): ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="edit.php">
    <input type="hidden" name="id" value="<?= htmlspecialchars($formation->id) ?>">

    <label>Prix (€) :</label><br>
    <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($formation->price) ?>" required><br><br>

    <label>Mode :</label><br>
    <select name="mode" required>
        <option value="présentiel" <?= $formation->mode === 'présentiel' ? 'selected' : '' ?>>Présentiel</option>
        <option value="distanciel" <?= $formation->mode === 'distanciel' ? 'selected' : '' ?>>Distanciel</option>
    </select><br><br>

    <label>Cours :</label><br>
    <select name="cours_id" required>
        <?php foreach ($coursList as $cours): ?>
            <option value="<?= $cours->id ?>" <?= $cours->id == $formation->cours_id ? 'selected' : '' ?>>
                <?= htmlspecialchars($cours->cours_name) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Formateur :</label><br>
    <select name="formateur_id" required>
        <?php foreach ($formateurList as $formateur): ?>
            <option value="<?= $formateur->id ?>" <?= $formateur->id == $formation->formateur_id ? 'selected' : '' ?>>
                <?= htmlspecialchars($formateur->firstName . ' ' . $formateur->lastName) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Ville :</label><br>
    <select name="ville_id" required>
        <?php foreach ($villeList as $ville): ?>
            <option value="<?= $ville->id ?>" <?= $ville->id == $formation->ville_id ? 'selected' : '' ?>>
                <?= htmlspecialchars($ville->ville_name) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Date de formation :</label><br>
    <input
        type="date"
        name="formation_date"
        value="<?= htmlspecialchars($formation_date_str ?: date('Y-m-d')) ?>"
        required
    ><br><br>

    <button type="submit">Mettre à jour</button>
</form>
