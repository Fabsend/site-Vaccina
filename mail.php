<?php

$today = new DateTime();
$aujourdhui = $today->format('Y-m-d');
$covid = "Covid-19";

if (($aujourdhui < $date) && (!preg_match("/$covid\b/", $nom))) {

    $to = $affprofil[0]["email"];
    $subjet = "Notification Vaccin - Vaccina";
    $message = "Bonjour " . $affprofil[0]["prenom"] . " " . $affprofil[0]["nom"] . ", " . "vous aurez votre prochain vaccin" . " (" . $nom . ")" . ", le " . date('d/m/Y', strtotime($date));;
    $headers = "From : vaccina.nfs@gmail.com";


    if (mail($to, $subjet, $message, $headers)) {
        echo 'envoyer !';
    } else
        echo 'erreur';
}

$daterappel = date('Y-m-d', strtotime('+3 month', strtotime($date)));

if ((preg_match("/$covid\b/", $nom)) && ($daterappel > $aujourdhui)) {

    $to = $affprofil[0]["email"];
    $subjet = "Notification Vaccin - Vaccina";
    $message = "Bonjour " . $affprofil[0]["prenom"] . " " . $affprofil[0]["nom"] . ", " . "3 mois après votre dose de " .   $nom  . " du " . date('d/m/Y', strtotime($date)) . ", vous pourrez faire votre dose de rappel à partir du " . date('d/m/Y', strtotime($daterappel));;
    $headers = "From : vaccina.nfs@gmail.com";


    if (mail($to, $subjet, $message, $headers)) {
        echo 'envoyer !';
    } else
        echo 'erreur';
}
