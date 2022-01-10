<h1>Auktion Status:</h1>
        <?php
        //var_dump(getAuktionDetails(getLatestAuktionId($_GET['playerid'])));
        //extract(getAuktionDetails(getLatestAuktionId($_GET['playerid'])));
        $latestAuktion = getLatestAuktionId($_GET['playerid']);
        if (!empty($latestAuktion)) {
        $auktionDetails = getAuktionDetails($latestAuktion['id']);
        $anfang = $auktionDetails['anfang'];
        $dauer = $auktionDetails['dauer'];
        $vertragszeit = $auktionDetails['vertragszeit'];
        $bis = date('Y-m-d H:i:s', strtotime("$anfang + $dauer Seconds"));
        $vertragsende = date('Y-m-d H:i:s', strtotime("$bis + $vertragszeit Seconds"));
        //60*60*24
        $vertragsdauerindays = $vertragszeit/86400;
        ?>
        <!--error detected: will not reload on new players unless they have vertrag-->
        <p>Start of auction: <?=$anfang;?></p>
        <p>End of auction and start of contract: <?=$bis;?></p>
        <p>End of contract: <?=$vertragsende;?></p>
        <p>Contract time in days: <?=$vertragsdauerindays;?></p>
        <?php
        }else {
        ?>
        <p>No auction exists</p>
        <?php
        }
        ?>

        <h1>Contract status:</h1>
        <?php
        if (time()>strtotime(getTimestampWhenSpielerNichtMehrUnterVertragIst($_GET['playerid']))||time()<strtotime(getTimestampVorVertrag($_GET['playerid']))) {
            echo "Not under contract";
        }else{
            echo "Under contract";
        }
        ?>