<?php
    require_once 'model/funktionen.inc.php';
    

    $aktion = isset($_REQUEST['aktion'])?$_REQUEST['aktion']:'default';
    
    echo "Aktion: ".$aktion;
    // LOGIK
    switch($aktion) {
        case 'default':
            break;
    }
    
    // SICHT
    require_once 'view/' . $aktion . '.tpl.html';  
?>