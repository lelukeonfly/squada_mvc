<?php
function get_db_connection()
    {
        $host = "localhost";
        $user = "root";
        $pwd = "";
        $schema = "auktion_testing";

        try {
            $db = new PDO('mysql:host='.$host.';dbname='.$schema.';port=3306',$user,$pwd);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $db;
    }


function SETADMIN($username, $password){

    $db_connection = get_db_connection();

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO mannschaft(id, name, loginname, passwort, guthaben) VALUES (NULL, '$username', 'ADMIN', '$hashed_password', -1)";
    
    $res = $db_connection->query($query, PDO::FETCH_ASSOC);


}

function get_players(){
    $db_connection = get_db_connection();
    $query = "SELECT spieler.id, spieler.name, spieler.position, spieler.mannschaft FROM spieler";
    $statement = $db_connection->query($query, PDO::FETCH_ASSOC);
    return $statement->fetchAll();
}

function get_player($id)
{
    $db_connection = get_db_connection();
    $query = "SELECT spieler.name, spieler.position, spieler.mannschaft FROM spieler WHERE spieler.id LIKE $id";
    $statement = $db_connection->query($query, PDO::FETCH_ASSOC);
    return $statement->fetch();
}

//Loggt den Benutzer mit den Jeweiligen Username und dem Pwd ein
function log_in($username, $pwd, $admin) {
    
    //Aufbau der DB Connection
    $db = get_db_connection();

    //Absetzen der DB Query
    if ($admin == false) {
        $query = "SELECT m.loginname, m.passwort, m.id, m.name FROM mannschaft m WHERE m.loginname = '$username'";
    }
    else {
        $query = "SELECT a.id, a.name, a.passwort FROM admin a WHERE a.Name = '$username'";
    }
    $statement = $db->query($query, PDO::FETCH_ASSOC);

    $num = $statement->rowCount(); 
    $eintrag = $statement->fetch();
    var_dump($eintrag);
    $hash = $eintrag['Passwort'];
    

    //Überprüfen, ob der eintrag *nicht* null ist
    if($eintrag != null) {
        //Wenn min. ein User errscheind wird in der Session die ID des eingeloggten Benutzers geschrieben
        if ($num == 1) {
            if (password_verify($pwd, $hash)) {
                $_SESSION['user'] = $eintrag['id'];
                $_SESSION['name'] = $eintrag['name'];
                $_SESSION['admin'] = $admin;
                return true;
            } else {
                return false;
            }
        }
        else {
            return false;
        }
    }
    else {
        return false;
    }

}

//Durch Playerinfos die Image URL bekommen und zurückgeben
function getPlayerImage($playername, $cardyear = 2021){

    //Die eingegebenen Werte in Caps umwandeln.
    $playername = strtoupper($playername);
    $arr = explode(" ", $playername, 2);
    $first = $arr[0];

    $url = "https://content.fantacalcio.it/web/campioncini/card$cardyear/$first.png";
    $image_type_check = @exif_imagetype($url);//Get image type + check if exists
    
    //Wenn kein Img gefunden wird, wird ein general img verwendet.
    $noimage = "https://content.fantacalcio.it/web/campioncini/card2021/NO-CAMPIONCINO.png";

    //Überprüfen ob das Image existiert
    if (strpos($http_response_header[0], "403") || strpos($http_response_header[0], "404") || strpos($http_response_header[0], "302") || strpos($http_response_header[0], "301") ) {
        return $noimage;
    }
    else {
        return $url;
    }


}

//Durch Teamnamen die Image URL bekommen und zurückgeben
#input: heimmannschaft von spieler
function getTeamImage($team) {

    //Die eingegebenen Werte in Lowercase umwandeln
    $team = strtolower($team);
    $url = "https://content.fantacalcio.it/web/img/team/$team.png";

    //Überprüfen, ob bild existiert
    if (!file_exists($url)) {
        return $url;
    }
    else {
        return false;
    }

}
    
//Überprüfen on User eingeloggt ist
function is_logged_in() {
    $sol = false;

    //In session nachsehen ob eintrag existiert
    if (isset($_SESSION['user'])) {
        if (!empty($_SESSION['user'])) {
            $sol = true;
        }
    }
    return $sol;
}


function register($loginname, $pwd, $name, $guthaben) {
    $db_connection = get_db_connection();

    $checkquery = "SELECT * FROM mannschaft m WHERE m.loginname = '$loginname'";
    $check = $db_connection->query($checkquery, PDO::FETCH_ASSOC); 
    $usr = $check->fetch();

    $num = $check->rowCount(); 
    if ($num >= 1) {
        return false;
    }
    else {
        $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);
        $query = "INSERT INTO mannschaft(id, name, loginname, passwort, guthaben) VALUES (NULL, '$name', '$loginname', '$hashed_password', $guthaben)";
        
        $res = $db_connection->query($query, PDO::FETCH_ASSOC);
        
        return true;
       
    }
   

}

#WISO BEI ADMIN 2 RÜCKGABEWERTE??
function getUsername($id, $admin){
    $db_connection = get_db_connection();

    if ($admin == false) {
        $query = "SELECT m.loginname FROM mannschaft m WHERE m.id = $id";
    } else {
        $query = "SELECT a.name FROM admin a WHERE a.id = $id";
    }

    $statement = $db_connection->query($query, PDO::FETCH_ASSOC); 
    $eintrag = $statement->fetch();

    if ($admin == true) {
        $eintrag['loginname'] = $eintrag['name'];
    }

    return $eintrag;
}

/**
 * REWORK
 */
#function getTeuerstenPlayer() {
#
#    $db_connection = get_db_connection();
#
#    $query = "SELECT MAX(ba.preis), s.name FROM bietet_auf ba JOIN spieler s ON s.id = ba.spieler_fk JOIN mannschaft m  ON m.id = ba.mannschaft_fk";
#
#    $statement = $db_connection->query($query, PDO::FETCH_ASSOC);
#    $spieler = $statement->fetch();
#
#    return $spieler;
#}

function getTeuerstenPlayer()
{
}


/**
 * REWORK
 */
#function seeOfferedPlayers($mannschaft_id){
#    $db_connection = get_db_connection();
#
#    $query = "SELECT ba.preis, s.name, s.position, s.mannschaft FROM bietet_auf ba JOIN spieler s ON s.id = ba.spieler_fk WHERE ba.mannschaft_fk = $mannschaft_id";
#
#    $statement = $db_connection->query($query, PDO::FETCH_ASSOC);
#    $offers = $statement->fetchAll();
#
#    return $offers;
#}

function seeOfferedPlayers($mannschaft_id)
{
}

function comparePassword($password1, $password2) {
    if(strcmp($password1,$password2)==0){
        return true;
    }else{
        return false;
    }    
}

function editPassword($currentpassword, $newpassword, $id) {

    $db_connection = get_db_connection();

    $verifyPasswordQuery = "SELECT m.passwort, m.id FROM mannschaft m WHERE m.id = $id";

    $statement = $db_connection->query($verifyPasswordQuery, PDO::FETCH_ASSOC);
    $eintrag = $statement->fetch();
    $hashed_password = $eintrag['Password'];

    $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);

    if (password_verify($currentpassword, $hashed_password)) {
        $editPassword = "UPDATE mannschaft SET passwort = '$newpassword' WHERE mannschaft.id = $id";
        $statement = $db_connection->query($editPassword, PDO::FETCH_ASSOC);
        return $statement->execute();
    } else 
        return false;
}

function changeUsersettings($id, $newname, $newloginname, $newpassword) {
    $state = true;
    $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
    $query = "UPDATE mannschaft SET Name = '$newname', loginname = '$newloginname', passwort = '$newpassword' WHERE mannschaft.id = $id";
    $db_connection = get_db_connection();

    $statement = $db_connection->query($query, PDO::FETCH_ASSOC);

    if ($statement->execute()) {
        $state = false;
    }

    return $state;
}

function ResultchangeUsersettings(){
    if ($_POST) {
        $update =changeUsersettings($_SESSION['user'], $_POST['name'], $_POST['loginname'], $_POST['passwort']);
        return $update;
    }
}

function setGuthaben($id){

}

function bieten(){

}

/**
 * used to load the menubar after the head() fun
 */
function navbar(){
    //Responsive navbar
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        #require_once "imports/menubar.php";
        require_once 'view/html_template/html_menubar.html';
    } 
    else {
        #require_once "imports/navbar.php";
        require_once 'view/html_template/html_navbar.html';
    }
}

/**
 * used to add the header to the document
 */
function head()
{
    require_once 'view/html_template/html_header.html';
}

/**
 * used to add the footer to the document
 */
function footer()
{
    require_once 'view/html_template/html_footer.html';
}

function loginResult($admin){
    $result = true;
    if(isset($_POST['loginname']) && isset($_POST['pwd'])){

        $result = log_in($_POST['loginname'], $_POST['pwd'], $admin);
        if ($result == true) {
            #leite zu index mit aktion dashbloard weiter (mvc)
            header('Location: index.php?aktion=dashboard');
        }
        }
    return $result;
}

function logout()
{
    #destroys session (deletes it) and forwards to main page
    session_destroy();
    header("Location:index.php");
}

function getLogoURL(){
    return $_SERVER['DOCUMENT_ROOT']."/view/img/LOGO.png";
}

function success()
{
    return isset($login) && $login == false; // <-- Does not work
}


/**
 * Dauer und Vertragszeit in DB als Integer (Sekunden) gespeichert
 * Berechnet wann Spieler außer Vertrag ist
 */
function getTimestampWhenSpielerNichtMehrUnterVertragIst($spielerId)
{
    $db_connection = get_db_connection();

    $query = "SELECT anfang, dauer, vertragszeit FROM auktion WHERE spieler_fk = $spielerId";
    $statement = $db_connection->query($query, PDO::FETCH_ASSOC);
    $daten = $statement->fetch();
    extract($daten);

    //Funktion strtotime werden Sekunden zum Anfang addiert
    $out = date('Y-m-d H:i:s',strtotime("$anfang + $dauer Seconds + $vertragszeit Seconds"));
    return $out;
}

//gibt spieler welche nicht in vertrag sind aus
function getPlayersNotInVertrag()
{
    $db_connection = get_db_connection();
    $query = "SELECT spieler.id, spieler.name, auktion.anfang, auktion.dauer, auktion.vertragszeit FROM spieler LEFT JOIN auktion ON spieler.id = auktion.spieler_fk";
    $statement = $db_connection->query($query, PDO::FETCH_ASSOC);
    $data = $statement->fetchAll();

    //neues array für return (sammlung von player)
    $playerArray = array();
    //loop durch jeden player
    foreach($data as $player){
        //neues array für einzelnen player
        $one = array();
        extract($player);
        //zeit nach vertrag ende -> add(anfang+dauer+vertragszeit)
        $endtime = strtotime("$anfang + $dauer Seconds + $vertragszeit Seconds");
        //zeit vor vertrag -> add(anfang+dauer)
        $vorvertragtime = strtotime("$anfang + $dauer Seconds");
        if(time()>$endtime||time()<$vorvertragtime){
            $one['id'] = $id;
            $one['name'] = $name;
            $one['anfang'] = $dauer;
            $one['vertragszeit'] = $vertragszeit;
            $playerArray[] = $player;
        }
    }

    return $playerArray;
}

/**
 * Funktion für insert into auktion tabelle
 */

function setAuktion($array)
{
    extract($array);

    $db_connection = get_db_connection();
    $query = "INSERT INTO auktion(anfang, dauer, spieler_fk, vertragszeit) VALUES ('$anfang','$dauer','$spieler_fk','$vertragszeit')";
    $db_connection->query($query);
}


/**
 * Funktion für insert into nimmt_teil tabelle
 */
function setNimmt_teil($array)
{
    extract($array);

    $db_connection = get_db_connection();
    $query = "INSERT INTO nimmt_teil(mannschaft_fk, auktion_fk, wann, geld) VALUES ('$mannschaft_fk','$auktion_fk','$wann','$geld')";
    $db_connection->query($query);
}

//holt id von aukton mit höchstem datum
function getAuktionId($player_id)
{
    $db_connection = get_db_connection();
    $query = "SELECT DISTINCT(auktion.id) FROM auktion JOIN nimmt_teil ON auktion.id = nimmt_teil.auktion_fk WHERE auktion.spieler_fk = $player_id AND auktion.anfang = (SELECT MAX(auktion.anfang) FROM auktion WHERE auktion.spieler_fk = $player_id)";
    $statement = $db_connection->query($query, PDO::FETCH_ASSOC);
    return $statement->fetch();
}

//gibt das höchste gebot einer auktion zurück
function getHoechstesGebotOnAuction($auction_id)
{
    $db_connection = get_db_connection();
    $query = "SELECT MAX(nimmt_teil.geld) as max FROM auktion JOIN nimmt_teil ON auktion.id = nimmt_teil.auktion_fk WHERE auktion.id = $auction_id";
    $statement = $db_connection->query($query, PDO::FETCH_ASSOC);
    return $statement->fetch();
}

function getAuktionLog($auktion_id)
{
    $db_connection = get_db_connection();
    $query = "SELECT nimmt_teil.wann, nimmt_teil.geld, mannschaft.name FROM auktion JOIN nimmt_teil ON auktion.id = nimmt_teil.auktion_fk JOIN mannschaft ON nimmt_teil.mannschaft_fk = mannschaft.id WHERE auktion.id = $auktion_id ORDER BY nimmt_teil.wann DESC";
    $statement = $db_connection->query($query, PDO::FETCH_ASSOC);
    return $statement->fetchAll();
}


function generateLogTable($spieler_id)
{
    var_dump(getAuktionLog($spieler_id));
    #foreach(getAuktionLog($spieler_id) as $rowname => $logrow){
        ?>
    <!--    <tr>-->
        <?php
            #foreach ($logrow as $logdata) {
                ?>
                <!--<td>$logdata</td>-->
                <?php
            #}
        ?>
        <!--</tr>-->
        <?php
    #}
}

function getSpielerMannschaften()
{
    $db_connection = get_db_connection();
    $query = "SELECT DISTINCT(spieler.mannschaft) FROM spieler";
    $statement = $db_connection->query($query, PDO::FETCH_ASSOC);
    return $statement->fetchAll();
}

function getSpielerFromMannschaft($mannschaft)
{
    $db_connection = get_db_connection();
    $query = "SELECT spieler.id, spieler.name, spieler.position FROM spieler WHERE spieler.mannschaft = '$mannschaft'";
    $statement = $db_connection->query($query, PDO::FETCH_ASSOC);
    return $statement->fetchAll();
}