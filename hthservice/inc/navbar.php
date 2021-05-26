<?php
  $currentpage = basename($_SERVER['PHP_SELF']);
  $currentpage = strtolower($currentpage);
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
      <a class="navbar-link navbar-link-background <?php if($currentpage == "index" ) { echo 'navbar-link-background-active';} ?>" href="http://www.hthservice.no/index.php"><img
          class="navbar-link-icon" src="img/icons/home.svg" alt="" style="width: 20px; height: 20px;">Hjem</a>
    </li>
    <li class="navbar-list-item">
      <a class="navbar-link navbar-link-background  <?php if($currentpage == "skjema" ) { echo 'navbar-link-background-active';} ?>" href="http://www.hthservice.no/skjema.php"><img class="navbar-link-icon"
          src="img/icons/wpforms-brands.svg" alt="" style="width: 20px; height: 20px;">Skjema</a>
    </li>
    <li class="navbar-list-item">
      <a class="navbar-link navbar-link-background  <?php if($currentpage == "info" ) { echo 'navbar-link-background-active';} ?>" href="http://www.hthservice.no/info.php"><img class="navbar-link-icon"
          src="img/icons/info-solid.svg" alt="" style="width: 20px; height: 20px;">Info</a>
    </li>
    <li class="navbar-list-item">
      <a class="navbar-link navbar-link-background  <?php if($currentpage == "about" ) { echo 'navbar-link-background-active';} ?>" href="http://www.hthservice.no/about.php"><img class="navbar-link-icon"
          src="img/icons/plus-square.svg" alt="" style="width: 20px; height: 20px;">Om Oss</a>
    </li>
  </ul>
</nav>
