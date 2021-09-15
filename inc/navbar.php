<?php
$currentPage = strtolower(basename($_SERVER['PHP_SELF']));
?>
<nav id="navbar" class="navbar">
  <a href="https://stores.hth.no/butikker/norway/hth-kjokkenforum-sandefjord/"><img style="width: 50px;" src="img/logo.png"></a>
  <div class="navbar-right">
    <!-- Hamburger-meny-knapp -->
    <img class="navbar-button" src="img/icons/bars-solid.svg" style="width: 38px; height: 38px;">
  </div>
  <!-- Navigasjonslisten -->
  <ul class="navbar-list">
    <li class="navbar-list-item">
      <a class="navbar-link navbar-link-background <?php if($currentPage == "index.php" ) { echo 'navbar-link-background-active';} ?>" href="index.php"><img
          class="navbar-link-icon" src="img/icons/home.svg" alt="" style="width: 20px; height: 20px;">Hjem</a>
    </li>
    <li class="navbar-list-item">
      <a class="navbar-link navbar-link-background  <?php if($currentPage == "skjema.php" ) { echo 'navbar-link-background-active';} ?>" href="skjema.php"><img class="navbar-link-icon"
          src="img/icons/wpforms-brands.svg" alt="" style="width: 20px; height: 20px;">Servicebestilling</a>
    </li>
    <li class="navbar-list-item">
      <a class="navbar-link navbar-link-background  <?php if($currentPage == "logg-inn.php" || $currentPage == "montor.php") { echo 'navbar-link-background-active';} ?>" href="logg-inn.php"><img class="navbar-link-icon"
          src="img/icons/user-lock-solid.svg" alt="" style="width: 20px; height: 20px;">Montør</a>
    </li>
    <li class="navbar-list-item">
      <a class="navbar-link navbar-link-background  <?php if($currentPage == "about.php" ) { echo 'navbar-link-background-active';} ?>" href="about.php"><img class="navbar-link-icon"
          src="img/icons/plus-square.svg" alt="" style="width: 20px; height: 20px;">Om Oss</a>
    </li>
    <div class="navbar-divider navbar-divider--vertical"></div>
    <?php
    $isLoggedIn = isset($_SESSION['brukernavn']); // Sjekker om sesjonsvariabelet userId finnes. Om det gjør det vet vi at brukeren er logget inn
      if ($isLoggedIn) {
        /* Linken til min-side.php. I utgangspunktet skulle vi ha profilbilde her fremfor brukerikonet som er der nå, men siden kun kandidater kan ha bilder så ble det ikke noe av */
        echo "<li class='navbar-list-item'><a class='navbar-link";
        if($currentPage == "administrasjon.php" ) { echo ' navbar-link-background-active';}
        echo"' href='administrasjon.php'><img class='navbar-link-icon' src='img/icons/cog-solid.svg' alt='' style='width: 20px; height: 20px; border-radius: 50%;'>Admin</a></li>";
        /* Link til logg-ut.php */
        echo "<li class='navbar-list-item'><a class='navbar-link' href='logg-ut.php'><img class='navbar-link-icon' src='img/icons/sign-out-alt-solid.svg' alt='' style='width: 20px; height: 20px;'>Logg ut</a></li>";
      }
      else {
        /* Om du ikke er innlogget vises registrer-bruker og logg-inn i steden for. */
        echo "<li class='navbar-list-item'><a class='navbar-link";
        if($currentPage == "admin.php" ) { echo ' navbar-link-background-active';}
        echo"' href='admin.php'><img class='navbar-link-icon' src='img/icons/sign-in-alt-solid.svg' alt='' style='width: 20px; height: 20px;'>Admin</a></li>";
      }
    ?>
  </ul>
</nav>
