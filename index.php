<?php
    session_start();
    require_once 'model/funktionen.inc.php';
    

    $aktion = isset($_REQUEST['aktion'])?$_REQUEST['aktion']:'default';
    
    ##DEBUG:
    echo "Aktion: ".$aktion;
    // LOGIK
    switch($aktion) {
        case 'default':
            break;
        case 'login':
            loginResult();
            break;
        case 'dashboard':
            break;
        case 'logout':
            logout();
            $aktion = 'default';
            break;
        case 'settings':
            break;
    }
    
    // SICHT
    require_once 'view/' . $aktion . '.tpl.html'; 
?>