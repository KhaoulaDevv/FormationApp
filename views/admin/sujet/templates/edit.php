<h2>Modifier le Sujet</h2>
<form method="post" action="edit.php">
    <input type="hidden" name="id" value="<?= htmlspecialchars($sujet->id) ?>">

    <label for="sujet_name">Nom du sujet</label><br>
    <input type="text" id="sujet_name" name="sujet_name" value="<?= htmlspecialchars($sujet->sujet_name) ?>"><br><br>

    <label for="shortDescription">Description courte</label><br>
    <textarea id="shortDescription" name="shortDescription" rows="3" cols="50"><?= htmlspecialchars($sujet->shortDescription) ?></textarea><br><br>

    <label for="longDescription">Description longue</label><br>
    <textarea id="longDescription" name="longDescription" rows="4" cols="50"><?= htmlspecialchars($sujet->longDescription) ?></textarea><br><br>

    <label for="individualBenefit">Bénéfice individuel</label><br>
    <textarea id="individualBenefit" name="individualBenefit" rows="3" cols="50"><?= htmlspecialchars($sujet->individualBenefit) ?></textarea><br><br>

    <label for="businessBenefit">Bénéfice pour l'entreprise</label><br>
    <textarea id="businessBenefit" name="businessBenefit" rows="3" cols="50"><?= htmlspecialchars($sujet->businessBenefit) ?></textarea><br><br>

    <label for="logo">URL du logo</label><br>
    <input type="text" id="logo" name="logo" value="<?= htmlspecialchars($sujet->logo) ?>"><br><br>

    <label for="domaine_id">Domaine associé</label><br>
    <select id="domaine_id" name="domaine_id">
        <?php foreach ($domaineList as $d): ?>
            <option value="<?= $d->id ?>" <?= ($sujet->domaine_id == $d->id) ? 'selected' : '' ?>>
                <?= htmlspecialchars($d->domaine_name) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Modifier</button>
</form>
