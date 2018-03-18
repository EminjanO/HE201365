<?php
/**
 * Created by PhpStorm.
 * User: eminjan
 * Date: 3/6/2018
 * Time: 6:31 AM
 */
//1st Part 1
//mail('emindilbar@gmail.com','sujet','message','From:HE201365@students.ephec.be');
//1st Part 2
$to = 'e.obulkasim@students.ephec.be';
$sujet = 'Bonjour, ceci est un envoi de mail test';
$message = "<p>Bonjour,</p>
            <p>Voici mon mail « structuré ».</p>            
            <p>BàT.man</p>";
$entete = "From:HE201365@students.ephec.be \r\n";

//ici on défini le format, soit html
$entete .= "Content-Type: text/html; charset=utf-8\r\n";
mail($to, $sujet, $message, $entete);