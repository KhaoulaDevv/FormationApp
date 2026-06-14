<h2>Modifier une Inscription</h2>
<form method="post" action="edit.php">
    <input type="hidden" name="id" value="<?= $inscription->id ?>">

    <label>Prénom:</label><br>
    <input name="firstName" value="<?= htmlspecialchars($inscription->firstName) ?>" required><br><br>

    <label>Nom:</label><br>
    <input name="lastName" value="<?= htmlspecialchars($inscription->lastName) ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($inscription->email) ?>" required><br><br>

    <label>Téléphone:</label><br>
    <input name="phone" value="<?= htmlspecialchars($inscription->phone) ?>"><br><br>

    <label>Entreprise:</label><br>
    <input name="company" value="<?= htmlspecialchars($inscription->company) ?>"><br><br>

    <label>Formation ID:</label><br>
    <input type="number" name="formation_id" value="<?= $inscription->formation_id ?>" required><br><br>

    <label>Paiement effectué ?</label>
    <input type="checkbox" name="paid" <?= $inscription->paid ? 'checked' : '' ?>><br><br>

    <button type="submit">Modifier</button>
</form>
<a href="list.php">Retour à la liste</a>
