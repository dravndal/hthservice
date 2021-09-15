<?php
session_start();
$currentpage = basename($_SERVER['PHP_SELF']);
$currentpage = strtolower($currentpage);
$isLoggedIn = isset($_SESSION['brukernavn']); // Sjekker om sesjonsvariabelet userId finnes. Om det gjør det vet vi at brukeren er logget inn

if ($isLoggedIn) {
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
} else{
  header("Location: https://www.hthservice.no/admin.php");
}
require 'inc/header.php';
?>
<link rel="stylesheet" href="styles/administrer-bestillinger.css">
<main>
  <!-- Call To Action -->
  <section id="montor-list">
    <div class="back-btn-wrapper">
    	<a class="back-button" href="administrasjon.php"><img src="img/icons/arrow-left.svg">Gå tilbake</a>
    </div>
    <h1>Administrer Bestillinger</h1>
    <label class="searchbar">
        <input class="searchbar-input" type="text" placeholder="Søk etter referansenummer eller status" onkeyup="showOrder(this.value)">
    </label>
    <div id="order-table-container">
        <?php

        ?>
    </div>
  </section>
  <a class="back-to-top-link" href="#top">Tilbake til toppen</a>
</main>
<script>
function showOrder(str) {
    if (str.length == 0) {
        showAllOrders();
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "inc/fetch-orders.php?q=" + str, true);
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("order-table-container").innerHTML = this.responseText;
            }
        };
        xmlhttp.send();
    }
}
function showAllOrders() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "inc/fetch-all-orders.inc.php", true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("order-table-container").innerHTML = this.responseText;
        }
    };
    xmlhttp.send();
}
window.onload = () => {
    showAllOrders();
};
function updateStatus(status) {
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "inc/update-status.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(`status=${status}`);
}
function deleteOrder(kode) {
    if (confirm("Er du sikker på at du vil slette " + kode + "?")) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "inc/delete-order-admin.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.readyState == 4 && this.status == 200) {
                let button = document.querySelector("button[value='"+kode+"']");
                if (button) {
                    if (button.parentElement.parentElement.parentElement.childElementCount === 2) {
                        button.parentElement.parentElement.parentElement.parentElement.parentElement.innerHTML = "<span class='not-found'>Ingen bruker funnet.</span>";
                    } else {
                        button.parentElement.parentElement.remove();
                    }
                }
            }
            }
        };
        xmlhttp.send(`kode=${kode}`);
    }
}
</script>
<?php require 'inc/footer.php' ?>
