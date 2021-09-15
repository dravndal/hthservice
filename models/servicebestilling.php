<?php
require_once __DIR__.'/../config/db.php';
require_once __DIR__.'/../inc/validation.inc.php';

$db = new mysqlPDO();

function addBestilling($fornavn, $etternavn, $firma, $adresse, $postnr, $by, $mobil, $epost, $ordrenummer, $kundenummer, $leilighetsnummer, $butikk, $beskrivelse, $annet, $leveringsdato, $ticket){
  $sql = "INSERT INTO `Servicebestilling`(`fornavn`, `etternavn`, `firma`, `adresse`,
    `postnr`, `city`, `mobil`, `epost`, `ordrenummer`, `kundenummer`, `leilighetsnummer`,
    `butikk`, `beskrivelse`, `annet`, `leveringsdato`, `ticket`)
    VALUES (:fornavn, :etternavn, :firma, :adresse, :postnr, :city, :mobil,
      :epost, :ordrenummer, :kundenummer, :leilighetsnummer, :butikk,
      :beskrivelse, :annet, :leveringsdato, :ticket)";

      $stmt = $GLOBALS['db']->prepare($sql);
      $stmt->bindParam(':fornavn', $fornavn);
      $stmt->bindParam(':etternavn', $etternavn);
      $stmt->bindParam(':firma', $firma);
      $stmt->bindParam(':adresse', $adresse);
      $stmt->bindParam(':postnr', $postnr);
      $stmt->bindParam(':city', $by);
      $stmt->bindParam(':mobil', $mobil);
      $stmt->bindParam(':epost', $epost);
      $stmt->bindParam(':ordrenummer', $ordrenummer);
      $stmt->bindParam(':kundenummer', $kundenummer);
      $stmt->bindParam(':leilighetsnummer', $leilighetsnummer);
      $stmt->bindParam(':butikk', $butikk);
      $stmt->bindParam(':beskrivelse', $beskrivelse);
      $stmt->bindParam(':annet', $annet);
      $stmt->bindParam(':leveringsdato', $leveringsdato);
      $stmt->bindParam(':ticket', $ticket);

      $stmt->execute();
    }

    function changeBestilling($fornavn, $etternavn, $firma, $adresse, $postnr, $by, $mobil, $epost, $ordrenummer, $kundenummer, $leilighetsnummer, $butikk, $beskrivelse, $annet, $leveringsdato, $ticket){
      $sql = "UPDATE `Servicebestilling` SET `fornavn` = :fornavn, `etternavn` = :etternavn, `firma` = :firma, `adresse` = :adresse, `postnr` = :postnr, `city` = :city, `mobil` = :mobil,
      `epost` = :epost, `ordrenummer` = :ordrenummer, `kundenummer` = :kundenummer, `leilighetsnummer` = :leilighetsnummer, `butikk` = :butikk, `beskrivelse` = :beskrivelse, `annet` = :annet,
      `leveringsdato` = :leveringsdato WHERE `ticket` = :ticket";

      $stmt = $GLOBALS['db']->prepare($sql);
      $stmt->bindParam(':fornavn', $fornavn);
      $stmt->bindParam(':etternavn', $etternavn);
      $stmt->bindParam(':firma', $firma);
      $stmt->bindParam(':adresse', $adresse);
      $stmt->bindParam(':postnr', $postnr);
      $stmt->bindParam(':city', $by);
      $stmt->bindParam(':mobil', $mobil);
      $stmt->bindParam(':epost', $epost);
      $stmt->bindParam(':ordrenummer', $ordrenummer);
      $stmt->bindParam(':kundenummer', $kundenummer);
      $stmt->bindParam(':leilighetsnummer', $leilighetsnummer);
      $stmt->bindParam(':butikk', $butikk);
      $stmt->bindParam(':beskrivelse', $beskrivelse);
      $stmt->bindParam(':annet', $annet);
      $stmt->bindParam(':leveringsdato', $leveringsdato);
      $stmt->bindParam(':ticket', $ticket);

      $stmt->execute();
    }

    function addBestillingMontor($kunde, $montor, $ordrenummer, $beskrivelse, $leveringsdato, $ticket){
      $kundeNavn = explode(" ", $kunde);
      $fornavn = $kunde;
      $etternavn = "";

      if(count($kundeNavn) == 2){
        $fornavn = $kundeNavn[0];
        $etternavn = $kundeNavn[1];
      } else if(count($kundeNavn) == 3){
        $fornavn = $kundeNavn[0] . $kundeNavn[1];
        $etternavn = $kundeNavn[2];
      }

      $sql = "INSERT INTO `Servicebestilling`(`fornavn`, `etternavn`, `montor_id`, `ordrenummer`, `beskrivelse`, `leveringsdato`, `ticket`)
      VALUES (:fornavn, :etternavn, :montor_id, :ordrenummer, :beskrivelse, :leveringsdato, :ticket)";

      $stmt = $GLOBALS['db']->prepare($sql);
      $stmt->bindParam(':fornavn', $fornavn);
      $stmt->bindParam(':etternavn', $etternavn);
      $stmt->bindParam(':montor_id', $montor);
      $stmt->bindParam(':ordrenummer', $ordrenummer);
      $stmt->bindParam(':beskrivelse', $beskrivelse);
      $stmt->bindParam(':leveringsdato', $leveringsdato);
      $stmt->bindParam(':ticket', $ticket);

      $stmt->execute();
    }

    function getOrderAjax($search){
      try {

        $sql = "SELECT * FROM Servicebestilling WHERE concat(`ticket`,`status`) REGEXP :ticket ORDER BY `status`, `ticket` ASC";
        $stmt = $GLOBALS['db']->prepare($sql);
        $stmt->bindParam(':ticket', $search);
        $stmt->execute();
        if ($stmt->rowCount()) {
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $orders;
        } else {
            return false;
        }
      } catch (\Exception $e) {
        echo $e->getMessage();
      }
    }

    function getOrder($ticket){
      $sql = "SELECT * FROM Servicebestilling WHERE `ticket` = :ticket";
      $stmt = $GLOBALS['db']->prepare($sql);
      $stmt->bindParam(':ticket', $ticket);
      $stmt->execute();
      if ($stmt->rowCount()) {
          $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $orders;
      } else {
          return false;
      }
    }

    function getAllOrders(){

      $sql = "SELECT * FROM Servicebestilling ORDER BY `status`, `ticket` ASC";
      $stmt = $GLOBALS['db']->prepare($sql);
      $stmt->execute();
      if ($stmt->rowCount()) {
          $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $orders;
      } else {
          return false;
      }
    }

    function deleteOrder($ticket){
      $sql = 'DELETE FROM `Servicebestilling` WHERE `ticket` = :ticket';
      $stmt = $GLOBALS['db']->prepare($sql);
      $stmt->bindParam(':ticket', $ticket);
      $stmt->execute();
    }

    function updateStatus($status){
      $status = explode(',', $status);
      $sql = 'UPDATE `Servicebestilling` SET `status` = :status WHERE `ticket` = :ticket';
      $stmt = $GLOBALS['db']->prepare($sql);
      $stmt->bindParam(':status', $status[0]);
      $stmt->bindParam(':ticket', $status[1]);
      $stmt->execute();
    }

    function getCommentsAjax($ticket){
      $sql = 'SELECT `kommentarer` FROM Servicebestilling WHERE `ticket`= :ticket';
      $stmt = $GLOBALS['db']->prepare($sql);
      $stmt->bindParam(':ticket', $ticket);
      $stmt->execute();
      if ($stmt->rowCount()) {
          $kommentarer = $stmt->fetchColumn();
          return $kommentarer;
      } else {
          return false;
      }
    }

    function updateComments($status){
      $status = explode(',', $status);
      $sql = 'UPDATE `Servicebestilling` SET `kommentarer` = :comments WHERE `ticket` = :ticket';
      $stmt = $GLOBALS['db']->prepare($sql);
      $stmt->bindParam(':ticket', $status[0]);
      $stmt->bindParam(':comments', $status[1]);
      $stmt->execute();
    }

    function getTilbakemelding(){
      $sql = 'SELECT `tilbakemelding` FROM Tilbakemelding WHERE `id`=1';
      $stmt = $GLOBALS['db']->prepare($sql);
      $stmt->execute();
      if ($stmt->rowCount()) {
          $tilbakemelding = $stmt->fetchColumn();
          return $tilbakemelding;
      } else {
          return false;
      }
    }

    function changeTilbakemelding($tilbakemelding){
      $sql = 'UPDATE `Tilbakemelding` SET `tilbakemelding` = :tilbakemelding WHERE `id` = 1';
      $stmt = $GLOBALS['db']->prepare($sql);
      $stmt->bindParam('tilbakemelding', $tilbakemelding);
      $stmt->execute();
    }
    ?>
