<?php
        foreach (getSpielerMannschaften() as $mannschaft) {
            ?>
            <div>
                <h1><?=$mannschaft['mannschaft'];?></h1>
            <table>
            <?php
            $x = true;
            foreach (getSpielerFromMannschaft($mannschaft['mannschaft']) as $player) {
                if($x){
                    ?>
                    <thead class="text-center">
                    <?php
                    foreach ($player as $column_header => $value) {
                        if (strcmp($column_header,"id")==0) {}else{
                            ?>
                            <th><?=ucfirst($column_header);?></th>
                            <?php
                            $x = false;
                        }
                        ?>
                        </thead>
                        <?php
                    }
                }
            }

            foreach (getSpielerFromMannschaft($mannschaft['mannschaft']) as $player) {
                ?>
                <tr class="clickable text-center" onclick="window.location='index.php?aktion=playerauktion&playerid=<?=$player['id'];?>'">
                <?php
                foreach ($player as $key => $detail) {
                    if($key == "id")
                    {}else{
                    ?>
                    <td><?=$detail;?></td>
                    <?php
                    }
                }
                ?>
                </tr>
                <?php
            }
            ?>
            </table>
        </div>
            <?php
        }
    ?>