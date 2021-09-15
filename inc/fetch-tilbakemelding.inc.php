<?php
require_once '../models/servicebestilling.php';
session_start();

if (isset($_SESSION['brukernavn'])) {
  $tilbakemelding = getTilbakemelding();

  if ($tilbakemelding) { // Hvis det er minst 1 verdi i arrayet
    echo $tilbakemelding;
  } else {
      echo '<span class="not-found">Ingen tilbakemelding funnet.</span>';

  }
}

 ?>
