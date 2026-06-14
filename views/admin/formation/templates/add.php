<h2>Ajouter une Formation</h2>

<?php if (!empty($error)): ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="add.php">
    <label>Prix (€) :</label><br>
    <input type="number" step="0.01" name="price" required><br><br>

    <label>Mode :</label><br>
    <select name="mode" required>
        <option value="présentiel">Présentiel</option>
        <option value="distanciel">Distanciel</option>
    </select><br><br>

    <label>Cours :</label><br>
    <select name="cours_id" required>
        <option value="">-- Sélectionnez un cours --</option>
        <?php foreach ($coursList as $cours): ?>
            <option value="<?= $cours->id ?>"><?= htmlspecialchars($cours->cours_name) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Formateur :</label><br>
    <select name="formateur_id" required>
        <option value="">-- Sélectionnez un formateur --</option>
        <?php foreach ($formateurList as $formateur): ?>
            <option value="<?= $formateur->id ?>"><?= htmlspecialchars($formateur->firstName . ' ' . $formateur->lastName) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Ville :</label><br>
    <select name="ville_id" required>
        <option value="">-- Sélectionnez une ville --</option>
        <?php foreach ($villeList as $ville): ?>
            <option value="<?= $ville->id ?>"><?= htmlspecialchars($ville->ville_name) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Date de formation :</label><br>
    <input type="date" name="formation_date" required><br><br>

    <button type="submit">Ajouter</button>
</form>
