<?php
// Assume $paysList (array of Pays objects), $villeList (filtered Ville list), $formations (filtered formations), $filters (assoc array: 'pays_id', 'ville_id', 'search'), and $registered_formations (ids) are passed from controller

function selected($a, $b) { return $a == $b ? 'selected' : ''; }

$user_id = $_SESSION['user_id'] ?>

<h2>Liste des formations disponibles</h2>

<form method="GET" action="">
    <label for="pays">Pays:</label>
    <select name="pays_id" id="pays" onchange="onPaysChange()">
        <option value="0">-- Tous les pays --</option>
        <?php foreach ($paysList as $pays): ?>
            <option value="<?= $pays->id ?>" <?= selected($filters['pays_id'] ?? 0, $pays->id) ?>>
                <?= htmlspecialchars($pays->pays_name) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="ville">Ville:</label>
    <select name="ville_id" id="ville" onchange="this.form.submit()" <?= !($filters['pays_id'] ?? 0) ? 'disabled' : '' ?>>
        <option value="0">-- Toutes les villes --</option>
        <?php foreach ($villeList as $ville): ?>
            <option value="<?= $ville->id ?>" <?= selected($filters['ville_id'] ?? 0, $ville->id) ?>>
                <?= htmlspecialchars($ville->ville_name) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="search">Rechercher:</label>
    <input
        type="text"
        name="search"
        id="search"
        value="<?= htmlspecialchars($filters['search'] ?? '') ?>"
        placeholder="Rechercher par domaine, sujet, cours..."
        autocomplete="off"
    />

    <button type="submit">Filtrer</button>
</form>

<?php if (empty($formations)): ?>
    <p>Aucune formation disponible pour le moment.</p>
<?php else: ?>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Domaine</th>
                <th>Sujet</th>
                <th>Nom du cours</th>
                <th>Formateur</th>
                <th>Date</th>
                <th>Mode</th>
                <th>Prix (€)</th>
                <th>Inscription</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($formations as $formation): ?>
                <tr>
                    <td><?= htmlspecialchars($formation->domaine_name) ?></td>
                    <td><?= htmlspecialchars($formation->sujet_name) ?></td>
                    <td><?= htmlspecialchars($formation->cours_name) ?></td>
                    <td><?= htmlspecialchars($formation->formateur_firstName . ' ' . $formation->formateur_lastName) ?></td>
                    <td><?= htmlspecialchars($formation->formation_date) ?></td>
                    <td><?= htmlspecialchars($formation->mode) ?></td>
                    <td><?= number_format($formation->price, 2, ',', ' ') ?></td>
                    <td>
                        <?php if (in_array($formation->formation_id, $registered_formations ?? [])): ?>
                            <em>Déjà inscrit</em>
                        <?php else: ?>
                            <a href="register.php?formation_id=<?= urlencode($formation->formation_id) ?>">S'inscrire</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<script>
function onPaysChange() {
    const paysSelect = document.getElementById('pays');
    const villeSelect = document.getElementById('ville');

    villeSelect.value = '0';
    villeSelect.disabled = (paysSelect.value === '0');
    paysSelect.form.submit();
}
</script>
<p><a href="../contact.php">Contact</a></p>
<p><a href="../home.php">Accueil</a></p>
<a href="../../public/logout.php">Logout</a>
