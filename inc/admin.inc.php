<?php
require_once '../models/bruker.php';
require_once 'validation.inc.php'; // henter valideringsfunksjoner

if (isset($_POST['submit'])) {
  $brukernavn = $_POST['brukernavn'];
  $passord = $_POST['passord'];
  loginAdmin(sanitizeInput($brukernavn), sanitizeInput($passord));
} else {
  header("location: ../admin.php?error=stmtfailed");
  exit();
}
?>
