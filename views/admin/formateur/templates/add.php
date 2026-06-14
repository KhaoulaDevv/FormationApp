<h2>Ajouter un Formateur</h2>

<?php if (!empty($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="add.php">
    <label for="firstName">Prénom</label><br>
    <input type="text" id="firstName" name="firstName" value="<?= htmlspecialchars($_POST['firstName'] ?? '') ?>"><br><br>

    <label for="lastName">Nom</label><br>
    <input type="text" id="lastName" name="lastName" value="<?= htmlspecialchars($_POST['lastName'] ?? '') ?>"><br><br>

    <label for="description">Description</label><br>
    <textarea id="description" name="description" rows="4" cols="50"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea><br><br>

    <label for="photo">URL de la photo</label><br>
    <input type="text" id="photo" name="photo" value="<?= htmlspecialchars($_POST['photo'] ?? '') ?>"><br><br>

    <button type="submit">Ajouter</button>
</form>

<br>
<a href="list.php">Retourner à la liste</a>
