<?php
session_start();
if (isset($_SESSION['brukernavn'])) {
  if (isset($_SESSION['lastActivity']) && (time() - $_SESSION['lastActivity'] > 1800)) {
    // Logger bruker ut om det er mer enn en halvtime siden siste aktivitet
    session_start();
    session_unset();
    session_destroy();
    header("location: admin.php?status=sessionexpired"); // Sett query string-en status til sessionexpired så vi kan gjøre noe på logg-inn.php når script-et mottar get-variabelet
    exit();
  }
  $brukernavn = $_SESSION['brukernavn'];
  $_SESSION['lastActivity'] = time();
} else {
  header("Location: https://www.hthservice.no/admin.php");
}
require 'inc/header.php';
?>
<link rel="stylesheet" href="styles/logg-inn.css">
<div class="back-btn-wrapper">
	<a class="back-button" href="administrasjon.php"><img src="img/icons/arrow-left.svg">Gå tilbake</a>
</div>
<main>
	<!-- wrapper til skjemaet -->
	<section id="wrapper" style="margin-top:0px;">
		<div class="formwrapper">
			<h1>Opprett Montør</h1>
			<div class="form-error-message">
				<?php
				// Error meldinger
				if (isset($_GET["error"])) {
					if ($_GET["error"] == "ugyldignavn") {
						echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 16px; height: 16px;' ><p style='color:#FF0000;'>Ugyldig Navn!</p>";
					} else if ($_GET["error"] == "formangetegn") {
						echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 16px; height: 16px;' ><p style='color:#FF0000;'>For Langt Navn!</p>";
					} else if ($_GET["error"] == "stmtfailed") {
						echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 16px; height: 16px;' ><p style='color:#FF0000;'>Noe gikk galt!</p>";
					} else if ($_GET["error"] == "none") {
						echo "<p style='color:#22bb33;'>Montør Opprettet!</p><img src='img/icons/check.svg' alt='' style = 'width: 16px; height: 16px;'>";
					}
				}
				?>
			</div>
			<form method="post" action="inc/opprett-montor.inc.php">
				<label for="kode">Kode For Montørbestilling</label>
				<input type="text" name="kode" id="kode" autofocus="autofocus" onfocus="this.select()" required>
				<label for="montorfnavn">Fornavn Montør</label>
				<input type="text" name="montorfnavn" id="montorfnavn" required>
				<label for="montorenavn">Etternavn Montør</label>
				<input type="text" name="montorenavn" id="montorenavn" required>
        <label for="montorenavn">Telefonnummer</label>
        <input type="text" name="montortlf" id="montortlf" required>
        <label for="montorenavn">E-post</label>
        <input type="text" name="montorepost" id="montorepost" required>
				<br>
				<br>
				<input id="login-submit" class="form-button" type="submit" name="submit" value="Opprett Montør">
			</form>
		</div>
	</section>
</main>
<?php require 'inc/footer.php' ?>
