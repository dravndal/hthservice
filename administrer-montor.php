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
<link rel="stylesheet" href="styles/administrer-montor.css">
<main>
  <!-- Call To Action -->
  <section id="montor-list">
    <div class="back-btn-wrapper">
    	<a class="back-button" href="administrasjon.php"><img src="img/icons/arrow-left.svg">Gå tilbake</a>
    </div>
    <h1>Administrer Montører</h1>
    <label class="searchbar">
        <input class="searchbar-input" type="text" placeholder="Søk etter e-post" onkeyup="showUsers(this.value)">
    </label>
    <div id="montor-table-container">
        <?php

        ?>
    </div>
  </section>
  <a class="back-to-top-link" href="#top">Tilbake til toppen</a>
</main>
<script>
function showUsers(str) {
    if (str.length == 0) {
        showAllUsers();
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "inc/fetch-users.php?q=" + str, true);
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("montor-table-container").innerHTML = this.responseText;
            }
        };
        xmlhttp.send();
    }
}
function showAllUsers() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "inc/fetch-all-users.inc.php", true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("montor-table-container").innerHTML = this.responseText;
        }
    };
    xmlhttp.send();
}
window.onload = () => {
    showAllUsers();
};
// function updateUserType(value) {
//     var xmlhttp = new XMLHttpRequest();
//         xmlhttp.open("POST", "inc/update-user-type.php", true);
//         xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//         xmlhttp.send(`value=${value}`);
// }
function deleteUser(kode) {
    if (confirm("Er du sikker på at du vil slette " + kode + "?")) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "inc/delete-user-admin.php", true);
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
