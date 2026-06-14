<h2>Modifier le Cours</h2>

<form method="post" action="edit.php">
    <input type="hidden" name="id" value="<?= $cours->id ?>">
    <?php require __DIR__ . '/form_fields.php'; ?>
    <button type="submit">Modifier</button>
</form>
