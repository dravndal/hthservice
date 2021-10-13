<?php session_start(); require 'inc/header.php';?>
<link rel="stylesheet" href="styles/hjem.css">

<main>
  <!-- Call To Action -->
  <section id="cta">
    <h1 class="cta-heading" style="font-size: 3rem;"> HTH service Vestfold</h1>
    <hr style="margin-bottom: 60px;">
    <h1 class="cta-heading"> Kjøkken, bad og garderober</h1>
    <p class="cta-paragraph">På denne siden kan du reklamere eller sende en garantiforespørsel på dine produkter levert og produsert av HTH Køkkener.</p>
    <h1 class="cta-heading"> Hvitevarer</h1>
    <p class="cta-paragraph">Hvis det gjelder reparasjon av hvitevarer du har tatt i bruk skal
      hvitevareleverandøren kontaktes. Norske Elektroleverandørers Landsforening
      (NEL) har på vegne av sine medlemsbedrifter og deres tilknyttede
      servicepartnere landet rundt opprettet en felles portal for online bestilling
      av servicetjenester for hvitevarer fra en rekke ulike leverandører. Linken finner du <a style="text-decoration: underline;"href="https://nelreg.logiq.no/prereg/Prereg">her</a> </p>
      <h1 class="cta-heading">Garantier</h1>
      <div class="warrantyButtons">
        <button class="cta-btn"type="button" id="2year" name="2year">2 år</button>
        <button class="cta-btn"type="button" id="5year" name="5year">5 år</button>
        <button class="cta-btn"type="button" id="25year" name="25year">25 år</button>
      </div>
      <div id="warrantyModal" class="modal">
        <div class="warranty-content">
          <span class="close">&times;</span>
          <p id="modal-body">test</p>
        </div>
      </div>
    </section>
  </main>
  <?php require 'inc/footer.php' ?>
  <script type="text/javascript">

  if (window.document.documentMode) {
    alert("Denne nettsiden støtter ikke Internet Explorer, vennligst benytt en annen nettleser f.eks Google Chrome eller Mozilla Firefox!");
  }

  // Get the modal
  var modal = document.getElementById("warrantyModal");

  // Get the button that opens the modal
  var twentyFive = document.getElementById("25year");
  var five = document.getElementById("5year");
  var two = document.getElementById("2year");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on the button, open the modal
  twentyFive.onclick = function() {
    modal.style.display = "block";
    document.getElementById("modal-body").innerHTML = "<h1 style='text-align: center;'>25 års garanti</h1><p> Det skjer noe på kjøkkenet hver eneste dag. Skapdørene åpnes og lukkes utallige ganger. Skuffene trekkes ut og skyves inn igjen, gang på gang. Det kreves kvalitetsmateriale og -deler for å sikre at alt går glatt og knirkefritt år etter år. Vi gir derfor 25 års garanti på skuffesider og skinner, hengsler og trådvarer samt tilhørende skinner og metallbeslag. Garantien omfatter ikke avfallssystemer, hvitevarer, gassdempere, blandebatterier og elektriske enheter.";
  }
  five.onclick = function() {
    modal.style.display = "block";
    document.getElementById("modal-body").innerHTML = "<h1 style='text-align:center;'>5 års garanti</h1><p>Vi gir deg fem års garanti på kjøkkenet, badet og garderoben. Skap, benkeplater, vasker, blandebatterier (garanti mot drypp), håndtak, soft-push, LED-belysning og spotter for innbygning dekkes av garantien.";
  }
  two.onclick = function() {
    modal.style.display = "block";
    document.getElementById("modal-body").innerHTML = "<h1 style='text-align:center;'>2 års garanti</h1><p>Du får to års garanti på de øvrige delene til badet, garderoben og kjøkkenet, for eksempel harde hvitevarer og fritthengende lamper. Rettighetene du har som forbruker i henhold til Kjøpsloven blir på ingen måte begrenset.";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>
