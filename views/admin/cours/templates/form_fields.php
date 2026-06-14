<?php
// Variables:
//  - $cours (Cours|null)
//  - $sujetList (array)
//  - $error (string|null)
?>

<?php if (!empty($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<label for="cours_name">Nom du Cours</label><br>
<input type="text" id="cours_name" name="cours_name" value="<?= htmlspecialchars($cours->cours_name ?? '') ?>" required><br><br>

<label for="content">Contenu</label><br>
<textarea id="content" name="content" rows="4" cols="50"><?= htmlspecialchars($cours->content ?? '') ?></textarea><br><br>

<label for="description">Description</label><br>
<textarea id="description" name="description" rows="4" cols="50"><?= htmlspecialchars($cours->description ?? '') ?></textarea><br><br>

<label for="audience">Audience</label><br>
<textarea id="audience" name="audience" rows="2" cols="50"><?= htmlspecialchars($cours->audience ?? '') ?></textarea><br><br>

<label for="duration">Durée (en minutes)</label><br>
<input type="number" id="duration" name="duration" value="<?= htmlspecialchars($cours->duration ?? '') ?>"><br><br>

<label for="testIncluded">Test inclus ?</label>
<input type="checkbox" id="testIncluded" name="testIncluded" <?= (!empty($cours) && $cours->testIncluded) ? 'checked' : '' ?>><br><br>

<label for="testContent">Contenu du test</label><br>
<textarea id="testContent" name="testContent" rows="4" cols="50"><?= htmlspecialchars($cours->testContent ?? '') ?></textarea><br><br>

<label for="logo">Logo (URL ou chemin)</label><br>
<input type="text" id="logo" name="logo" value="<?= htmlspecialchars($cours->logo ?? '') ?>"><br><br>

<label for="sujet_id">Sujet</label><br>
<select id="sujet_id" name="sujet_id" required>
    <option value="">-- Choisissez un sujet --</option>
    <?php foreach ($sujetList as $sujet): ?>
        <option value="<?= $sujet->id ?>" <?= (!empty($cours) && $cours->sujet_id == $sujet->id) ? 'selected' : '' ?>>
            <?= htmlspecialchars($sujet->sujet_name) ?>
        </option>
    <?php endforeach; ?>
</select><br><br>
