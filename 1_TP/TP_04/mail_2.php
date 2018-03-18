<?php
/**
 * Created by PhpStorm.
 * User: eminjan
 * Date: 3/6/2018
 * Time: 7:00 AM
 */
$to = 'e.obulkasim@students.ephec.be';
$sujet = 'Ceci est un mail de test html';
$entete = "From:HE201365@students.ephec.be \r\n";

//ici on défini le format, soit html
$entete .= "Content-Type: text/html; charset=utf-8\r\n";

$message = "<b>Bonjour,<br> Ceci est un envoi de mail test</b>
				<a href=\"https://193.190.65.92/HE201365/2_SITEX/phase_01.02/index.php\" rel=\"prev\">Phase_01</a>";

mail($to, $sujet, $message, $entete);
