<?php
require_once '../models/servicebestilling.php';
require_once 'validation.inc.php'; // henter valideringsfunksjoner
session_start();
if (isset($_SESSION['brukernavn'])) {

  if (isset($_POST["submit"]) && $_SERVER['REQUEST_METHOD'] === 'POST') {

    //hent verdier fra skjemaet
    $fornavn = $_POST["fornavn"] ?? '';
    $etternavn = $_POST["etternavn"] ?? '';
    $firma = $_POST["firma"] ?? '';
    $adresse = $_POST["adresse"] ?? '';
    $postnr = $_POST["postnr"] ?? '';
    $by = $_POST["by"] ?? '';
    $mobil = $_POST["mobil"] ?? '';
    $epost = $_POST["epost"] ?? '';
    $butikk = $_POST["butikk"] ?? '';
    $beskrivelse = $_POST["beskrivelse"] ?? '';
    $kundenummer = $_POST["kundenummer"] ?? '';
    $ordrenummer = $_POST["ordrenummer"] ?? '';
    $leilnummer = $_POST["leilnummer"] ?? '';
    $annenkjop = $_POST["annenkjop"] ?? '';
    $leveringsdato = $_POST["leveringsdato"] ?? '';
    $ticket = $_POST["ticket"];

    changeBestilling(sanitizeInput($fornavn), sanitizeInput($etternavn), sanitizeInput($firma), sanitizeInput($adresse), sanitizeInput($postnr), sanitizeInput($by),
      sanitizeInput($mobil), sanitizeInput($epost), sanitizeInput($ordrenummer), sanitizeInput($kundenummer), sanitizeInput($leilnummer), sanitizeInput($butikk),
      sanitizeInput($beskrivelse), sanitizeInput($annenkjop), sanitizeInput($leveringsdato), sanitizeInput($ticket));
    header("location: ../change-order.php?ticket=".$ticket);

  } else {
    header("location: ../skjema.php?error=stmtfailed");
    exit();
  }
} else {
  header("Location: https://www.hthservice.no/admin.php");
}
?>
