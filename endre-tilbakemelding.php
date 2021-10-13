<?php
session_start();
$currentpage = basename($_SERVER['PHP_SELF']);
$currentpage = strtolower($currentpage);

if (isset($_SESSION['brukernavn']) {
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
<link rel="stylesheet" href="styles/administrer-montor.css">
<main>
  <!-- Call To Action -->
  <section id="tilbakemelding-wrapper">
    <div class="back-btn-wrapper">
    	<a class="back-button" href="administrasjon.php"><img src="img/icons/arrow-left.svg">Gå tilbake</a>
    </div>
    <?php
    // Error meldinger
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "none") {
        echo '<script language="javascript">';
        echo 'alert("Tilbakemelding endret!")';
        echo '</script>';
      } else if($_GET["error"] == "stmt") {
        echo '<script language="javascript">';
        echo 'alert("noe gikk galt!")';
        echo '</script>';
      }
    }
    ?>
    <h1>Endre Tilbakemelding</h1>
    <p style="text-align:center;">br knaggene skaper linjeskift i e-posten</p>
    <form id="tilbakemelding-skjema" method="post" action="inc/endre-tilbakemelding.inc.php">
      <textarea id="tilbakemelding" name="tilbakemelding" rows="14" cols="80"></textarea>
      <input type="reset" name="submit" value="Slett endringer">
      <input type="submit" name="submit" value="Endre">
    </form>

  </section>
</main>
<script>
function showAllOrders() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "inc/fetch-tilbakemelding.inc.php", true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tilbakemelding").innerHTML = this.responseText;
        }
    };
    xmlhttp.send();
}
window.onload = () => {
    showAllOrders();
};
</script>
<?php require 'inc/footer.php' ?>
