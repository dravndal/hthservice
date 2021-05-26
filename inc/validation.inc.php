<?php

// Sjekker om feltene i skjemaet er tomme
function emptyForm($fornavn, $etternavn, $adresse, $postnr, $by, $mobil, $epost, $butikk, $beskrivelse, $ordrenummer, $leveringsdato) {
	$result;
	if (empty($fornavn) || empty($etternavn) || empty($adresse) || empty($postnr) || empty($by) || empty($mobil) || empty($epost) || empty($butikk) || empty($beskrivelse) || empty($ordrenummer) || empty($leveringsdato)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Sjekker om lovlig fornavn og etternavn
function invalidName($fornavn, $etternavn) {
	$result;
	if (!preg_match("/^[a-zA-ZæøåÆØÅ]*$/", $fornavn) || !preg_match("/^[a-zA-Z ]*$/", $etternavn) ) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// sjekker om lovlig email
function invalidEmail($epost) {
	$result;
	if (!filter_var($epost, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

function invalidPassword($password) {
	$result;
	if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,50}$/', $password)) {
	  $result = true;
	} else{
    $result = false;
	}
	return $result;
}

// lager bruker
function createUser($fornavn, $etternavn, $email, $password){
  $sql = "INSERT INTO users(`e-post`, passord, enavn, fnavn) VALUES (:epost, :passord, :etternavn, :fornavn);";
  $stmt = $GLOBALS['db']->prepare($sql);
	if(!$stmt){
		header("location: ../registrer-bruker.php?error=stmtfailed");
		exit();
	}
  $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
  $stmt->bindParam(':epost', $email);
  $stmt->bindParam(':passord', $hashedPwd);
  $stmt->bindParam(':etternavn', $etternavn);
	$stmt->bindParam(':fornavn', $fornavn);
  $stmt->execute();

	$sql = "INSERT INTO profilbilde (userid, status) VALUES (:id, :status)";
	$stmt = $GLOBALS['db']->prepare($sql);
	if(!$stmt){
		header("location: ../registrer-bruker.php?error=stmtfailed");
		exit();
	}
	$status = 1;
	$stmt->bindParam(':id', $email);
	$stmt->bindParam(':status', $status);
	$stmt->execute();

	header("location: ../registrer-bruker.php?error=none");
	exit();
}

// sjekker om bruker eksisterer
function emailExists($email) {
  $sql = "SELECT * FROM users WHERE `e-post` = :epost;";
	$stmt = $GLOBALS['db']->prepare($sql);
	if (!$stmt) {
	 	header("location: ../registrer-bruker.php?error=stmtfailed");
		exit();
	}
	$stmt->bindParam(':epost', $email);
	$stmt->execute();

	// lagrer assosiativt array av bruker
	$resultData = $stmt->fetch(PDO::FETCH_ASSOC);

	//returnerer bruker eller false dersom ikke eksisterer
	if ($resultData) {
		return $resultData;
	} else {
		$result = false;
		return $result;
	}
}

// Sjekker at alle felt er fylt ut i innlogging
function emptyInputLogin($email, $password) {
	$result;
	if (empty($email) || empty($password)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Logger bruker inn
function loginUser($email, $password) {
	//sjekker om bruker eksisterer
	$emailExists = emailExists($email);
	//gir error om bruker ikke eksisterer
	if ($emailExists === false) {
		header("location: ../logg-inn.php?error=wrongemail");
		exit();
	}
	//sjekker at passordet samsvarer med passordet i databasen
	$hashedPwd = $emailExists["passord"];
	$checkPwd = password_verify($password, $hashedPwd);
	//gir error om passord er feil
	if ($checkPwd === false) {
		header("location: ../logg-inn.php?error=wronglogin");
		exit();
	} elseif ($checkPwd === true) { //logger bruker inn hvis passord er riktig og deklarerer session
		session_start();
		$_SESSION['start'] = time();
		$_SESSION['expire'] = $_SESSION['start'] + 10;
		$_SESSION["navn"] = $emailExists["fnavn"];
		$_SESSION['id'] = $emailExists['e-post'];
		$_SESSION['uid'] = $emailExists['id'];
		$_SESSION["brukerType"] = $emailExists["brukertype"];
		header("location: ../index.php?error=loggedin");
		exit();
	}
}

function changePassword($id, $password) {
	$sql = "UPDATE users SET passord = :passord WHERE `e-post` = :epost;";
	$stmt = $GLOBALS['db']->prepare($sql);
	if (!$stmt) {
		header("location: ../endre-passord.php?error=stmtfailed");
		exit();
	}
	$password = password_hash($password, PASSWORD_DEFAULT);
	$stmt->bindParam(':passord', $password);
	$stmt->bindParam(':epost', $id);
	$stmt->execute();
	header("location: ../min-side.php?error=none");
	exit();
}

function returnImage($userid){
	$sql = "SELECT * FROM profilbilde WHERE userid=:id";
	$stmt = $GLOBALS['db']->prepare($sql);
	if (!$stmt) {
		header("location: ../endre-passord.php?error=stmtfailed");
		exit();
	}
	$stmt->bindParam(':id', $userid);
	$stmt->execute();
	$resultData = $stmt->fetch(PDO::FETCH_ASSOC);
	$id = $resultData['id'];
	$filnavn = $resultData['filnavn'];
	if ($resultData['status'] == 0) {
		echo 'img/profiles/profile' . $filnavn . '?' . mt_rand();
	} else {
		echo 'img/icons/user-circle.svg';
	}
}
