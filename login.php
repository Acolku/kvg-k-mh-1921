<?php session_start(); ?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <title>Login - Kleingärtner-Verein Köln-Mauenheim</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<header>
  <div class="logo-container">
    <img src="assets/logo.svg" alt="Logo KGV Köln-Mauenheim" class="logo" />
  </div>

  <div class="divider"></div>

  <button class="burger" aria-label="Menü öffnen">
    <span></span><span></span><span></span>
  </button>

  <div class="container">
    <?php include 'nav.php'; ?>
  </div>
</header>

<main>
  <section id="login">
    <h2>Login</h2>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="message error"><?= htmlspecialchars($_SESSION['error']) ?></div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form method="POST" action="login_process.php">
      <label for="login-email">E-Mail:</label>
      <input type="email" id="login-email" name="email" required />

      <label for="login-password">Passwort:</label>
      <input type="password" id="login-password" name="password" required />

      <button type="submit">Einloggen</button>
    </form>
  </section>
</main>

<footer>
  <p>&copy; 2025 Kleingärtner-Verein Köln-Mauenheim von 1921 e.V.</p>
</footer>

<script>
  const burger = document.querySelector('.burger');
  const nav = document.querySelector('.nav');
  burger.addEventListener('click', () => nav.classList.toggle('open'));
</script>
</body>
</html>
