<?php
require_once '../models/servicebestilling.php';
require_once 'validation.inc.php'; // henter valideringsfunksjoner
session_start();
if (isset($_SESSION['brukernavn'])) {
  $status = $_POST['status'] ?? '';
  updateComments(sanitizeInput($status));
} else {
  echo '<span class="not-found">Noe gikk galt!</span>';
}
