<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

require_once __DIR__.'/../models/servicebestilling.php';
require_once 'validation.inc.php'; // henter valideringsfunksjoner

if(isset($_POST["submit"]) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])){

  // Build POST request:
  $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
  $recaptcha_secret = '6Ld_OvAaAAAAAM34LqO3jITtO0hnkO7sfePD_l5Q';
  $recaptcha_response = $_POST['recaptcha_response'];

  // Make and decode POST request:
  $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
  $recaptcha = json_decode($recaptcha);

  // Take action based on the score returned:
  if ($recaptcha->score >= 0) {

    //phpmailer variabler
    $emailFrom = "service@hthservice.no";
    $emailFromName  = "HTH Service";
    $emailTo = $_POST["mailkunde"];

    //hent verdier fra skjemaet
    $fornavn = $_POST["fornavn"] ?? '';
    $etternavn = $_POST["etternavn"] ?? '';
    $firma = $_POST["firma"] ?? '';
    $adresse = $_POST["adresse"] ?? '';
    $postnr = $_POST["postnr"] ?? '';
    $by = $_POST["by"] ?? '';
    $mobil = $_POST["mobil"] ?? '';
    $butikk = $_POST["butikk"] ?? '';
    $beskrivelse = $_POST["beskrivelse"] ?? '';
    $file1 = $_POST["file1"] ?? '';
    $file2 = $_POST["file2"] ?? '';
    $file3 = $_POST["file3"] ?? '';
    $file4 = $_POST["file4"] ?? '';
    $file5 = $_POST["file5"] ?? '';
    $kundenummer = $_POST["kundenummer"] ?? '';
    $ordrenummer = $_POST["ordrenummer"] ?? '';
    $leilnummer = $_POST["leilnummer"] ?? '';
    $annenkjop = $_POST["annenkjop"] ?? '';
    $leveringsdato = $_POST["leveringsdato"] ?? '';
    $number = substr($mobil, 0, 2) + mt_rand(1000, 9999);
    $ticket = createTicket($fornavn, $etternavn, $mobil);

    // Vedlegg
    $file1 = $_FILES['file1']['tmp_name'];
    $file1_navn = $_FILES['file1']['name'];
    $file2 = $_FILES['file2']['tmp_name'];
    $file2_navn = $_FILES['file2']['name'];
    $file3 = $_FILES['file3']['tmp_name'];
    $file3_navn = $_FILES['file3']['name'];
    $file4 = $_FILES['file4']['tmp_name'];
    $file4_navn = $_FILES['file4']['name'];
    $file5 = $_FILES['file5']['tmp_name'];
    $file5_navn = $_FILES['file5']['name'];

    // tilbakemelding
    $tilbakemelding = getTilbakemelding();

    // valider skjemaet
    if (emptyForm(sanitizeInput($fornavn), sanitizeInput($etternavn), sanitizeInput($adresse), $file1, sanitizeInput($postnr),
    sanitizeInput($by), sanitizeInput($mobil), sanitizeInput($emailTo), sanitizeInput($butikk), sanitizeInput($beskrivelse), sanitizeInput($leveringsdato)) !== false) {
      header("location: ../skjema.php?error=emptyinput");
      exit();
    }
    if (invalidName(sanitizeInput($fornavn), sanitizeInput($etternavn)) !== false) {
      header("location: ../skjema.php?error=invalidname");
      exit();
    }
    if (invalidEmail(sanitizeInput($emailTo)) !== false) {
      header("location: ../skjema.php?error=invalidemail");
      exit();
    }
    if (invalidPost(sanitizeInput($postnr)) !== false){
      header("location: ../skjema.php?error=invalidpost");
      exit();
    }
    if (invalidPhone(sanitizeInput($mobil)) !== false){
      header("location: ../skjema.php?error=invalidphone");
      exit();
    }

    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->setFrom($emailFrom, $emailFromName);
    $mail->addAddress($emailFrom);
    $mail->Subject = 'HTH Servicebestilling: ' . $ticket;
    $mail->msgHTML("Det har kommet inn en ny servicebestilling fra: " . $emailTo . "<br><table style='border: 1px solid black; width: 40%;'> <tr><th style='border: 1px solid black;'>Fornavn:</th><td style='border: 1px solid black;'> "
    . $fornavn . "</td></tr><tr><th style='border: 1px solid black;'>Etternavn:</th><td style='border: 1px solid black;'> "
    . $etternavn . "</td></tr><tr><th style='border: 1px solid black;'>Firma:</th><td style='border: 1px solid black;'> "
    . $firma . "</td></tr><tr><th style='border: 1px solid black;'>Adresse:</th><td style='border: 1px solid black;'> "
    . $adresse . "</td></tr><tr><th style='border: 1px solid black;'>Post nr:</th><td style='border: 1px solid black;'> "
    . $postnr . "</td></tr><tr><th style='border: 1px solid black;'>By:</th><td style='border: 1px solid black;'> "
    . $by . "</td></tr><tr><th style='border: 1px solid black;'>Telefon:</th><td style='border: 1px solid black;'>"
    . $mobil . "</td></tr><tr><th style='border: 1px solid black;'>Butikk:</th><td style='border: 1px solid black;'> "
    . $butikk . "</td></tr><tr><th style='border: 1px solid black;'>Beskrivelse:</th><td style='border: 1px solid black;'> "
    . $beskrivelse . "</td></tr><tr><th style='border: 1px solid black;'>Kundenummer:</th><td style='border: 1px solid black;'> "
    . $kundenummer . "</td></tr><tr><th style='border: 1px solid black;'>Ordrenr:</th><td style='border: 1px solid black;'> "
    . $ordrenummer . "</td></tr><tr><th style='border: 1px solid black;'>Leilighetsnummer:</th><td style='border: 1px solid black;'> "
    . $leilnummer . "</td></tr><tr><th style='border: 1px solid black;'>Registrert på annen:</th><td style='border: 1px solid black;'> "
    . $annenkjop . "</td></tr><tr><th style='border: 1px solid black;'>Leveringsdato:</th><td style='border: 1px solid black;'> "
    . $leveringsdato . "</td></tr></table>");
    $mail->AltBody = 'HTML messaging not supported';
    $mail->addAttachment($file1, $file1_navn); //Attach an image file
    $mail->addAttachment($file2, $file2_navn);
    $mail->addAttachment($file3, $file3_navn);
    $mail->addAttachment($file4, $file4_navn);
    $mail->addAttachment($file5, $file5_navn);

    if(!$mail->send()){
      echo "Mailer Error: " . $mail->ErrorInfo;
    } else{

      $mailCustomer = new PHPMailer();
      $mail->CharSet = 'UTF-8';
      $mail->Encoding = 'base64';
      $mailCustomer->setFrom($emailFrom, $emailFromName);
      $mailCustomer->addAddress($emailTo);
      $mailCustomer->Subject = 'HTH Servicebestilling';
      $mailCustomer->msgHTML($tilbakemelding . "<br>Referansenummer: " . $ticket);
      $mailCustomer->AltBody = 'HTML messaging not supported';

      if(!$mailCustomer->send()){
        echo "Mailer Error: " . $mailCustomer->ErrorInfo;
      } else{
        addBestilling($fornavn, $etternavn, $firma, $adresse, $postnr, $by, $mobil, $emailTo, $ordrenummer, $kundenummer, $leilnummer, $butikk, $beskrivelse, $annenkjop, $leveringsdato, $ticket);
        header("location: ../skjema.php?error=none");
        echo '<script language="javascript">';
        echo 'alert("Bestilling sendt! Sjekk din e-post for bekreftelse")';
        echo '</script>';
      }
    }
  } else {
    header("location: ../skjema.php?error=captchafailed");
  }
} else {
  header("location: ../skjema.php?error=stmtfailed");
  exit();
}
?>
