<?php
require_once __DIR__.'/../models/servicebestilling.php';
session_start();
$isLoggedIn = isset($_SESSION['brukernavn']);

if ($isLoggedIn) {

  if(isset($_POST["submit"]) && $_SERVER['REQUEST_METHOD'] === 'POST'){

      //hent verdier fra skjemaet
      $tilbakemelding = $_POST['tilbakemelding'];
      changeTilbakemelding($tilbakemelding);
      header("location: ../endre-tilbakemelding.php?error=none");

  } else {
    header("location: ../endre-tilbakemelding.php?error=stmt");
    exit();
  }
} else{
  header("Location: https://www.hthservice.no/admin.php");
}
?>
