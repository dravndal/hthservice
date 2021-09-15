<?php
session_start();
$isLoggedIn = isset($_SESSION['brukernavn']); // Sjekker om sesjonsvariabelet userId finnes. Om det gjør det vet vi at brukeren er logget inn
if ($isLoggedIn) {
  if (isset($_SESSION['lastActivity']) && (time() - $_SESSION['lastActivity'] > 1800)) {
    // Logger bruker ut om det er mer enn en halvtime siden siste aktivitet
    session_start();
    session_unset();
    session_destroy();
    header("location: admin.php?status=sessionexpired"); // Sett query string-en status til sessionexpired så vi kan gjøre noe på logg-inn.php når script-et mottar get-variabelet
    exit();
  }
  $brukernavn = $_SESSION['brukernavn'];
  $_SESSION['lastActivity'] = time();
} else{
  header("Location: admin.php");
}
require 'inc/header.php';
?>
<link rel="stylesheet" href="styles/administrasjon.css">
<main>
  <header id="header">
    <h1>Administrasjon</h1>
  </header>
  <section id="administration-navigation">
    <?php
    if ($isLoggedIn) {

      echo '<ul class="administration-list">
      <li class="administration-list-item">
      <a class="administration-list-link" href="opprett-montor.php">
      <img class="administration-list-icon" src="img/icons/plus-square.svg" alt="">
      <span class="administration-list-text">Opprett Montør</span>
      </a>
      </li>';
      echo '<li class="administration-list-item">
      <a class="administration-list-link" href="administrer-montor.php">
      <img class="administration-list-icon" src="img/icons/user-cog.svg" alt="">
      <span class="administration-list-text">Administrer Montører</span>
      </a>
      </li>';
      echo '<li class="administration-list-item">
      <a class="administration-list-link" href="administrer-bestillinger.php">
      <img class="administration-list-icon" src="img/icons/wpforms-brands.svg" alt="">
      <span class="administration-list-text">Administrer Bestillinger</span>
      </a>
      </li>';
      echo '<li class="administration-list-item">
      <a class="administration-list-link" href="endre-tilbakemelding.php">
      <img class="administration-list-icon" src="img/icons/envelope-solid.svg" alt="">
      <span class="administration-list-text">Endre Tilbakemelding</span>
      </a>
      </li>
      </ul>';
    }
    ?>
  </section>
</main>
<?php require 'inc/footer.php' ?>
