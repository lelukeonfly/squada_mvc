<?php
foreach(get_players() as $player){
    if (isAuktion($player['id'])) {
        var_dump($player);
    }
}
?>