<?php
/**
 * Created by PhpStorm.
 * User: eminjan
 * Date: 4/11/2018
 * Time: 7:38 AM
 */
include 'kint/kint.inc.php';
kint::trace();
$_GET['rq']='listeCours';
$_GET['groupe']= 5;
kint::trace($_GET);
include '../../2_SITEX/phase_03.05.lastTry/INC/request.inc.php';
kint::trace(listeCours('1TL2'));