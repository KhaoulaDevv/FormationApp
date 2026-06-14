<?php
require_once __DIR__ . '/../../../config/db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'client') {
    // Not logged in or not admin: redirect to login or access denied page
    header('Location: ../../public/login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$formation_id = $_GET['formation_id'] ?? null;

if (!$formation_id) {
    echo "Formation non spécifiée.";
    exit;
}

// Fetch formation details
$stmt = $pdo->prepare("
    SELECT
        Formation.id, Formation.price, Formation.mode,
        Cours.cours_name AS course_name,
        Formateur.firstName, Formateur.lastName,
        FormationDate.date
    FROM Formation
    LEFT JOIN Cours ON Formation.cours_id = Cours.id
    LEFT JOIN Formateur ON Formation.formateur_id = Formateur.id
    LEFT JOIN FormationDate ON Formation.formation_date_id = FormationDate.id
    WHERE Formation.id = ?
");
$stmt->execute([$formation_id]);
$formation = $stmt->fetch();

if (!$formation) {
    echo "Formation introuvable.";
    exit;
}

$alreadyRegistered = false;
$error = null;
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect inputs
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $company = trim($_POST['company']);

    // Validate
    if (!$firstName || !$lastName || !$phone || !$email) {
        $error = "Veuillez remplir tous les champs obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email invalide.";
    } else {
        // Check for existing registration
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM Inscription WHERE user_id = ? AND formation_id = ?");
        $checkStmt->execute([$user_id, $formation_id]);
        $alreadyRegistered = $checkStmt->fetchColumn() > 0;

        if ($alreadyRegistered) {
            $error = "Vous êtes déjà inscrit à cette formation avec l'adresse email fournie.";
        } else {
            // Insert into Inscription
            $stmt = $pdo->prepare("INSERT INTO Inscription (user_id, firstName, lastName, phone, email, company, formation_id) VALUES (?, ?, ?, ?, ?, ?, ?)");

            if ($stmt->execute([$user_id, $firstName, $lastName, $phone, $email, $company, $formation_id])) {
                $success = true;
            } else {
                $error = "Une erreur est survenue lors de l'inscription.";
            }
        }
    }
}
?>

<h2>Inscription à la formation: <?= htmlspecialchars($formation['course_name']) ?></h2>
<p><strong>Formateur:</strong> <?= htmlspecialchars($formation['firstName'] . ' ' . $formation['lastName']) ?></p>
<p><strong>Date:</strong> <?= htmlspecialchars($formation['date']) ?></p>
<p><strong>Mode:</strong> <?= htmlspecialchars($formation['mode']) ?></p>
<p><strong>Prix:</strong> <?= htmlspecialchars($formation['price']) ?> €</p>

<?php if ($success): ?>
    <p style="color: green;">✅ Inscription réussie ! Merci.</p>
    <p><a href="list.php">Retour aux formations</a></p>
    <?php exit; ?>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <p style="color:red;">❌ <?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="">
    <label>Prénom* : <input type="text" name="firstName" required value="<?= htmlspecialchars($_POST['firstName'] ?? '') ?>"></label><br><br>
    <label>Nom* : <input type="text" name="lastName" required value="<?= htmlspecialchars($_POST['lastName'] ?? '') ?>"></label><br><br>
    <label>Téléphone* : <input type="text" name="phone" required value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"></label><br><br>
    <label>Email* : <input type="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"></label><br><br>
    <label>Entreprise : <input type="text" name="company" value="<?= htmlspecialchars($_POST['company'] ?? '') ?>"></label><br><br>
    <button type="submit">S'inscrire</button>
</form>

<p><a href="list.php">Annuler</a></p>
