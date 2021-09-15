<?php
require_once __DIR__.'/../models/bruker.php';
require_once 'validation.inc.php'; // henter valideringsfunksjoner

if(isset($_POST['submit'])){
  $brukernavn = $_POST['brukernavn'];
  $passord = $_POST['passord'];
  loginAdmin($brukernavn, $passord);
} else{
  header("location: ../admin.php?error=stmtfailed");
  exit();
}
?>
