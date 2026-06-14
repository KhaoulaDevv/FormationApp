<?php
session_start();

$name = $email = $subject = $message = '';
$error = $success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Trim and collect inputs
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Basic validation
    if (!$name || !$email || !$subject || !$message) {
        $error = "Veuillez remplir tous les champs.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "L'adresse email est invalide.";
    } else {
        // In a real app, save to DB or send email
        $success = "Votre message a été envoyé avec succès. Nous vous contacterons bientôt.";
        // Reset form
        $name = $email = $subject = $message = '';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contactez-nous</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2em; }
        form { max-width: 600px; }
        input, textarea { width: 100%; padding: 10px; margin-bottom: 1em; }
        label { font-weight: bold; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>

<h1>Contactez-nous</h1>

<?php if ($error): ?>
    <p class="error">❌ <?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php if ($success): ?>
    <p class="success">✅ <?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<form method="post" action="contact.php">
    <label for="name">Nom complet *</label>
    <input type="text" id="name" name="name" required value="<?= htmlspecialchars($name) ?>">

    <label for="email">Email *</label>
    <input type="email" id="email" name="email" required value="<?= htmlspecialchars($email) ?>">

    <label for="subject">Sujet *</label>
    <input type="text" id="subject" name="subject" required value="<?= htmlspecialchars($subject) ?>">

    <label for="message">Message *</label>
    <textarea id="message" name="message" rows="5" required><?= htmlspecialchars($message) ?></textarea>

    <button type="submit">Envoyer</button>
</form>

<p><a href="home.php">Retour à l'accueil</a></p>

</body>
</html>
