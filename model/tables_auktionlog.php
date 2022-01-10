<?php
foreach (getAuktionId($spieler_id) as $auktion_id) {
        ?>
        <table class="table table-striped">
        <thead>
        <?php
        $x = true;
        foreach(getAuktionLog($auktion_id['id']) as $rowname => $logrow){
            if($x){
            ?>
            <?php
                foreach ($logrow as $header=> $data) {
                    ?>
                    <th><?=ucfirst($header);?></th>
                    <?php
                    $x = false;
                }
            ?>
            <?php
            }
        }
        ?>
        </thead>
        <tbody>
        <?php
        foreach(getAuktionLog($auktion_id['id']) as $rowname => $logrow){
            ?>
            <tr>
            <?php
                foreach ($logrow as $logdata) {
                    ?>
                    <td><?=$logdata;?></td>
                    <?php
                }
            ?>
            </tr>
            <?php
        }
        ?>
        </tbody>
        </table>
        <?php
        }
        ?>