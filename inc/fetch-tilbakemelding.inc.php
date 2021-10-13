<?php
require_once '../models/servicebestilling.php';
session_start();

if (isset($_SESSION['brukernavn'])) {
  $tilbakemelding = getTilbakemelding();

  if ($tilbakemelding != false) { 
    echo $tilbakemelding;
  } else {
      echo '<span class="not-found">Ingen tilbakemelding funnet.</span>';
  }
}

 ?>
