<?php
session_start();

if (empty($_POST['email']) || empty($_POST['password'])) {
    $_SESSION['error'] = 'Bitte E-Mail und Passwort eingeben.';
    header('Location: login.php');
    exit;
}

$email = trim($_POST['email']);
$password = $_POST['password'];

$users = json_decode(file_get_contents('users.json'), true);

if (!isset($users[$email])) {
    $_SESSION['error'] = 'Ungültige E-Mail oder Passwort.';
    header('Location: login.php');
    exit;
}

$foundUser = $users[$email];

if (!password_verify($password, $foundUser['password'])) {
    $_SESSION['error'] = 'Ungültige E-Mail oder Passwort.';
    header('Location: login.php');
    exit;
}

$_SESSION['user'] = $email;
header('Location: index.php');
exit;
?>
