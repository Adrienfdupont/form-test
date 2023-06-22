<?php

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
$subject = "Test technique pour Akabia";
$message = "";
foreach ($data as $key => $value) {
    // occupation field is nullable
    if ($key != "occupation" && (!isset($value) || empty($value))) {
        $readyToSend = false;
    } else {
        $message .= "$key : $value\r\n";
    }
}

if ($readyToSend) {
    // retrieve sensible data
    $env = parse_ini_file("../.env");

    $headers = "Content-Type: text/plain; charset=utf-8\r\n";
    $headers .= "From: " . $env["EMAIL_SENDER"] . "\r\n";
    
    if (mail($env["EMAIL_RECIPIENT"], $subject, $message, $headers)){
        $success = "Le mail a bien été envoyé à " . $env["EMAIL_RECIPIENT"];
        header("Location: /?success=" . urlencode($success));
    } else {
        echo "erreur";
        $error = "Une erreur est survenue lors de l'envoi du mail.";
        header("Location: /?error=" . urlencode($error));
    }

}