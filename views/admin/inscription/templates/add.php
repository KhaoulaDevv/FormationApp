<h2>Ajouter une Inscription</h2>
<form method="post" action="add.php">
    <label>Prénom:</label><br>
    <input name="firstName" required><br><br>

    <label>Nom:</label><br>
    <input name="lastName" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Téléphone:</label><br>
    <input name="phone"><br><br>

    <label>Entreprise:</label><br>
    <input name="company"><br><br>

    <label>Formation ID:</label><br>
    <input type="number" name="formation_id" required><br><br>

    <label>Paiement effectué ?</label>
    <input type="checkbox" name="paid"><br><br>

    <button type="submit">Ajouter</button>
</form>
<a href="list.php">Retour à la liste</a>
