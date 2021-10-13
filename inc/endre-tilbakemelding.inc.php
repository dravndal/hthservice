<?php
require_once '../models/servicebestilling.php';
require_once 'validation.inc.php'; // henter valideringsfunksjoner
session_start();
if (isset($_SESSION['brukernavn'])) {

  if (isset($_POST["submit"]) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      //hent verdier fra skjemaet
      $tilbakemelding = $_POST['tilbakemelding'];
      changeTilbakemelding(sanitizeInput($tilbakemelding));
      header("location: ../endre-tilbakemelding.php?error=none");

  } else {
    header("location: ../endre-tilbakemelding.php?error=stmt");
    exit();
  }
} else {
  header("Location:../admin.php");
}
?>
