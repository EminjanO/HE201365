<?php
/**
 * Created by PhpStorm.
 * User: eminjan
 * Date: 4/11/2018
 * Time: 7:38 AM
 */
include 'kint/kint.inc.php';
$_GET['group']=15;
include '../../2_SITEX/phase_03.05.lastTry/INC/request.inc.php';
$fromSelected = isset($_POST['formSelect']) ? $_POST['formSelect']:'';

//kint::dump($GLOBALS);
kint::dump($_GET,allGroup(),listeCours('1TL2'));
//d($_GET);