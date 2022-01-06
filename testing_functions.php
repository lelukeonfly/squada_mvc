<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            display: flex;
            flex-wrap: wrap;
            gap: 5em;
        }
    </style>
</head>
<body>

<?php
include 'model/funktionen.inc.php';
session_start();

function nl()
{
echo "<br />";
}


echo "<div>";
echo "get_db_connection";
nl();
echo "<textarea>";
var_dump(get_db_connection());
echo "</textarea>";
echo "</div>";

#miss: SETADMIN()

echo "<div>";
echo "get_players";
nl();
echo "<textarea>";
var_dump(get_players());
echo "</textarea>";
echo "</div>";

echo "<div>";
echo "get_player";
nl();
echo "<textarea>";
var_dump(get_player(3));
echo "</textarea>";
echo "</div>";

#miss: log_in()

echo "<div>";
echo "getPlayerImage";
nl();
echo "<textarea>";
var_dump(getPlayerImage(get_player(3)['name']));
echo "</textarea>";
echo "</div>";

echo "<div>";
echo "getTeamImage";
nl();
echo "<textarea>";
var_dump(getTeamImage((get_player(3)['mannschaft'])));
echo "</textarea>";
echo "</div>";

echo "<div>";
echo "is_logged_in";
nl();
echo "<textarea>";
var_dump(is_logged_in());
echo "</textarea>";
echo "</div>";

#miss: register

echo "<div>";
echo "getUsername";
nl();
echo "<textarea>";
var_dump(getUsername(1,true));
echo "</textarea>";
echo "</div>";

echo "<div>";
echo "getTeuerstenPlayer";
nl();
echo "<textarea>";
var_dump(getTeuerstenPlayer());
echo "</textarea>";
echo "</div>";

echo "<div>";
echo "seeOfferedPlayers";
nl();
echo "<textarea>";
var_dump(seeOfferedPlayers(1));
echo "</textarea>";
echo "</div>";

echo "<div>";
echo "comparePassword";
nl();
echo "<textarea>";
var_dump(comparePassword("test","test"));
echo "</textarea>";
echo "</div>";

#miss: editPassword
#miss: changeUsersettings 
#miss: setGuthaben
#miss: bieten 

echo "<div>";
echo "navbar";
nl();
echo "<textarea>";
var_dump(navbar());
echo "</textarea>";
echo "</div>";

echo "<div>";
echo "head";
nl();
echo "<textarea>";
var_dump(head());
echo "</textarea>";
echo "</div>";

echo "<div>";
echo "footer";
nl();
echo "<textarea>";
var_dump(footer());
echo "</textarea>";
echo "</div>";

echo "<div>";
echo "loginResult";
nl();
echo "<textarea>";
var_dump(loginResult(false));
echo "</textarea>";
echo "</div>";

echo "<div>";
echo "logout";
nl();
echo "<textarea>";
var_dump(logout());
echo "</textarea>";
echo "</div>";

echo "<div>";
echo "getLogoURL";
nl();
echo "<textarea>";
var_dump(getLogoURL());
echo "</textarea>";
echo "</div>";

echo "<div>";
echo "success";
nl();
echo "<textarea>";
var_dump(success());
echo "</textarea>";
echo "</div>";

echo "<div>";
echo "getTimestampWhenSpielerNichtMehrUnterVertragIst";
nl();
echo "<textarea>";
var_dump(getTimestampWhenSpielerNichtMehrUnterVertragIst(3));
echo "</textarea>";
echo "</div>";

echo "<div>";
echo "getPlayersNotInVertrag";
nl();
echo "<textarea>";
var_dump(getPlayersNotInVertrag());
echo "</textarea>";
echo "</div>";

echo "<div>";
echo "getAuktionId";
nl();
echo "<textarea>";
var_dump(getAuktionId());
echo "</textarea>";
echo "</div>";

echo "<div>";
echo "getHoechstesGebotOnAuction";
nl();
echo "<textarea>";
var_dump(getHoechstesGebotOnAuction(2));
echo "</textarea>";
echo "</div>";
?> 
</body>
</html>