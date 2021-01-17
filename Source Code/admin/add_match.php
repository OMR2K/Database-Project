<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION["admin_login_status"]) || $_SESSION["admin_login_status"] <> 1){
    header("location: ../home.html");
    return;

}
include ('admin_home.php');
$matchnumber = $_POST["matchnumber"];
$servername = "dbproject5.org";
$username = "Team2X_admin";
$password = "Team2X_admin";
$dbname = "Team2X_Project";
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "select MatchNumber from FOOTBALL_MATCH where MatchNumber = " . $matchnumber;
$check_sql = $conn->query($sql);
$exists_row = $check_sql->num_rows;
if($exists_row > 0){
    echo "<p style='font-size:25px;text-align:center;'>A match with this number already exists.</p><br>";
}
else{
    $insert_sql = "insert into FOOTBALL_MATCH values('" . $_POST["matchdate"] . "','" . $_POST["matchtime"] . "'," . $_POST["matchnumber"] . ",'" . $_POST["team1"] . "','" . $_POST["team2"] . "','" . $_POST["stadium_selection"] . 
    "');";
    $insert = $conn->query($insert_sql);
    echo "<p style='font-size:25px;text-align:center;'>Match added successfully.</p><br>";
}

?>