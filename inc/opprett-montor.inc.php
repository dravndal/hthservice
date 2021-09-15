<?php
require_once __DIR__.'/../models/bruker.php';
require_once 'validation.inc.php'; // henter valideringsfunksjoner

if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
  $kode = $_POST['kode'];
  $fornavn = $_POST['montorfnavn'];
  $etternavn = $_POST['montorenavn'];
  $tlf = $_POST['montortlf'];
  $epost = $_POST['montorepost'];

  createMontor(sanitizeInput($kode), sanitizeInput($fornavn), sanitizeInput($etternavn), sanitizeInput($tlf), sanitizeInput($epost));

} else{
  header("location: ../admin.php?error=stmtfailed");
  exit();
}

?>
