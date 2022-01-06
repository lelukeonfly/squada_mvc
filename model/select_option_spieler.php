<?php
foreach (getPlayersNotInVertrag() as $player) {
    ?>
    <option value="<?=$player['id'];?>"><?=$player['name'];?></option>
    <?php
}
?>