<?php
require_once '../models/servicebestilling.php';
session_start();
if (isset($_SESSION['brukernavn']) && isset($_GET['q'])) {
  $ticket = $_GET['q'];
  $comments = getCommentsAjax($ticket) ?? '';
  echo $comments;
}
