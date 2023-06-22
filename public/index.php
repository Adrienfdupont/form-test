<?php

if ($_POST) {
  $data = [
    "company" => $_POST["company"],
    "lastname" => $_POST["lastname"],
    "firstname" => $_POST["firstname"],
    "occupation" => $_POST["occupation"],
    "phone" => $_POST["phone"],
    "email" => $_POST["email"],
    "reason" => $_POST["reason"],
    "description" => $_POST["description"],
  ];
  
  // verify that all needed data is set and not empty
  $readyToSend = true;
  foreach ($data as $key => $value) {
    // occupation field is nullable
    if ($key != "occupation" && (!isset($value) || empty($value))) {
      $readyToSend = false;
    }
  }
  
  if ($readyToSend) {
    // retrieve sensible data
    $env = parse_ini_file('../.env');
  
    $subject = "Test technique pour Akabia";
    $message = "Ceci est un message de test";
  
    $headers = "Content-Type: text/plain; charset=utf-8\r\n";
    $headers .= "From: " . $env["EMAIL_SENDER"] . "\r\n";
  
    if (mail($env["EMAIL_RECIPIENT"], $subject, $message, $headers)){
      $emailSuccess = "Le mail a bien été envoyé à " . $env["EMAIL_RECIPIENT"];
    } else {
      echo 'erreur';
      $emailError = "Une erreur est survenue lors de l'envoi du mail.";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulaire</title>
    <link rel="stylesheet" href="./style.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
    />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="./index.js" defer></script>
  </head>
  <body>
    <main id="main-container">
      <div id="header">
        <span class="material-icons">phone</span>
        <span>03 28 76 55 90</span>
      </div>

      <div id="title">
        <span class="material-icons">mail_outline</span>
        <span>Un besoin, une demande ?</span>
      </div>

      <form method="POST" id="form">
        <input
          type="text"
          name="company"
          id="company"
          placeholder="Entreprise *"
          required
        />

        <input
          type="text"
          name="lastname"
          id="lastname"
          placeholder="Nom *"
          required
        />

        <input
          type="text"
          name="firstname"
          id="firstname"
          placeholder="Prénom *"
          required
        />

        <input
          type="text"
          name="occupation"
          id="occupation"
          placeholder="Fonction"
        />

        <input
          type="tel"
          name="phone"
          id="phone"
          placeholder="Tél. *"
          required
        />

        <input
          type="email"
          name="email"
          id="email"
          placeholder="Mail *"
          required
        />

        <div class="label-group">
          <div>
            <label for="reason">Votre demande concerne *</label>
          </div>

          <div>
            <select name="reason" id="reason" required>
              <option disabled selected value></option>
              <option value="option1">option 1</option>
              <option value="option2">option 2</option>
              <option value="option3">option 3</option>
            </select>
          </div>
        </div>

        <div class="label-group">
          <div>
            <label for="description-area"
              >Votre besoin (objectfs/date/lieu) *</label
            >
          </div>

          <div>
            <textarea
              name="description"
              id="description"
              rows="5"
              required
            ></textarea>
          </div>
        </div>

        <div id="error-msg" class="<?php isset($emailSuccess) && $emailSuccess ? "success" : "error" ?>">
          <?php isset($emailSuccess) && $emailSuccess ? $emailSuccess : "" ?>
          <?php isset($emailError) && $emailError ? $emailError : "" ?>
        </div>

        <div>
          <input type="submit" value="GO !" />
        </div>
      </form>
    </main>
  </body>
</html>
