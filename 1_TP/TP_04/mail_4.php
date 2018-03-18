<?php
/**
 * Created by PhpStorm.
 * User: eminjan
 * Date: 3/6/2018
 * Time: 7:32 AM
 */
if (isset($_POST['envoyer'])) {
    $from = $_POST['from'];
    $destinataire = 'HE201365@students.ephec.be';

    /*if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $from))  // filtrer les serveurs  ou  utilise \n
    {
        $passage_ligne = "\r\n";
    }
    else
    {
        $passage_ligne = "\n";
    }*/
    $passage_ligne = (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $from))? "\r\n" : "\n";
    $sujet = $_POST['sujet'];

    $message = htmlentities($_POST['message']);
    $message .= '<br><a href="https://193.190.65.92/HE201365/1_TP/TP_04/form_contact.html">Contact</a>';


    function headerInfo($f, $passage_ligne){
        $entete = 'MIME-Version: 1.0' . $passage_ligne; // Version MIME
        $entete .= 'Content-type: text/html; charset=ISO-8859-1' .$passage_ligne; // l'en-tete Content-type pour le format HTML
        $entete .= "From:" . $f;
        return $entete;
    }

    if (mail($destinataire, $sujet, $message, headerInfo($from, $passage_ligne)))
    {
        $to = $from;
        $sujetRetour = 'Comfirmation de votre prise de contact';
        $messageRetour = "<p>Extéditeur : $from</p><p>sujet : $sujet</p><p>Contenu : $message</p>";
        mail($to,$sujetRetour,$messageRetour,headerInfo($destinataire,$passage_ligne));

        echo 'Votre message a bien été envoyé ';
    } else {
        echo ' Vous pensez que votre message a bien été envoyé ? NON !';
    };
}