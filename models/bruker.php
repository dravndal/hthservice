<?php

require_once __DIR__.'/../config/db.php';
require_once __DIR__.'/../inc/validation.inc.php';

try {
    $db = new mysqlPDO();
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

function createMontor($kode, $fornavn, $etternavn, $tlf, $epost) {
    if (invalidName($fornavn, $etternavn)) {
        header("location: ../opprett-montor.php?error=ugyldignavn");
    } else if (strlen($fornavn) > 45 || strlen($etternavn) > 45) {
        header("location: ../opprett-montor.php?error=formangetegn");
    } else {
        $sql = "INSERT INTO Montor(`kode`, `fornavn`, `etternavn`, `telefon`, `epost`) VALUES (:kode, :fornavn, :etternavn, :telefon, :epost)";
        $stmt = $GLOBALS['db']->prepare($sql);
        $stmt->bindParam(':kode', $kode);
        $stmt->bindParam(':fornavn', $fornavn);
        $stmt->bindParam(':etternavn', $etternavn);
        $stmt->bindParam(':telefon', $tlf);
        $stmt->bindParam(':epost', $epost);
        $stmt->execute();
        header("location: ../opprett-montor.php?error=none");
    }
}

function deleteMontor($kode){
  $sql = 'DELETE FROM `Montor` WHERE `kode` = :kode';
  $stmt = $GLOBALS['db']->prepare($sql);
  $stmt->bindParam(':kode', $kode);
  $stmt->execute();
}

function getAdminById($id) {
    $sql = "SELECT * FROM Admin WHERE brukernavn = :id";
    $stmt = $GLOBALS['db']->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    if ($stmt->rowCount()) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    } else {
        return false;
    }
}

function getMontorById($id) {
    $sql = "SELECT * FROM Montor WHERE kode = :id";
    $stmt = $GLOBALS['db']->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    if ($stmt->rowCount()) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    } else {
        return false;
    }
}

function getMontors() {
    $sql = "SELECT * FROM Montor";
    $stmt = $GLOBALS['db']->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount()) {
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    } else {
        return false;
    }
}

function getMontorAjax($search){
  try {
    $sql = "SELECT * FROM Montor WHERE `fornavn` LIKE \"%\":fornavn\"%\"";
    $stmt = $GLOBALS['db']->prepare($sql);
    $stmt->bindParam(':fornavn', $search);
    $stmt->execute();
    if ($stmt->rowCount()) {
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    } else {
        return false;
    }
  } catch (\Exception $e) {
    echo $e->getMessage();
  }
}

function createAdmin($brukernavn, $passord){
  $sql = "INSERT INTO Admin(`brukernavn`, `passord`) VALUES (:brukernavn, :passord)";
  $stmt = $GLOBALS['db']->prepare($sql);
  $hashedPassword = password_hash($passord, PASSWORD_DEFAULT); // Hash passordet
  if (!$stmt || !$hashedPassword) {
      throw new Exception('Noe gikk galt!');
  }
  $stmt->bindParam(':brukernavn', $brukernavn);
  $stmt->bindParam(':passord', $hashedPassword); // Legg det hashede passordet i databasen
  $stmt->execute();
}

function loginAdmin($brukernavn, $passord) {
    $user = getAdminById($brukernavn); // Henter bruker
    if ($user) { // Om bruker finnes
        if (!password_verify($passord, $user['passord'])) {
          header("location: ../admin.php?error=feilpassord");
        } else{
          session_start();
          $_SESSION['brukernavn'] = $user['brukernavn'];
          $_SESSION['lastActivity'] = time();
        }
        header("location: ../administrasjon.php");
    } else {
        header("location: ../admin.php?error=feilbrukernavn");
    }
}

function loginMontor($pincode){
  $user = getMontorById($pincode);
  if($user){
    session_start();
    $_SESSION['montor'] = $user['kode'];
    $_SESSION['fornavn'] = $user['fornavn'];
    $_SESSION['etternavn'] = $user['etternavn'];
    $_SESSION['lastActivity'] = time();
    header("location: ../montor.php");
  } else{
    header("location: ../logg-inn.php?error=feilkode");
  }
}

 ?>
