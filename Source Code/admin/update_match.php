<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION["admin_login_status"]) || $_SESSION["admin_login_status"] <> 1){
    header("location: ../home.html");
    return;

} 
    include('admin_home.php');
    $servername = "dbproject5.org";
    $username = "Team2X_admin";
    $password = "Team2X_admin";
    $dbname = "Team2X_Project";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "select * from FOOTBALL_MATCH where MatchNumber = " . $_GET["MatchNumber"];
    $things = $conn->query($sql)->fetch_assoc();
    $_SESSION["id"] = $things['MatchNumber'];
?>
<html>
    <form action="confirm_match_update.php" method="post">
        <label> Match Number </label>
        <input type="number" name="MatchNumber" value="<?php echo $things['MatchNumber']; ?>" readonly>
        <br/>
        <br/>
        <label> Match Date </label>
        <input type="date" name="KickOffDate" value="<?php echo $things['KickOffDate']; ?>" required>
        <br/>
        <br/>
        <label> Match Time</label>
        <input type="time" name="KickOffTime" value="<?php echo $things['KickOffTime']; ?>" required>
        <br/>
        <br/>
        <label> Team 1 </label>
        <select name="Team1" required>
            <option selected><?php echo $things['Team1']; ?></option>
            <?php
            $team1_sql = "select * from TEAM";
            $team1_options = $conn->query($team1_sql);
            while($team1_row = $team1_options->fetch_assoc()){
                if($things['Team1'] != $team1_row["TeamName"]){
                    echo "<option>". $team1_row["TeamName"] ."</option>";
                }
            }
            ?>
        </select>
        <br/>
        <br/>
        <label> Team 2 </label>
        <select name="Team2" required>
            <option selected><?php echo $things['Team2']; ?></option>
            <?php
            $team2_sql = "select * from TEAM";
            $team2_options = $conn->query($team2_sql);
            while($team2_row = $team2_options->fetch_assoc()){
                if($things['Team2'] != $team2_row["TeamName"]){
                    echo "<option>". $team2_row["TeamName"] ."</option>";
                }
            }
            ?>
        </select>
        <br/>
        <br/>
        <label> Stadium </label>
        <select id="stadium_selection" name="StadiumName" required>
        <option selected> <?php echo $things['StadiumName']; ?> </option>
        <?php
        $stadium_sql = "select * from STADIUM";
        $stadium_options = $conn->query($stadium_sql);
        while($stadium_row = $stadium_options->fetch_assoc()){
            if($things['StadiumName'] != $stadium_row["StadiumName"]){
                echo "<option>" ;
                echo $stadium_row["StadiumName"];
                echo "</option>";
            }
        }
        ?>
        </select>
        <br/>
        <br/>
        <input type="submit" value="Update">
    </form>
</html>