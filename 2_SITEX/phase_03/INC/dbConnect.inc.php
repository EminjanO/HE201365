<?php  
if ( count( get_included_files() ) == 1) die( '--access denied--' );

define('___MATRICULE___','HE201365');

if(stripos($_SERVER['PHP_SELF'],___MATRICULE___)==FALSE) {
	trigger_error("TENTATIVE DE FRAUDE de {$_SERVER['PHP_SELF']} chez ".___MATRICULE___, E_USER_ERROR);
	exit;
} 
else{
	$__INFOS__ = array(   'matricule'=> ___MATRICULE___
					,'host' => 'localhost'
					,'user' => 'OBULKASIM'
					,'pswd' => 'EminjanFx43'
					,'dbName' => '1718he201365'
					,'nom' => 'OBULKASIM'
					,'prenom' => 'Eminjan'  
					,'classe' => '2TM1'  
					);
}
