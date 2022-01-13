<?php
    session_start();
    require_once 'model/funktionen.inc.php';
    

    /**
     * if GET variable not set -> aktion variable set to 'home'
     * if GET variable set -> aktion variable set to GET value
     */
    $aktion = isset($_GET['aktion'])?$_GET['aktion']:'home';
    
    /**
     * if aktion variable is specific value -> do that inside the switch case
     */
    // LOGIK
    switch($aktion) {
        case 'home':
            break;
        case 'login':
            //get Login result from Form *no* admin login
            $login = loginResult($admin = false);
            break;
        case 'admin':
            //get Login result from Form *with* admin login
            $login = loginResult($admin = true);
            break;
        case 'dashboard':
            $user = getUser($_SESSION['user'], $_SESSION['admin']);
            break;
        case 'logout':
            logout();
            $aktion = 'home';
            break;
        case 'settings':
            //get Results from Form and Update
            $update = ResultchangeUsersettings();
            break;
        case 'register':
            $res = ResultchangeCreateMannschaft();
            break;
        case 'changepwd':
            $res = ResultUpdatePwd();
            break;
        case 'auktion':
            break;
        case 'playerauktion':
            $user = getUser($_SESSION['user'], $_SESSION['admin']);
            bieten();
            break;
    }
    
    /**
     * loads the header then the actual site and then the footer
     * 
     * loads the specific side where aktion variable matches the filename
     */
    // SICHT
    require 'model/DB_check.inc.php';
    require_once 'view/html_template/html_header.html';
    require_once 'view/' . $aktion . '.tpl.html';
    require_once 'view/html_template/html_footer.html';
?>
