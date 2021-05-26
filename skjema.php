<!-- registrer-bruker.php laget av Daniel Ravndal og Leander Didriksen. Sist endret 14.10.2020 av Kevin André Torgrimsen Nordli. -->
<?php require 'inc/header.php' ?>
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
        <h1 style="font-size: 66px;">Servicebestilling</h1>
        <hr>
        <div class="form-error-message">
          <?php
          // Error meldinger
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
              echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 16px; height: 16px;' ><p style='color:#FF0000;'>Fyll inn alle feltene!</p>";
            } else if ($_GET["error"] == "invalidname") {
              echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 16px; height: 16px;' ><p style='color:#FF0000;'>Velg et ordentlig navn!</p>";
            } else if ($_GET["error"] == "invalidemail") {
              echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 16px; height: 16px;' ><p style='color:#FF0000;'>Velg en ordentlig e-post!</p>";
            } else if ($_GET["error"] == "stmtfailed") {
              echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 16px; height: 16px;' ><p style='color:#FF0000;'>Noe gikk galt! vennligst prøv på nytt.</p>";
            } else if ($_GET["error"] == "emailtaken") {
              echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 16px; height: 16px;' ><p style='color:#FF0000;'>E-post allerede i bruk</p>";
            } else if ($_GET["error"] == "none") {
              echo "<p style='color:#22bb33;'>Bestilling sendt</p><img src='img/icons/check.svg' alt='' style = 'width: 16px; height: 16px;' >";
            } else if ($_GET["error"] == "invalidpassword") {
              echo "<img src='img/icons/exclamation-triangle.svg' alt='' style = 'width: 16px; height: 16px;' ><p style='color:#FF0000;'>Ugyldig passord</p>";
            }
          }
          ?>
        </div>
        <br>
        <span class="description">Alle felter med * må fylles ut.</span>

        <label>Fornavn:*</label>
        <input type="text" id="fornavn" name="fornavn" value=""/>

        <label>Etternavn:*</label>
        <input type="text" id="etternavn" name="etternavn" value="" placeholder="">

        <label>Firma:</label>
        <input type="text" id="firma" name="firma" placeholder="">

        <label>Adresse:*</label>
        <input type="text" id="adresse" name="adresse">

        <label>Postnr:*</label>
        <input type="text" id="postnr" name="postnr">

        <label>By:*</label>
        <input type="text" id="by" name="by">

        <label>Mobil:*</label>
        <input type="text" id="mobil" name="mobil">

        <label>E-post:*</label>
        <input type="text" id="mailkunde" name="mailkunde">

        <label>Ordrenummer:*</label>
        <input type="text" id="ordrenummer" name="ordrenummer" placeholder="">
        <br>Hvis du ikke har ordrenummert, kontakt vennligst selger / utbygger<br>

        <label>Kundenummer:</label>
        <input type="text" style="font-size: 1em;" id="kundenummer" name="kundenummer" placeholder="skriv inn kundenummert her - Finnes på din ordre">

        <label>Leilighetsnummer:</label>
        <input type="text" style="font-size: 1em;" id="leilnummer" name="leilnummer" placeholder="skriv inn leilighetsnummer her..">

        <label>Hvor er kjøkkenet/bad/garderobe kjøpt:*</label>
        <select id="butikk" name="butikk">
          <option value="" selected="selected"> -- Velg butikk -- </option>
          <option value="HTH Alnabru">HTH Kjøkkenforum Sandefjord - Privat</option>
          <option value="HTH Drammen">HTH Kjøkkenforum Sandefjord - Prosjekt</option>
          <option value="HTH Oslo">HTH Kjøkkenforum Sandefjord - GDS</option>
        </select>

        <label>Beskrivelse av problemet:*</label>
        <textarea type="text"style="font-size: 1.1em;" id="beskrivelse" name="beskrivelse" placeholder="Gjelder ikke for hvitevare produkter - Skal registreres på egen link - Se forsiden"></textarea>

        <label for="uploaded_file">Vedlegg bilder:</label>
        <input type="file" name="file1"><br>
        <input type="file" name="file2"><br>
        <input type="file" name="file3"><br>
        <input type="file" name="file4"><br>
        <input type="file" name="file5"><br>

        <label>Kjøp registrert i et annet navn/firma:</label>
        <input type="text" style="font-size: 0.9em;" id="annenkjop" name="annenkjop" placeholder="Skriv her hvis kjøptet er registrert på en anenn enn deg selv..">
        <br>Skriv "vet ikke" hvis du ikke husker<br>

        <label>Leveringsdato-/Overtakelsesdato:*</label>
        <input type="text" id="leveringsdato" name="leveringsdato">
        <br>
        Eks: 01.01.2019<br>
        <br>
        <br>
        <label>Godkjenn</label>
        <input type="checkbox" id="godkjenn" name="godkjenn" onchange="apply()">
        <div class="tekstgodkjenn" >Jeg godtar at mine personopplysninger kan lagres og brukes i forbindelse med denne servicebestilling <a href="https://hthservice.no/privacypolicy.php" target="_blank"> Les mer her</a></div>
        <div class="tekstgodkjenn" >(Hvis du ikke ønsker og godta dette kan du dessverre ikke bestille service via dette nettstedet. Kontakt da din selger)</div>
        <input name="submit" type="submit" value="send inn">
        <input type="reset" id="reset" value="Slett alt">
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

      </form>
    </div>
  </section>
</main>
<?php require 'inc/footer.php' ?>
