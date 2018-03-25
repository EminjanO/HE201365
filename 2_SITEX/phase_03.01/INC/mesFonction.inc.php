<?php
/**
 * Created by PhpStorm.
 * User: eminjan
 * Date: 2/24/2018
 * Time: 9:08 AM
 */
$tableau = [
    'bo124' =>['auteur'=> 'B.Y.',  'titre'=> 'Connectique',              'prix'=> 5.20],
    'bo254' =>['auteur'=> 'L.Ch.', 'titre'=> 'Programmation C',          'prix'=> 4.75],
    'bo334' =>['auteur'=> 'L.Ch.', 'titre'=> 'JavaScript',               'prix'=> 6.40],
    'bo250' =>['auteur'=> 'D.A.',  'titre'=> 'Mathématiques',            'prix'=> 6.10],
    'bo604' =>['auteur'=> 'V.V.',  'titre'=> 'Objets',                   'prix'=> 4.95],
    'bo025' =>['auteur'=> 'D.M.',  'titre'=> 'Electricité',              'prix'=> 7.15],
    'bo099' =>['auteur'=> 'D.M.',  'titre'=> 'Phénomènes Périodiques',   'prix'=> 6.95],
    'bo023' =>['auteur'=> 'V.MN.', 'titre'=> 'Programmation Java',       'prix'=> 5.75],
    'bo100' =>['auteur'=> 'D.Y.',  'titre'=> 'Bases de Données',         'prix'=> 6.35],
    'bo147' =>['auteur'=> 'V.V.',  'titre'=> 'Traitement de Signal',     'prix'=> 4.85],
    'bo004' =>['auteur'=> 'B.W.',  'titre'=> 'Sécurité',                 'prix'=> 5.55],
    'bo074' =>['auteur'=> 'B.Y.',  'titre'=> 'Electronique digitale',    'prix'=> 4.35],
    'bo257' =>['auteur'=> 'D.Y.',  'titre'=> 'Programmation Multimedia', 'prix'=> 6.00]
];

function scriptInfos($p='' ){
    $calFuncLine = __LINE__-1;
    static $count=0;
    if($count==0)
    {
        if(!defined('__SCRIPT_PROTOCOL__') && (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')){

            define('__SCRIPT_PROTOCOL__',"https");
        }
        if(!defined('__SCRIPT_PORT__')) define('__SCRIPT_PORT__',$_SERVER['SERVER_PORT']);
        if(!defined('__SCRIPT_DNS__')) define('__SCRIPT_DNS__',$_SERVER["SERVER_NAME"]); // 193.190.65.92
        if(!defined('__SCRIPT_ROOT__')) define('__SCRIPT_URL__',$_SERVER["URL"]);


    }
    $count++;

    $scriptProtocol=__SCRIPT_PROTOCOL__;
    $scriptPort = __SCRIPT_PORT__;
    $scriptDns =__SCRIPT_DNS__;
    $scriptRoot = __SCRIPT_URL__;

    $pathInfo=pathinfo(__SCRIPT_URL__);
    $scriptPath=$pathInfo['dirname'];
    $scriptName=$pathInfo['basename'];
    $scriptShort=$pathInfo['filename'];
    $scriptExt=$pathInfo['extension'];

    //le chemin complet (protocole + dns + path + nom)
    $scriptFull = $scriptProtocol."://".$scriptDns.$scriptPath."/".$scriptName;//le chemin complet (protocole + dns + path + nom)
    if(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')|| $_SERVER['SERVER_PORT'] == 443)
        || (($_SERVER['HTTPS'] == 'off')|| $_SERVER['SERVER_PORT'] == 80))
    {
        $scriptPortDef = 1;
    }
    elseif (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')|| $_SERVER['SERVER_PORT'] != 443)
        || (($_SERVER['HTTPS'] == 'off')|| $_SERVER['SERVER_PORT'] != 80))
    {
        $scriptPortDef = 0;
    }

    $scriptInfos = array("protocol" =>$scriptProtocol, "port" =>$scriptPort, "dns"=>$scriptDns, "path"=>$scriptPath,
        "name"=>$scriptName, "short"=>$scriptShort, "ext"=>$scriptExt, "isportdef"=>$scriptPortDef );

    if(empty($p)){
        $scriptInfos = null;
        return "";
    }
    foreach ($scriptInfos as $key => $value){
        if(strtolower($p) == $key) return $value;
    }
    if ( strtolower($p)=="new" || strtolower($p)=="all")
    {
        return $scriptInfos;
    } elseif (strtolower($p)=="full")
    {
        return $scriptFull;
    }elseif (strtolower($p)=="root")
    {
        return $scriptRoot;
    }
    else{
        echo 'Error in '. $calFuncLine .' : '. 'parametre inconnu : ' . $p;
    }
}

function creeTableau($liste, $titre='', $index = false)
{
    /*
     * in here we can use :
     * $style = ["display:".$index , 'font-style: italic'];
     */
    // P27(slide 3) P41
    if(!$index)
        $style = ["display:none" , 'font-style: italic'];
    else
        $style = ["display:inline-block" , 'font-style: italic'];

    $tbOut = "<table>";
    if(!empty($titre))
    {
        $tbOut .= '<caption>'.$titre.'</caption>';
    }

    $tbOut .= "<tr>";
    if($index)
    {
        $tbOut .= "<th style='".implode(';',$style)."'>index</th>"; //
    }

    $fatherKeyList = array_keys($liste); // pour obtenir le reference 1er array
    //echo " this is cnn".monPrint_r($fatherKeyList);
    if(is_array($liste[$fatherKeyList[0]]))
    {
        $listKeysKeys=array_keys($liste[$fatherKeyList[0]]); // pour récuperer les titre des sous array
    }
    for($i=0; $i < count($listKeysKeys); $i++)
    {
        $tbOut .= "<th>$listKeysKeys[$i]</th>";
    }
    $tbOut .= "</tr>";

    if(is_array($liste))
    {
        foreach($liste as $key => $val)
        {
            $tbOut .= "<tr><td style='".implode(';',$style)."'>$key</td>";

            $tab_value = array_keys($val);
            foreach ($tab_value as $elem)
            {
                $tbOut .="<td>".$val[$elem]."</td>";
            }
            $tbOut .="</tr>";
        }

    }
    $tbOut .= "</table>";

    return $tbOut;
}

function monPrint_r(&$liste)
{
    $out = '<div>'."\n<hr>\n";
    $out .= "<pre>\n";
    if (is_array($liste)) $out .= print_r($liste,1);
    else $out .= '/[] : ' .$liste;
    $out .= "</pre><hr></div>";
    return $out;
}

function getServer()
{
    if ( key_exists('dns', scriptInfos('all')) && $_SERVER["REMOTE_HOST"] ==scriptInfos("dns"))
    {
        return 'localhost';
    }
    return '193.190.65.92';
}

/*
echo  "<pre>";
echo "new : ". print_r(scriptInfos("new"),1);
echo "<br> Empty : ".print_r(scriptInfos(""),1);
echo "<br> proTocol : ".print_r(scriptInfos("proTocol"),1);
echo "<br> poRt : ".print_r(scriptInfos("poRt"),1);
echo "<br> isPortDef : ".print_r(scriptInfos("isPortDef"),1);
echo "<br> dNs : ".print_r(scriptInfos("dNs"),1);
echo "<br> path : ".print_r(scriptInfos("path"),1);
echo "<br> naME : ".print_r(scriptInfos("naME"),1);
echo "<br> short : ".print_r(scriptInfos("short"),1);
echo "<br> EXT : ".print_r(scriptInfos("EXT"),1);
echo "<br> all : ".print_r(scriptInfos("all"),1);
echo "<br> full : ".print_r(scriptInfos("full"),1);
echo "<br> root : ".print_r(scriptInfos("root"),1);
echo "</pre>". "<hr>";

echo creeTableau($tableau, 'sans index');
echo "<hr>";
echo creeTableau($tableau, 'avec index', true);

echo "this is monPrint : <br> ".monPrint_r($tableau);*/


function debug_me($var) {
    $debug = debug_backtrace();
    echo '<p>&nbsp;</p><p><a href="#" onclick="$(this).parent().next(\'ol\').slideToggle(); return false;">
		<strong>' . $debug[0]['file'] . ' </strong> l.'
        . $debug[0]['line'] . '</a></p>';
    echo '<ol style="display:none;">';
    foreach ($debug as $k => $v) {
        if ($k > 0) {
            echo '<li><strong>' . $v['file'] . '</strong> l.' . $v['line'] . '</li>';
        }
    }
    echo '</ol>';
    echo '<pre>';
    print_r($var);
    echo '<pre>';
}
