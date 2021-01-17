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
    $sql = "update STADIUM set Category1Capacity =" . $_POST['Category1Capacity'] .", ". "Category2Capacity=" . $_POST['Category2Capacity'] . "," . "StadiumName='" . $_POST['StadiumName'] . "'," . 
    "StadiumAddress='" . $_POST['StadiumAddress'] . "'," . "StadiumCity='" . $_POST['StadiumCity'] . "'," .  "Category3Capacity=" . $_POST['Category3Capacity'] . "," .  "Category4Capacity=" . $_POST['Category4Capacity']. " where StadiumName='" . $_POST["StadiumName"] ."';";
    $conn->query($sql);
    echo "Stadium has been successfully updated.";
?>