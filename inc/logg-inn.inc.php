<?php
require_once __DIR__.'/../models/bruker.php';
require_once 'validation.inc.php'; // henter valideringsfunksjoner

if(isset($_POST['submit'])){
  $pin1 = $_POST['pin1'];
  $pin2 = $_POST['pin2'];
  $pin3 = $_POST['pin3'];
  $pin4 = $_POST['pin4'];
  $pincode = $pin1 . $pin2 . $pin3 . $pin4;
  loginMontor($pincode);
} else{
  header("location: ../admin.php?error=stmtfailed");
  exit();
}
?>
