<?php ?>
<nav class="nav">
  <ul>
    <li><a href="index.php#willkommen">Start</a></li>
    <li><a href="geschichte.php#geschichte">Über uns</a></li>
    <li><a href="vorstand.php#vorstand">Vorstand</a></li>
    <li><a href="galerie.php#galerie">Galerie</a></li>
    <li><a href="kontakt.php#kontakt">Kontakt</a></li>
    <?php if (isset($_SESSION['user'])): ?>
      <li><a href="dl.php">Downloads</a></li>
      <li><a href="logout.php">Logout (<?= htmlspecialchars($_SESSION['user']) ?>)</a></li>
    <?php else: ?>
      <li><a href="login.php">Login</a></li>
      <li><a href="register.php">Registrieren</a></li>
    <?php endif; ?>
  </ul>
</nav>
