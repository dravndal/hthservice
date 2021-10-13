<?php
require_once '../models/bruker.php';
session_start();
if (isset($_SESSION['brukernavn']) && isset($_GET['q'])) {
  $userInput = $_GET['q'];
  $users = getMontorAjax($userInput);

  if (count($users) > 0) { // Hvis det er minst 1 verdi i arrayet
      $userTable = "<table id='user-table'>"; // Opprett først en tabell med id "uesr-table"
      $userTable .= "<tr><th>Fornavn</th><th>Etternavn</th><th>Kode</th><th>Antall bestillinger</th><th>Slett</th></tr>"; // Append table headers
      /* For hver bruker, lag en table row med data om brukeren */
      foreach ($users as $user) {
          $userTable .= "<tr><td>".$user['fornavn']."</td><td>".$user['etternavn']."</td><td>".$user['kode']."</td><td>0</td><td><button class='delete-button' onclick='deleteUser(this.value)' value='".$user['kode']."'>Slett</button></td></tr>";
      }
      $userTable .= "</table>"; // Avslutt tabellen
      echo $userTable; // Vis tabellen
  } else {
      echo '<span class="not-found">Ingen brukere funnet.</span>';
  }
}
