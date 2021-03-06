<h1>Auction status:</h1>
        <?php
        //var_dump(getAuktionDetails(getLatestAuktionId($_GET['playerid'])));
        //extract(getAuktionDetails(getLatestAuktionId($_GET['playerid'])));
        $latestAuktion = getLatestAuktionId($_GET['playerid']);
        if (!empty($latestAuktion)) {
        $auktionDetails = getAuktionDetails($latestAuktion['id']);
        $anfang = $auktionDetails['anfang'];
        $anfang = date("Y-m-d H:i:s", strtotime("$anfang"));
        $dauer = $auktionDetails['dauer'];
        $vertragszeit = $auktionDetails['vertragszeit'];
        $bis = date('Y-m-d H:i:s', strtotime("$anfang + $dauer Seconds"));
        $vertragsende = date('Y-m-d H:i:s', strtotime("$bis + $vertragszeit Seconds"));
        //60*60*24
        $vertragsdauerindays = secondsToTime($vertragszeit);
        ?>
        <!--error detected: will not reload on new players unless they have vertrag-->
        <table class="table table-striped">
            <tr>
                <td>
                    Start of auction
                </td>
                <td>
                    <?=$anfang;?>
                </td>
            </tr>
            <tr>
                <td>
                    Auction time left
                </td>
                <td id="time"></td>
            </tr>
            <tr>
                <td>
                    Start of contract
                </td>
                <td>
                    <?=$bis;?>
                </td>
            </tr>
            <tr>
                <td>
                    End of contract
                </td>
                <td>
                    <?=$vertragsende;?>
                </td>
            </tr>
            <tr>
                <td>
                    Contract time
                </td>
                <td>
                    <?=$vertragsdauerindays;?>
                </td>
            </tr>
        </table>
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

        <script>
// Set the date we're counting down to
let countDownDate = new Date("<?=$bis;?>").getTime();

// Update the count down every 1 second
let x = setInterval(function() {

  // Get today's date and time
  //change this!!!!!!!!!!!!!!!!!!!!!!!!!root
  let now = new Date().getTime();
    
  // Find the distance between now and the count down date
  let distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  let days = Math.floor(distance / (1000 * 60 * 60 * 24));
  let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  let seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="time"
  document.getElementById("time").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("time").innerHTML = "EXPIRED";
  }
}, 1000);
</script>