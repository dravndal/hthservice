<?php
require_once 'models/servicebestilling.php';
session_start();
$currentpage = basename($_SERVER['PHP_SELF']);
$currentpage = strtolower($currentpage);

if (isset($_SESSION['brukernavn'])) {
  if (isset($_SESSION['lastActivity']) && (time() - $_SESSION['lastActivity'] > 1800)) {
    // Logger bruker ut om det er mer enn en halvtime siden siste aktivitet
    session_start();
    session_unset();
    session_destroy();
    header("location: admin.php?status=sessionexpired"); // Sett query string-en status til sessionexpired så vi kan gjøre noe på logg-inn.php når script-et mottar get-variabelet
    exit();
  }
  $brukernavn = $_SESSION['brukernavn']; // ubrukelig?
  $_SESSION['lastActivity'] = time();

  $ticket = $_GET['ticket'];
  $order = getOrder($ticket);

  $fornavn = $order[0]["fornavn"];
  $etternavn = $order[0]["etternavn"];
  $firma = $order[0]["firma"];
  $adresse = $order[0]["adresse"];
  $postnr = $order[0]["postnr"];
  $city = $order[0]["city"];
  $mobil = $order[0]["mobil"];
  $epost = $order[0]["epost"];
  $ordrenummer = $order[0]["ordrenummer"];
  $kundenummer = $order[0]["kundenummer"];
  $leilighetsnummer = $order[0]["leilighetsnummer"];
  $butikk = $order[0]["butikk"];
  $beskrivelse = $order[0]["beskrivelse"];
  $annet = $order[0]["annet"];
  $leveringsdato = $order[0]["leveringsdato"];
  $status = $order[0]["status"];

} else {
  header("Location: https://www.hthservice.no/admin.php");
}
require 'inc/header.php';
?>
<link rel="stylesheet" href="styles/change-order.css">
<main>
  <section id="wrapper">
    <div class="back-btn-wrapper">
      <a class="back-button" href="administrer-bestillinger.php"><img src="img/icons/arrow-left.svg">Gå tilbake</a>
    </div>
      <form method="post" form="" name="bestilling" id="bestilling" action="inc/endre-ordre.inc.php" charset="utf-8" enctype="multipart/form-data">
        <h1>Endre Servicebestilling</h1>
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
        <div class="formwrapper">
        <div class="input-left">
          <label id="fornavn-label">Fornavn:</label>
          <input type="text" id="fornavn" name="fornavn" value="<?php echo $fornavn ?>" autofocus="autofocus"   required/>

          <label id="etternavn-label">Etternavn:</label>
          <input type="text" id="etternavn" name="etternavn" value="<?php echo $etternavn ?>" placeholder=""   required/>

          <label id="adresse-label">Adresse:</label>
          <input type="text" id="adresse" name="adresse" value="<?php echo $adresse ?>"   required/>

          <label id="post-label">Postnr:</label>
          <input type="text" id="postnr" name="postnr" value="<?php echo $postnr ?>"   required/>

          <label id="by-label">By:</label>
          <input type="text" id="by" name="by" value="<?php echo $city ?>"   required/>

          <label id="mobil-label">Mobil:</label>
          <input type="text" id="mobil" name="mobil" value="<?php echo $mobil ?>" required/>

        </div>
        <div class="input-right">

          <label id="epost-label">E-post:</label>
          <input type="email" id="mailkunde" name="epost" value="<?php echo $epost ?>" required/>

          <label id="ordrenummer-label">Ordrenummer:</label>
          <input pattern="[0-9]{8}" type="text" id="ordrenummer" value="<?php echo $ordrenummer ?>" name="ordrenummer"  />

          <label id="kundenummer-label">Kundenummer:</label>
          <input type="text" style="font-size: 1em;" id="kundenummer" value="<?php echo $kundenummer ?>" name="kundenummer"  />

          <label id="leilighetsnummer-label">Leilighetsnummer:</label>
          <input type="text" style="font-size: 1em;" id="leilnummer" value="<?php echo $leilighetsnummer ?>" name="leilnummer" />

          <label id="annet-label">Kjøp registrert i et annet navn/firma:</label>
          <input type="text" style="font-size: 0.9em;" id="annenkjop" name="annenkjop"  value="<?php echo $annet ?>"/>

          <label id="leveringLabel">Leverings-/Overtakelsesdato:</label>
          <input type="text" id="leveringsdato" name="leveringsdato"  value="<?php echo $leveringsdato ?>"  required/>

        </div>
        <div class="input-right-right">
          <label>Hvor er kjøkkenet/bad/garderobe kjøpt:</label>
          <br>
          <select id="butikk" name="butikk" required>
            <option value="<?php echo $butikk ?>" selected="selected"><?php echo $butikk ?></option>
            <option value="HTH Sandefjord - Privat">HTH Kjøkkenforum Sandefjord - Privat</option>
            <option value="HTH Sandefjord - Prosjekt">HTH Kjøkkenforum Sandefjord - Prosjekt</option>
            <option value="HTH Sandefjord - GDS">HTH Kjøkkenforum Sandefjord - GDS</option>
          </select>

          <label id="beskrivelse-label">Beskrivelse av problemet: <img id="kommentar-ikon" src="img/icons/info-circle-solid.svg" alt="" style="width: 1em; height: 1em;"></label>
          <div id="commentModal" class="modal">
            <div class="comment-wrapper">
              <span class="close">&times;</span>
              <textarea class="comment-content" name="comments" id="comments" style="resize: none;"></textarea>
            </div>
          </div>
          <textarea type="text" style="font-size: 1.1em;" id="beskrivelse" name="beskrivelse" required><?php echo $beskrivelse ?></textarea>
          <label id="firma-label">Firma:</label>
          <input type="text" id="firma" name="firma" value="<?php echo $firma ?>" placeholder="">
          <br><br>
          <input type="reset" id="reset" value="Fjern Endringer">
          <input type="submit" name="submit" value="Endre">
        </div>
      </div>
      <input type="hidden" id="ticket" name="ticket" value="<?php echo $ticket ?>"/>
      </form>
  </section>
</main>
<script>

  var comment = document.getElementById("commentModal");
  var ikon = document.getElementById("kommentar-ikon");
  var ticket = document.getElementById("ticket").value;

  ikon.onclick = function() {
      comment.style.display = "block";
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.open("GET", "inc/fetch-comments.inc.php?q=" + ticket, true);
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              document.getElementById("comments").innerHTML = this.responseText;
          }
      };
      xmlhttp.send();
  }

  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    comment.style.display = "none";
    var status = [ticket, document.getElementById("comments").value];
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "inc/update-comments.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(`status=${status}`);
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == comment) {
      comment.style.display = "none";
      var status = [ticket, document.getElementById("comments").value];
      var xmlhttp = new XMLHttpRequest();
          xmlhttp.open("POST", "inc/update-comments.php", true);
          xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xmlhttp.send(`status=${status}`);
    }
  }
</script>
<?php require 'inc/footer.php' ?>
