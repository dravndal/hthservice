<?php session_start(); require 'inc/header.php';?>
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
    <div class="formwrapper">
      <form method="post" form="" name="bestilling" id="bestilling" action="inc/skjema.inc.php" charset="utf-8" enctype="multipart/form-data">
        <h1>Servicebestilling</h1>
        <hr>
        <div class="form-error-message">
          <?php
          // Error meldinger
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
              echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 30px; height: 30px;' ><p style='color:#FF0000;font-size: 30px;'>Fyll inn alle feltene!</p>";
            } else if ($_GET["error"] == "invalidname") {
              echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 30px; height: 30px;' ><p style='color:#FF0000; font-size: 30px;'>Velg et ordentlig navn!</p>";
            } else if ($_GET["error"] == "invalidemail") {
              echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 30px; height: 30px;' ><p style='color:#FF0000;font-size: 30px;'>Velg en ordentlig e-post!</p>";
            } else if ($_GET["error"] == "stmtfailed") {
              echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 30px; height: 30px;' ><p style='color:#FF0000;font-size: 30px;'>Noe gikk galt! vennligst prøv på nytt.</p>";
            } else if ($_GET["error"] == "none") {
              echo "<p style='color:#22bb33;font-size: 30px;'>Bestillingen er sendt</p><img src='img/icons/check.svg' alt='' style = 'width: 30px; height: 30px;'>";
              echo '<script language="javascript">';
              echo 'alert("Bestilling sendt!")';
              echo '</script>';
            } else if ($_GET["error"] == "invalidpassword") {
              echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 30px; height: 30px;' ><p style='color:#FF0000;font-size: 30px;'>Ugyldig passord</p>";
            } else if ($_GET["error"] == "invalidpost") {
              echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 30px; height: 30px;' ><p style='color:#FF0000;font-size: 30px;'>Ugyldig postnr</p>";
            } else if ($_GET["error"] == "invalidphone") {
              echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 30px; height: 30px;' ><p style='color:#FF0000; font-size: 30px;'>Ugyldig telefonnummer, ingen mellomrom</p>";
            }
          }
          ?>
        </div>
        <br>
        <span class="description">Alle felter med * må fylles ut.</span>

        <label id="fornavn-label">Fornavn:*</label>
        <input type="text" id="fornavn" name="fornavn" value="" autofocus="autofocus" onfocus="this.select()" required/>

        <label id="etternavn-label">Etternavn:*</label>
        <input type="text" id="etternavn" name="etternavn" value="" placeholder="" onfocus="this.select()" required/>

        <label id="firma-label">Firma:</label>
        <input type="text" id="firma" name="firma" placeholder="" onfocus="this.select()">

        <label id="adresse-label">Adresse:*</label>
        <input type="text" id="adresse" name="adresse" onfocus="this.select()" required/>

        <label id="post-label">Postnr:*</label>
        <input type="text" id="postnr" name="postnr" onfocus="this.select()" required/>

        <label id="by-label">By:*</label>
        <input type="text" id="by" name="by" onfocus="this.select()" required/>

        <label id="mobil-label">Mobil:*</label>
        <input type="text" id="mobil" name="mobil" onfocus="this.select()" placeholder="Ingen mellomrom" required/>

        <label id="epost-label">E-post:*</label>
        <input type="email" id="mailkunde" name="mailkunde" placeholder="test@test.no" onfocus="this.select()" required/>

        <label id="ordrenummer-label">Ordrenummer:</label>
        <input pattern="[0-9]{8}" type="text" id="ordrenummer" name="ordrenummer" onfocus="this.select()" placeholder=""/>

        <label id="kundenummer-label">Kundenummer:</label>
        <input type="text" style="font-size: 1em;" id="kundenummer" name="kundenummer" onfocus="this.select()" placeholder="kundenummert finnes på din ordre">

        <label id="leilighetsnummer-label">Leilighetsnummer:</label>
        <input type="text" style="font-size: 1em;" id="leilnummer" name="leilnummer" onfocus="this.select()">

        <label>Hvor er kjøkkenet/bad/garderobe kjøpt:*</label>
        <select id="butikk" name="butikk" required>
          <option value="" selected="selected"> -- Velg butikk -- </option>
          <option value="HTH Sandefjord - Privat">HTH Kjøkkenforum Sandefjord - Privat</option>
          <option value="HTH Sandefjord - Prosjekt">HTH Kjøkkenforum Sandefjord - Prosjekt</option>
          <option value="HTH Sandefjord - GDS">HTH Kjøkkenforum Sandefjord - GDS</option>
        </select>

        <label id="beskrivelse-label">Beskrivelse av problemet:*</label>
        <textarea type="text"style="font-size: 1.1em;" id="beskrivelse" name="beskrivelse" onfocus="this.select()" placeholder="Gjelder ikke for hvitevare produkter - Skal registreres på egen link - Se forsiden" required></textarea>

        <label for="uploaded_file">Vedlegg bilder:*</label>
        <input type="file" name="file1"><br>
        <input type="file" name="file2"><br>
        <input type="file" name="file3"><br>
        <input type="file" name="file4"><br>
        <input type="file" name="file5"><br>

        <label id="annet-label">Kjøp registrert i et annet navn/firma:</label>
        <input type="text" style="font-size: 0.9em;" id="annenkjop" name="annenkjop" onfocus="this.select()" placeholder="Skriv her hvis kjøpet er registrert på en anenn enn deg selv..">
        <br>Skriv "vet ikke" hvis du ikke husker<br>

        <label id="leveringLabel">Leverings-/Overtakelsesdato:*</label>
        <input type="text" id="leveringsdato" name="leveringsdato" onfocus="this.select()" required/>
        <br>
        Eks: 15.01.2021<br>
        <label style="text-align:left;"id="checkboxWrapper">
          Ved å sende inn skjemaet bekrefter jeg herved at mine opplysninger blir brukt i forbindelse med denne henvendelsen! <br>
          Du kan lese personvernerklæringen vår her: <a target="_blank" href="https://www.hthservice.no/privacypolicy.php">Personvernerklæring</a>
        </label>
        <br>
        <input type="reset" id="reset" value="Slett alt">
        <input name="submit" type="submit" value="Send inn">
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

      </form>
    </div>
  </section>
</main>
<?php require 'inc/footer.php' ?>
