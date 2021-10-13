<?php

// Sjekker om feltene i skjemaet er tomme
function emptyForm($fornavn, $etternavn, $adresse, $file, $postnr, $by, $mobil, $epost, $butikk, $beskrivelse, $leveringsdato) {
	$result;
	if (empty($fornavn) || empty($etternavn) || empty($adresse) || empty($file) || empty($postnr) || empty($by) || empty($mobil) || empty($epost) || empty($butikk) || empty($beskrivelse) || empty($leveringsdato)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

function emptyMontorForm($kundenavn, $montornavn, $file, $ordrenummer, $beskrivelse, $leveringsdato){
	$result;
	if (empty($kundenavn) || empty($montornavn) || empty($file) || empty($beskrivelse) || empty($ordrenummer) || empty($leveringsdato)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Sjekker om lovlig postnr
function invalidPost($postnr){
	$result;
	if (!preg_match("/^\d{4}$/", $postnr)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Sjekker om lovlig telefonnr
function invalidPhone($mobil){
	$result;
	if (!preg_match("/^\d{8,14}$/", $mobil)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Sjekker om lovlig fornavn og etternavn
function invalidName($fornavn, $etternavn) {
	$result;
	if (!preg_match("/^[a-zA-ZæøåÆØÅ  -]+$/", $fornavn) || !preg_match("/^[a-zA-ZæøåÆØÅ  -]+$/", $etternavn)) {
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

function createTicket($suffix, $prefix, $number){
	$ticket;
	$suffix = mb_substr($suffix, 0, 2);
	$prefix = mb_substr($prefix, 0, 2);
	$ticket = $suffix . $prefix . "-" . $number;
	$ticket = mb_strtolower($ticket);
	return $ticket;
}

function sanitizeInput($input) {
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);
	return $input;
}
