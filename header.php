<?php ?>
<header>
  <div class="logo-container">
    <img src="assets/logo.svg" alt="Logo KGV Köln-Mauenheim" class="logo" />
  </div>

  <div class="divider"></div>

  <button class="burger" aria-label="Menü öffnen">
    <span></span>
    <span></span>
    <span></span>
  </button>

  <div class="container">
    <?php include 'nav.php'; ?>
  </div>
</header>

<script>
  // Burger-Menü: Toggle Navigation sichtbar/unsichtbar
  document.addEventListener('DOMContentLoaded', function () {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav');

    burger.addEventListener('click', () => {
      nav.classList.toggle('open');
    });
  });
</script>
