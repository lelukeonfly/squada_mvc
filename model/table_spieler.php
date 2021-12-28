<table id="player" class="table table-bordered table-condensed table-striped table-hover">
    <?php
        $x = true;
        foreach(get_players() as $player){
        if($x){
            ?>
            <thead>
                <?php
                    foreach($player as $column_header => $data){
                        if(strcmp($column_header,"id")==0){}else{
                        ?>
                        <th><?=ucfirst($column_header);?></th>
                        <?php
                        }
                        $x = false;
                    }
                ?>
            </thead>
            <?php
        }
    ?>
<tr class="table-row" data-href="playerstats.php?playerid=<?=$player["id"];?>">
        <?php
            foreach($player as $column_header => $playerdata){
                if(strcmp($column_header,"id")==0){}else{
                    ?>
                <td>
                    <?=$playerdata?>
                </td>
        <?php
                }
            }
        ?>
    </tr>
    <?php
        }
    ?>
</table>