<?php
    require_once 'model/funktionen.inc.php';
    require_once 'model/database.inc.php';
    

    $aktion = isset($_REQUEST['aktion'])?$_REQUEST['aktion']:'dashboard';
    
    // LOGIK
    switch($aktion) {
        case 'dashboard':
            $adressen = getAdressen();
            break;
    	case "zeige":
        	$eintrag = hole_eintrag($_REQUEST['id']);
    		break;
    	case "neu":
            $eintrag = leerer_eintrag();
        	$aktion = 'formular_anzeigen';
    		break;
    	case "speichere":
            speichere($_POST);
    		break;
    	case "editiere":
        	$eintrag = hole_eintrag($_REQUEST['id']);
        	$aktion = 'formular_anzeigen';
    		break;	
        case "loeschen":
            $eintrag = loeschen($_REQUEST['id']);
            $adressen = getAdressen();
            $aktion = 'zeige_alle';
            break;
    }
    
    // SICHT
    require_once 'view/' . $aktion . '.tpl.html';  
?>