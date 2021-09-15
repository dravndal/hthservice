<?php
session_start();
$isLoggedIn = isset($_SESSION['montor']); // Sjekker om sesjonsvariabelet userId finnes. Om det gjør det vet vi at brukeren er logget inn
if ($isLoggedIn) {
  if (isset($_SESSION['lastActivity']) && (time() - $_SESSION['lastActivity'] > 1800)) {
    // Logger bruker ut om det er mer enn en halvtime siden siste aktivitet
    session_start();
    session_unset();
    session_destroy();
    header("location: admin.php?status=sessionexpired"); // Sett query string-en status til sessionexpired så vi kan gjøre noe på logg-inn.php når script-et mottar get-variabelet
    exit();
  }
  $_SESSION['lastActivity'] = time();
} else{
  header("Location: admin.php");
}
require 'inc/header.php';
?>
<script src="https://www.google.com/recaptcha/api.js?render=6Ld_OvAaAAAAAPQL2oP07shHo2FxmkP_4gCp4HTx"></script>
<script>

grecaptcha.ready(function () {
  grecaptcha.execute('6Ld_OvAaAAAAAPQL2oP07shHo2FxmkP_4gCp4HTx', { action: 'skjema' }).then(function (token) {
    var recaptchaResponse = document.getElementById('recaptchaResponse');
    recaptchaResponse.value = token;
  });
});

</script>
<link rel="stylesheet" href="styles/skjema.css">
<main>
  <!-- wrapper til skjemaet -->
  <section id="wrapper">
    <div class="back-btn-wrapper">
      <a class="back-button" href="logg-ut.php"><img src="img/icons/arrow-left.svg">Logg ut</a>
    </div>
    <div class="formwrapper">
      <form method="post" form="" name="montor" id="montor" action="inc/montor.inc.php" charset="utf-8" enctype="multipart/form-data">
        <h1>Montør</h1>
        <hr>
        <div class="form-error-message">
          <?php
          // Error meldinger
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
              echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 30px; height: 30px;' ><p style='color:#FF0000;font-size: 30px;'>Fyll inn alle feltene!</p>";
            } else if ($_GET["error"] == "invalidname") {
              echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 30px; height: 30px;' ><p style='color:#FF0000; font-size: 30px;'>Velg et ordentlig navn!</p>";
            } else if ($_GET["error"] == "stmtfailed") {
              echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 30px; height: 30px;' ><p style='color:#FF0000;font-size: 30px;'>Noe gikk galt! vennligst prøv på nytt.</p>";
            } else if ($_GET["error"] == "none") {
              echo "<p style='color:#22bb33;font-size: 30px;'>Bestillingen er sendt</p><img src='img/icons/check.svg' alt='' style = 'width: 30px; height: 30px;'>";
            }
          }
          ?>
        </div>
        <br>
        <span class="description">Alle felter med * må fylles ut.</span>

        <label>Navn montør:</label>
        <input readonly type="text" id="montornavn" name="montornavn" style="text-align: center;"value="<?php echo mb_strtoupper($_SESSION['fornavn']) . ' ' . mb_strtoupper($_SESSION['etternavn']) ?>"/>


        <label>Navn kunde:*</label>
        <input type="text" id="kundenavn" name="kundenavn" value="" autofocus="autofocus" onfocus="this.select()" required/>

        <label id="ordrenummer-label">Ordrenummer:*</label>
        <input pattern="[0-9]{8}" type="text" id="ordrenummer" name="ordrenummer" placeholder="" onfocus="this.select()" required/>

        <label>Beskrivelse av problemet:*</label>
        <textarea type="text"style="font-size: 1.1em;" id="beskrivelse" name="beskrivelse" onfocus="this.select()" required></textarea>

        <label for="uploaded_file">Vedlegg bilder:*</label>
        <input type="file" name="file1"><br>
        <input type="file" name="file2"><br>
        <input type="file" name="file3"><br>
        <input type="file" name="file4"><br>
        <input type="file" name="file5"><br>

        <label>Leverings-/Overtakelsesdato:</label>
        <input type="text" id="leveringsdato" name="leveringsdato" onfocus="this.select()"/>
        <br>
        Eks: 15.01.2021<br>
        <br>
        <br>
        <input type="reset" id="reset" value="Slett alt">
        <input name="submit" type="submit" value="Send inn">
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

      </form>
    </div>
  </section>
</main>
<?php require 'inc/footer.php' ?>
