<?php
require_once '../models/servicebestilling.php';
require_once 'validation.inc.php'; // henter valideringsfunksjoner
session_start();
if (isset($_SESSION['brukernavn'])) {
      $kode = $_POST['kode'];
      deleteOrder(sanitizeInput($kode));
} else {
  echo '<span class="not-found">Noe gikk galt!</span>';
}
