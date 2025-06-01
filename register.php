<?php
session_start();

$errorMsg = '';
$successMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Einfaches Validieren
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = "Bitte gib eine gültige E-Mail-Adresse ein.";
    } elseif (strlen($password) < 6) {
        $errorMsg = "Das Passwort muss mindestens 6 Zeichen lang sein.";
    } else {
        // Nutzer aus JSON laden
        $usersFile = 'users.json';
        $users = [];
        if (file_exists($usersFile)) {
            $users = json_decode(file_get_contents($usersFile), true) ?: [];
        }

        // Prüfen, ob Nutzer schon existiert
        if (isset($users[$email])) {
            $errorMsg = "Diese E-Mail ist bereits registriert.";
        } else {
            // Passwort hashen
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Nutzer hinzufügen
            $users[$email] = ['password' => $hashedPassword];

            // Speichern
            if (file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT))) {
                $successMsg = "Registrierung erfolgreich! Bitte logge dich nun ein.";
                // Hier kein automatischer Login, wie gewünscht
            } else {
                $errorMsg = "Fehler beim Speichern der Daten. Bitte versuche es später nochmal.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <title>Registrieren - Kleingärtner-Verein Köln-Mauenheim</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h2>Registrieren</h2>

    <?php if ($errorMsg): ?>
        <div class="message error"><?= htmlspecialchars($errorMsg) ?></div>
    <?php elseif ($successMsg): ?>
        <div class="message success"><?= htmlspecialchars($successMsg) ?></div>
    <?php endif; ?>

    <form method="POST" action="register.php" novalidate>
        <label for="register-email">E-Mail:</label>
        <input type="email" id="register-email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />

        <label for="register-password">Passwort:</label>
        <input type="password" id="register-password" name="password" required minlength="6" />

        <button type="submit">Registrieren</button>
    </form>
</main>
<footer>
  <p>&copy; 2025 Kleingärtner-Verein Köln-Mauenheim von 1921 e.V.</p>
</footer>

</body>
</html>
