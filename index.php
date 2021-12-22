<?php
    require_once 'model/funktionen.inc.php';
    

    $aktion = isset($_REQUEST['aktion'])?$_REQUEST['aktion']:'dashboard';
    
    echo "Aktion: ".$aktion;
    // LOGIK
    switch($aktion) {
        case 'dashboard':
            break;
    }
    
    // SICHT
    require_once 'view/' . $aktion . '.tpl.html';  
?>