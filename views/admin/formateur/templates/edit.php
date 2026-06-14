<h2>Modifier le Formateur</h2>

<?php if (!empty($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="edit.php">
    <input type="hidden" name="id" value="<?= htmlspecialchars($formateur->id) ?>">

    <label for="firstName">Prénom</label><br>
    <input type="text" id="firstName" name="firstName" value="<?= htmlspecialchars($formateur->firstName) ?>"><br><br>

    <label for="lastName">Nom</label><br>
    <input type="text" id="lastName" name="lastName" value="<?= htmlspecialchars($formateur->lastName) ?>"><br><br>

    <label for="description">Description</label><br>
    <textarea id="description" name="description" rows="4" cols="50"><?= htmlspecialchars($formateur->description) ?></textarea><br><br>

    <label for="photo">URL de la photo</label><br>
    <input type="text" id="photo" name="photo" value="<?= htmlspecialchars($formateur->photo) ?>"><br><br>

    <button type="submit">Modifier</button>
</form>

<br>
<a href="list.php">Retourner à la liste</a>
