<?php
require_once '../models/servicebestilling.php';
session_start();
if (isset($_SESSION['brukernavn'])) {
      $kode = $_POST['kode'];
      deleteOrder($kode);
} else{
  echo '<span class="not-found">Noe gikk galt!</span>';
}
