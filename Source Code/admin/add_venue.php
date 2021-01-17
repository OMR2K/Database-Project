<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION["admin_login_status"]) || $_SESSION["admin_login_status"] <> 1){
    header("location: ../home.html");
    return;

}
include ('admin_home.php');
$StadiumName = $_POST["StadiumName"];
$servername = "dbproject5.org";
$username = "Team2X_admin";
$password = "Team2X_admin";
$dbname = "Team2X_Project";
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "select StadiumName from STADIUM where StadiumName = '" . $StadiumName . "';";
$check_sql = $conn->query($sql);
$exists_row = $check_sql->num_rows;
if($exists_row > 0){
    echo "<p style='font-size:25px;text-align:center;'>A stadium with this name already exists.</p><br>";
}
else{
    $insert_sql = "insert into STADIUM values(" . $_POST["Category1Capacity"] . "," . $_POST["Category2Capacity"] . ",'" . $_POST["StadiumName"] . "','" . $_POST["StadiumAddress"] . "','" . $_POST["StadiumCity"] . "'," . $_POST["Category3Capacity"] . "," . $_POST["Category3Capacity"] . 
    ");";
    $insert = $conn->query($insert_sql);
    echo "<p style='font-size:25px;text-align:center;'>Stadium added successfully.</p><br>";
}

?>