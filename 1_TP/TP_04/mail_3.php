<?php
/**
 * Created by PhpStorm.
 * User: eminjan
 * Date: 3/6/2018
 * Time: 7:13 AM
 */
if (isset($_POST['envoyer'])) {
    $destinataire = $_POST['dest'];

    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $destinataire))  // filtrer les serveurs  ou  utilise \n
    {
        $passage_ligne = "\r\n";
    }
    else
    {
        $passage_ligne = "\n";
    }

    $sujet = $_POST['sujet'];

    $message = htmlentities($_POST['message']);

    $entete = 'MIME-Version: 1.0' . $passage_ligne; // Version MIME
    $entete .= 'Content-type: text/html; charset=ISO-8859-1' .$passage_ligne; // l'en-tete Content-type pour le format HTML
    $entete .= "From:$destinataire";

    if (mail($destinataire, $sujet, $message, $entete)) {
        echo 'Votre message a bien été envoyé ';
    } else {
        echo ' Vous pensez que votre message a bien été envoyé ? NON !';
    };
}