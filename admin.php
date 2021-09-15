<?php session_start();require 'inc/header.php';?>
<link rel="stylesheet" href="styles/logg-inn.css">
<main>
	<!-- wrapper til skjemaet -->
	<section id="wrapper">
		<div class="formwrapper">
			<h1>Admin</h1>
			<span class="description"> Kun For administratorer. </span>
			<div class="form-error-message">
				<?php
				// Error meldinger
				if (isset($_GET["error"])) {
					if ($_GET["error"] == "feilbrukernavn") {
						echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 16px; height: 16px;' ><p style='color:#FF0000;'>Feil brukernavn!</p>";
					} else if ($_GET["error"] == "feilpassord") {
						echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 16px; height: 16px;' ><p style='color:#FF0000;'>Feil passord!</p>";
					} else if ($_GET["error"] == "stmtfailed") {
						echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 16px; height: 16px;' ><p style='color:#FF0000;'>Noe gikk galt!</p>";
					}
				}
				?>
			</div>
			<form method="post" action="inc/admin.inc.php">
				<label for="brukernavn">Brukernavn</label>
				<input type="text" name="brukernavn" id="brukernavn" autofocus="autofocus" onfocus="this.select()" required>
				<label for="passord">Passord</label>
				<input type="password" placeholder="********" name="passord" id="passord" required>
				<br>
				<br>
				<input id="login-submit" class="form-button" type="submit" name="submit" value="Logg inn">
			</form>
		</div>
	</section>
</main>
<?php require 'inc/footer.php' ?>
