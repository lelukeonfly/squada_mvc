<?php
function get_db_connection()
    {
        $host = "localhost";
        $user = "root";
        $pwd = "root";
        $schema = "squada";

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
    $query = "INSERT INTO mannschaft(ID, Name, Loginname, Passwort, Guthaben) VALUES (NULL, '$username', 'ADMIN', '$hashed_password', -1)";
    
    $res = $db_connection->query($query, PDO::FETCH_ASSOC);


}

function get_players(){
    $db_connection = get_db_connection();
    $query = "SELECT spieler.id, spieler.name, spieler.position, spieler.mannschaft FROM spieler";
    return $db_connection->query($query, PDO::FETCH_ASSOC);
}

function get_player($id)
{
    $db_connection = get_db_connection();
    $query = "SELECT spieler.name, spieler.position, spieler.mannschaft FROM spieler WHERE spieler.id LIKE $id";
    $statement = $db_connection->query($query, PDO::FETCH_ASSOC);
    return $statement->fetch();
}

#function get_column_names($tablename)
#{
#    $db_connection = get_db_connection();
#    $query = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='squada' AND `TABLE_NAME`='$tablename';";
#    return $db_connection->query($query);
#}

//Loggt den Benutzer mit den Jeweiligen Username und dem Pwd ein
function log_in($username, $pwd) {
    
    //Aufbau der DB Connection
    $db = get_db_connection();

    //Absetzen der DB Query
    $query = "SELECT m.Loginname, m.Passwort, m.id, m.name FROM mannschaft m WHERE m.Loginname = '$username'";
    $statement = $db->query($query, PDO::FETCH_ASSOC);

    $num = $statement->rowCount(); 
    $eintrag = $statement->fetch();
     
    $hash = $eintrag['Passwort'];
    

    //Überprüfen, ob der eintrag *nicht* null ist
    if($eintrag != null) {
        //Wenn min. ein User errscheind wird in der Session die ID des eingeloggten Benutzers geschrieben
        if ($num == 1) {
            if (password_verify($pwd, $hash)) {
                $_SESSION['user'] = $eintrag['id'];
                $_SESSION['name'] = $eintrag['name'];
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

    $checkquery = "SELECT * FROM mannschaft m WHERE m.Loginname = '$loginname'";
    $check = $db_connection->query($checkquery, PDO::FETCH_ASSOC); 
    $usr = $check->fetch();

    $num = $check->rowCount(); 
    if ($num >= 1) {
        return false;
    }
    else {
        $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);
        $query = "INSERT INTO mannschaft(ID, Name, Loginname, Passwort, Guthaben) VALUES (NULL, '$name', '$loginname', '$hashed_password', $guthaben)";
        
        $res = $db_connection->query($query, PDO::FETCH_ASSOC);
        
        return true;
       
    }
   

}

function getUsername($id){
    $db_connection = get_db_connection();

    $query = "SELECT m.* FROM mannschaft m WHERE m.ID = $id";

    $statement = $db_connection->query($query, PDO::FETCH_ASSOC); 
    $eintrag = $statement->fetch();

    return $eintrag;
}

function getTeuerstenPlayer() {

    $db_connection = get_db_connection();

    $query = "SELECT MAX(ba.Preis), s.Name FROM bietet_auf ba JOIN spieler s ON s.ID = ba.spieler_fk JOIN mannschaft m  ON m.ID = ba.mannschaft_fk";

    $statement = $db_connection->query($query, PDO::FETCH_ASSOC);
    $spieler = $statement->fetch();

    return $spieler;
}

function seeOfferedPlayers($id){


    $db_connection = get_db_connection();

    $query = "SELECT ba.Preis, s.Name, s.Position, s.Mannschaft FROM bietet_auf ba JOIN spieler s ON s.ID = ba.spieler_fk WHERE ba.mannschaft_fk = $id";

    $statement = $db_connection->query($query, PDO::FETCH_ASSOC);
    $offers = $statement->fetchAll();

    return $offers;
}

function comparePassword($password1, $password2) {
    if ($password1 == $password2) 
        return true;
    else
        return false;
    
}

function editPassword($currentpassword, $newpassword, $id) {

    $db_connection = get_db_connection();

    $verifyPasswordQuery = "SELECT m.Passwort, m.ID FROM mannschaft m WHERE m.id = $id";

    $statement = $db->query($verifyPasswordQuery, PDO::FETCH_ASSOC);
    $eintrag = $statement->fetch();
    $hashed_password = $eintrag['Password'];

    $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);

    if (password_verify($currentpassword, $hashed_password)) {
        $editPassword = "UPDATE mannschaft SET Passwort = '$newpassword' WHERE mannschaft.ID = $id";
        $statement = $db_connection->query($editPassword, PDO::FETCH_ASSOC);
        return $statement->execute();
    } else 
        return false;
}

function changeUsersettings($id, $newname, $newloginname, $newpassword) {
    $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
    $query = "UPDATE mannschaft SET Name = '$newname', Loginname = '$newloginname', Passwort = '$newpassword' WHERE mannschaft.ID = $id";
    $db_connection = get_db_connection();

    $statement = $db_connection->query($query, PDO::FETCH_ASSOC);

    return $statement->execute();
}

function setGuthaben($id){

}

function bieten(){

}

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

function head()
{
    require_once 'view/html_template/html_header.html';
}

function footer()
{
    require_once 'view/html_template/html_footer.html';
}

function loginResult(){
    if(isset($_POST['loginname']) && isset($_POST['pwd'])){

            $result = log_in($_POST['loginname'], $_POST['pwd']);
            if ($result == true) {
                #leite zu index mit aktion dashbloard weiter (mvc)
                header('Location: index.php?aktion=dashboard');
            }
            else {
                $result == false;
            }
    }
}

function logout()
{
    unset($_SESSION['user']);
    header("Location:index.php");
}

function success()
{
    return isset($result) && $result == false;
}
