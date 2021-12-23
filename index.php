<?php
    session_start();
    require_once 'model/funktionen.inc.php';
    

    $aktion = isset($_REQUEST['aktion'])?$_REQUEST['aktion']:'default';
    
    ##DEBUG:
    echo "Aktion: ".$aktion;
    // LOGIK
    switch($aktion) {
        case 'default':
            #navbar();
            break;
        case 'login':
            #navbar();
            loginResult();
            break;
        case 'dashboard':
            #navbar();
            echo 'dashboard site';
            break;
        case 'logout':
            #navbar();
            break;
        case 'settings':
            #navbar();
            break;
    }
    
    // SICHT
    require_once 'view/' . $aktion . '.tpl.html'; 
?>