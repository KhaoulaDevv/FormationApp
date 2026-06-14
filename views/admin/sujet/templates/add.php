<h2>Ajouter un Sujet</h2>
<form method="post" action="add.php">
    <label for="sujet_name">Nom du sujet</label><br>
    <input type="text" id="sujet_name" name="sujet_name" placeholder="Nom"><br><br>

    <label for="shortDescription">Description courte</label><br>
    <textarea id="shortDescription" name="shortDescription" rows="3" cols="50"></textarea><br><br>

    <label for="longDescription">Description longue</label><br>
    <textarea id="longDescription" name="longDescription" rows="4" cols="50"></textarea><br><br>

    <label for="individualBenefit">Bénéfice individuel</label><br>
    <textarea id="individualBenefit" name="individualBenefit" rows="3" cols="50"></textarea><br><br>

    <label for="businessBenefit">Bénéfice pour l'entreprise</label><br>
    <textarea id="businessBenefit" name="businessBenefit" rows="3" cols="50"></textarea><br><br>

    <label for="logo">URL du logo</label><br>
    <input type="text" id="logo" name="logo" placeholder="Logo"><br><br>

    <label for="domaine_id">Domaine associé</label><br>
    <select id="domaine_id" name="domaine_id">
        <option value="">-- Sélectionnez un domaine --</option>
        <?php foreach ($domaineList as $d): ?>
            <option value="<?= $d->id ?>"><?= htmlspecialchars($d->domaine_name) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Ajouter</button>
</form>
