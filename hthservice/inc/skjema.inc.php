<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

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
  if ($recaptcha->score >= 0.5) {

    //phpmailer variabler
    $smtpUsername = "danielcravndal@gmail.com";
    $smtpPassword = "hthservice2021";
    $emailFrom = "danielcravndal@gmail.com";
    $emailFromName  = "HTH Service";
    $emailTo = $_POST["mailkunde"];

    //hent verdier fra skjemaet
    $fornavn = $_POST["fornavn"];
    $etternavn = $_POST["etternavn"];
    $firma = $_POST["firma"];
    $adresse = $_POST["adresse"];
    $postnr = $_POST["postnr"];
    $by = $_POST["by"];
    $mobil = $_POST["mobil"];
    $butikk = $_POST["butikk"];
    $beskrivelse = $_POST["beskrivelse"];
    $file1 = $_POST["file1"] ?? '';
    $file2 = $_POST["file2"] ?? '';
    $file3 = $_POST["file3"] ?? '';
    $file4 = $_POST["file4"] ?? '';
    $file5 = $_POST["file5"] ?? '';
    $kundenummer = $_POST["kundenummer"];
    $ordrenummer = $_POST["ordrenummer"];
    $leilnummer = $_POST["leilnummer"];
    $annenkjop = $_POST["annenkjop"];
    $leveringsdato = $_POST["leveringsdato"];
    $godkjenn = $_POST["godkjenn"];

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

    // valider skjemaet
    if (emptyForm($fornavn, $etternavn, $adresse, $postnr, $by, $mobil, $emailTo, $butikk, $beskrivelse, $ordrenummer, $leveringsdato) !== false) {
      header("location: ../skjema.php?error=emptyinput");
      exit();
    }
    if (invalidName($fornavn, $etternavn) !== false) {
      header("location: ../skjema.php?error=invalidname");
      exit();
    }
    if (invalidEmail($emailTo) !== false) {
      header("location: ../skjema.php?error=invalidemail");
      exit();
    }

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );
    $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
    $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
    $mail->Port = 587; // TLS only
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // ssl is depracated
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUsername;
    $mail->Password = $smtpPassword;
    $mail->setFrom($emailFrom, $emailFromName);
    $mail->addAddress($emailFrom);
    $mail->Subject = 'HTH Servicebestilling';
    $mail->msgHTML("Fornavn: " . $fornavn . "<br>Etternavn: " . $etternavn . "<br>Firma: "
    . $firma . "<br>Adresse: " . $adresse . "<br>Post nr: " . $postnr . "<br>By: " . $by . "<br>Telefon: "
    . $mobil . "<br>Butikk: " . $butikk . "<br>Beskrivelse: " . $beskrivelse . "<br>Kundenummer: "
    . $kundenummer . "<br>Ordrenr: " . $ordrenummer . "<br>Leilighetsnummer: "
    . $leilnummer . "<br>Registrert på annen: " . $annenkjop . "<br>Leveringsdato: " . $leveringsdato); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
    $mail->AltBody = 'HTML messaging not supported';
    $mail->addAttachment($file1, $file1_navn); //Attach an image file
    $mail->addAttachment($file2, $file2_navn);
    $mail->addAttachment($file3, $file3_navn);
    $mail->addAttachment($file4, $file4_navn);
    $mail->addAttachment($file5, $file5_navn);

    if(!$mail->send()){
      echo "Mailer Error: " . $mail->ErrorInfo;
    } else{
      header("location: ../skjema.php");
    }
  } else {
    header("location: ../skjema.php?error=stmtfailed");
  }
} else {
  header("location: ../skjema.php?error=stmtfailed");
  exit();
}
?>
