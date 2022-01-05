<?php
include 'model/funktionen.inc.php';

function nl()
{
echo "<br />";
}

function nl2()
{
echo "<br />";
echo "<br />";
}

echo "get_db_connection";
nl();
var_dump(get_db_connection());
nl2();

#miss: SETADMIN()

echo "get_players";
nl();
echo "<textarea>";
var_dump(get_players());
echo "</textarea>";
nl2();

echo "get_player";
nl();
echo "<textarea>";
var_dump(get_player(3));
echo "</textarea>";
nl2();

#miss: log_in()

echo "getPlayerImage";
nl();
echo "<textarea>";
var_dump(getPlayerImage(get_player(3)['name']));
echo "</textarea>";
nl2();

echo "getTeamImage";
nl();
echo "<textarea>";
var_dump(getTeamImage((get_player(3)['mannschaft'])));
echo "</textarea>";
nl2();

echo "is_logged_in";
nl();
echo "<textarea>";
var_dump(is_logged_in());
echo "</textarea>";
nl2();

#miss: register

echo "getUsername";
nl();
echo "<textarea>";
var_dump(getUsername(1,true));
echo "</textarea>";
nl2();

echo "getTeuerstenPlayer";
nl();
echo "<textarea>";
var_dump(getTeuerstenPlayer());
echo "</textarea>";
nl2();

echo "seeOfferedPlayers";
nl();
echo "<textarea>";
var_dump(seeOfferedPlayers(1));
echo "</textarea>";
nl2();

echo "comparePassword";
nl();
echo "<textarea>";
var_dump(comparePassword("test","test"));
echo "</textarea>";
nl2();

#miss: editPassword
#miss: changeUsersettings 
#miss: setGuthaben
#miss: bieten 

echo "navbar";
nl();
echo "<textarea>";
var_dump(navbar());
echo "</textarea>";
nl2();

echo "head";
nl();
echo "<textarea>";
var_dump(head());
echo "</textarea>";
nl2();

echo "footer";
nl();
echo "<textarea>";
var_dump(footer());
echo "</textarea>";
nl2();

echo "loginResult";
nl();
echo "<textarea>";
var_dump(loginResult(false));
echo "</textarea>";
nl2();

echo "logout";
nl();
echo "<textarea>";
var_dump(logout());
echo "</textarea>";
nl2();

echo "getLogoURL";
nl();
echo "<textarea>";
var_dump(getLogoURL());
echo "</textarea>";
nl2();

echo "success";
nl();
echo "<textarea>";
var_dump(success());
echo "</textarea>";
nl2();

echo "getTimestampWhenSpielerNichtMehrUnterVertragIst";
nl();
echo "<textarea>";
var_dump(getTimestampWhenSpielerNichtMehrUnterVertragIst(3));
echo "</textarea>";
nl2();