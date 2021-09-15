<?php
require_once '../models/servicebestilling.php';
session_start();
if (isset($_SESSION['brukernavn'])) {
    $orders = getAllOrders();
    if ($orders != false && count($orders) > 0) { // Hvis det er minst 1 verdi i arrayet
        $userTable = "<table id='user-table'>"; // Opprett først en tabell med id "uesr-table"
        $userTable .= "<tr><th>Fornavn</th><th>Etternavn</th><th>Ordrenummer</th><th>Referansenummer</th><th>Status</th><th>Slett</th></tr>"; // Append table headers
        $orderTypes = array(1 => 'Ubehandlet', 2 => 'Godkjent: Varer Bestilt', 3 => 'Godkjent: Ferdig', 4 => 'Avvist');
        /* For hver bruker, lag en table row med data om brukeren */
        foreach ($orders as $order) {
            $userTable .= "<tr><td>".$order['fornavn']."</td><td>".$order['etternavn']."</td><td>".$order['ordrenummer']."</td><td><a style='text-decoration: underline;' href='change-order.php?ticket=".$order['ticket']."'>".$order['ticket']."</a></td><td><select onchange='updateStatus(this.value)'>";?><?php foreach($orderTypes as $key => $value) {$userTable .= "<option value='".$value.",".$order['ticket']."'";?><?php if ($order['status'] == $value) {$userTable .= "selected";}?><?php $userTable .= ">".$value."</option>";} ?><?php $userTable .= "</select></td><td><button class='delete-button' onclick='deleteOrder(this.value)' value='".$order['ticket']."'>Slett</button></td></tr>";
        }
        $userTable .= "</table>"; // Avslutt tabellen
        echo $userTable; // Vis tabellen
    } else {
        echo '<span class="not-found">Ingen brukere funnet.</span>';

    }
}
