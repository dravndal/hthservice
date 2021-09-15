<?php session_start(); require 'inc/header.php';?>
<link rel="stylesheet" href="styles/montor.css">
<main>
	<!-- wrapper til skjemaet -->
	<section id="wrapper">
		<div class="formwrapper">
			<h1>Montør</h1>
			<span class="description"> Kun For Montører. </span>
			<div class="form-error-message">
				<?php
				// Error meldinger
				if (isset($_GET["error"])) {
					if ($_GET["error"] == "feilkode") {
						echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 30px; height: 30px;' ><p style='color:#FF0000; font-size: 30px;'>Feil kode!</p>";
					} else if ($_GET["error"] == "stmtfailed") {
						echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 30px; height: 30px;' ><p style='color:#FF0000; font-size: 30px;'>Noe gikk galt!</p>";
					}
				}
				?>
			</div>
			<form id="pincode" method="post" action="inc/logg-inn.inc.php">
        <input type="password" name="pin1" id="pin1" maxlength="1" autofocus="autofocus" />
        <input type="password" name="pin2" id="pin2" maxlength="1"/>
        <input type="password" name="pin3" id="pin3" maxlength="1"/>
        <input type="password" name="pin4" id="pin4" maxlength="1"/>
				<br>
				<input hidden id="login-submit" class="form-button" type="submit" name="submit" value="Logg inn">
			</form>
		</div>
	</section>
</main>
<script type="text/javascript">
	var pin1 = document.getElementById("pin1");
	var pin2 = document.getElementById("pin2");
	var pin3 = document.getElementById("pin3");
	var pin4 = document.getElementById("pin4");
	var submit = document.getElementById("login-submit");

	pin1.addEventListener('input', function(){if(pin1.value==""){pin1.focus();} else{pin2.focus();}});
	pin2.addEventListener('input', function(){if(pin2.value==""){pin2.focus();} else{pin3.focus();}});
	pin3.addEventListener('input', function(){if(pin3.value==""){pin3.focus();} else{pin4.focus();}});
	pin4.addEventListener('input', function(){if(pin4.value==""){pin4.focus();} else{submit.click();}});

</script>
<?php require 'inc/footer.php' ?>
