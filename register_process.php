<?php
session_start();

if (empty($_POST['email']) || empty($_POST['password'])) {
    header('Location: register.php?error=missing');
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];

// Nutzer aus JSON-Datei laden (oder leeres Array, wenn Datei nicht existiert)
$usersFile = 'users.json';
if (file_exists($usersFile)) {
    $users = json_decode(file_get_contents($usersFile), true);
    if (!is_array($users)) $users = [];
} else {
    $users = [];
}

// Prüfen, ob E-Mail schon registriert ist
foreach ($users as $user) {
    if ($user['email'] === $email) {
        header('Location: register.php?error=exists');
        exit;
    }
}

// Passwort hashen
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Neuen User hinzufügen
$users[] = [
    'email' => $email,
    'password_hash' => $passwordHash
];

// JSON-Datei speichern
file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

// Weiterleitung zur Login-Seite nach erfolgreicher Registrierung
header('Location: login.php?success=registered');
exit;
