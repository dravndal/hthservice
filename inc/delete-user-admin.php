<?php
require_once '../models/bruker.php';
session_start();
if (isset($_SESSION['brukernavn'])) {
      $kode = $_POST['kode'];
      deleteMontor($kode);
} else{
  echo '<span class="not-found">Noe gikk galt!</span>';
}
