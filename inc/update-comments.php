<?php
require_once '../models/servicebestilling.php';
session_start();
if (isset($_SESSION['brukernavn'])) {
  $status = $_POST['status'] ?? '';
  updateComments($status);
} else{
  echo '<span class="not-found">Noe gikk galt!</span>';
}
