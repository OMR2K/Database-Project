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
    $sql = "delete from STADIUM where StadiumName=" . "'" . $_GET["StadiumName"] . "'";
    $conn->query($sql);
    echo "Stadium has been deleted.";
?>